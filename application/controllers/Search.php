<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Frontend_Controller {
	public $_subView = 'templates/search/';
	public function __construct(){
		parent::__construct();
        $this->perPage = 20;
	}

	public function index(){
		$this->data['active'] = 'home';
		$this->data['search'] ='';

		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view($this->_subView.'index',$this->data);
	}
	

	public function v($id=false, $employer=false){
		if(!$id) {
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		
		if($id && !$employer){
		    
    		$check_data = $this->data['list_data'] = $this->comman_model->get_by('final_address_contact_information',array('user_id'=>$id),false,true);
    		$this->data['user_data'] = $this->comman_model->get_by('users',array('id'=>$id),false,true);
    		$this->data['employer_data'] = "";
		    
		}else if($id && $employer == 'employer'){
		    $this->data['list_data'] = "";
		    $this->data['user_data'] = "";
		    $check_data = $this->data['employer_data'] = $this->comman_model->get_by('final_employment_info',array('user_id'=>$id),false,true);
            
		}
		if(!$check_data){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$this->data['title'] =$this->data['settings']['site_name'];
		$this->load->view($this->_subView.'view_user',$this->data);
	}

    public function ajax_get_member($id=false){
        print_r($id);
		if(!$id){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$check_data = $this->data['user_data'] = $this->comman_model->get_query('users',array('id'=>$id),false,true);

		if(!$check_data){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		//print_r($check_data);
	}

	public function view($id=false){
		if(!$id){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$check_data = $this->data['user_data'] = $this->comman_model->get_by('users',array('id'=>$id),false,true);
		$this->data['caa_data'] = $this->comman_model->get_by('temp_stats',array('user_id'=>$id),false,true);
		$this->data['grad_date'] = $this->comman_model->get_by('final_program_university_info',array('user_id'=>$id),false,true);
		
		if(!$check_data){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$this->data['title'] = $this->data['settings']['site_name'];
		//$this->data['certificate_date'] = $certificate_date;
		$this->load->view($this->_subView.'view',$this->data);
	}

	
	function ajax($page_type=false){	
	
		$output = array();
		$output['result']= 'error';
		

		$userArr =array();

		$where_clause1 = "";
		$where_clause2 = "";
		$where_clause3 = "";
		$url = '';
		$m_name = '';
		$name = strtolower($this->input->get('f_name'));
		$l_name = strtolower($this->input->get('l_name'));
		
		if(strpos($l_name, "'") !== false)
		{
			$specific_name = explode("'", $l_name);
			
			$l_name = $specific_name[1];
			$m_name = $specific_name[0];
		}
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$zip = strtolower($this->input->get('zip'));
		$employer = strtolower($this->input->get('employer'));
		if($name){
			$url .= 'f_name='.$name.'&';
			$where_clause1 .= " lower(f_name) like '".$name."%' and";
		}

		if($l_name){
			$url .= 'l_name='.$l_name.'&';
			$where_clause1 .= " lower(l_name) like '".$l_name."%'";
		}

		if($m_name != ""){
			// $url .= 'm_name'.$m_name.'&';
			$where_clause1 .= " and lower(m_name) like '".$m_name."%'";
		}

		if($employer){
			$url .= 'employer='.$employer.'&';
			$where_clause2 .= " lower(employer_name) like '".$employer."%'";
		}

		if($city){
			$url .= 'city='.$city.'&';
			$where_clause3 .= " lower(city) like '".$city."%' and";
		}

		if($state){
			$url .= 'state='.$state.'&';
			$where_clause3 .= " lower(state) like '".$state."%' and";
		}

		if($zip){
			$url .= 'zip='.$zip.'&';
			$where_clause3 .= " lower(zip_code) like '".$zip."%' and";
		}

/*		echo $url;
		echo '<br>';*/
		$where_clause1 = rtrim($where_clause1,'and');
		$where_clause2 = rtrim($where_clause2,'and');
		$where_clause3 = rtrim($where_clause3,'and');
		$page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*20-20;
			//$offset = $page*2-2;
			$this->data['page_number'] = $page;
        }
		
		$this->data['total'] = $output['total'] = 0;
		if($_REQUEST){
			if($where_clause1 || $where_clause2 || $where_clause3){
				$output['result']= 'ok';
				//$stringQuery = "SELECT * FROM (`certificates`) WHERE enabled =1 and ";
                if(empty($where_clause1) == false){
					$stringQuery = "SELECT * FROM (`final_generalinform`) WHERE ".$where_clause1;	
				}
				
                if(empty($where_clause2) == false){
					$stringQuery = "SELECT * FROM (`final_employment_info`) WHERE ".$where_clause2;	
					
				}
				
				if(empty($where_clause3) == false){
					$stringQuery = "SELECT * FROM (`final_address_contact_information`) WHERE ".$where_clause3;	
					
				}

				$obj = $this->comman_model->get_query($stringQuery,false);
				$member_cert_id = array();
				$member_fullname = array();
				if($obj){
	                    for($i = 0; $i < count($obj); $i++){
	                        
	                        $member_cert_id[$i] = $this->comman_model->get_by('temp_stats',array('user_id'=>$obj[$i]->user_id),false,true);
	                        $member_fullname[$i] = $this->comman_model->get_by('final_generalinform',array('user_id'=>$obj[$i]->user_id),false,true);
	                    }
			
    				$this->data['member_cert_id'] = $member_cert_id;
    
                    $this->data['member_fullname'] = $member_fullname;
			    
				}
                
				$this->data['total'] = $output['total'] = print_count_query($stringQuery);

				$output['html'] = $this->load->view($this->_subView.'ajax_search',$this->data,true);
				if(empty($output['html'])){
					$output['html'] ='';
				}

				$checkMoreD = $this->comman_model->get_query($stringQuery,false);
				

			}
		}
		else{
			$output['html'] = '';
		}
		$output['url']= site_url().'search/?'.$url;
		$output['ajax_url']= site_url().'search/ajax?'.$url;
		echo json_encode($output);
	}



	public function map(){
		$this->data['active'] = 'home';
		$this->data['search'] ='';
		$this->data['title'] = "Search | ".$this->data['settings']['site_name'];
		$this->load->view($this->_subView.'index_map',$this->data);
	}
	
	function ajax_total_map($page_type=false){	
	
		$output = array();
		$output['result']= 'error';
		
		$userArr =array();

		$where_clause = "";
		$url = '';
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$zip = strtolower($this->input->get('zip'));

		if($city){
			$url .= 'city='.$city.'&';
			$where_clause .= " lower(city) like '".$city."%' and";
		}

		if($state){
			$url .= 'state='.$state.'&';
			$where_clause .= " lower(state) like '".$state."%' and";
		}

		if($zip){
			$url .= 'zip='.$zip.'&';
			$where_clause .= " lower(zip_code) like '".$zip."%' and";
		}

/*		echo $url;
		echo '<br>';*/
		$where_clause = rtrim($where_clause,'and');

		$page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*20-20;
			//$offset = $page*2-2;
			$this->data['page_number'] = $page;
        }
		
		$this->data['total'] = $output['total'] = 0;
		if($_REQUEST){
			if($where_clause){
				$output['result']= 'ok';
					$stringQuery = "SELECT 
					user_id, 
				    address_1,
				    city,
				    state,
				    cell_phone,
				    zip_code,
				    email_default AS email
					FROM (`final_address_contact_information`) WHERE ".$where_clause;	
				
				$check_data = $this->data['products'] = $this->comman_model->get_query($stringQuery,false);
				
				if(!$check_data){
        			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
        		}
				//$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause." limit $offset, ".$this->perPage,false);
				$this->data['total'] = $output['total'] = print_count_query($stringQuery);

				$output['html'] =$this->load->view($this->_subView.'index_map',$this->data);
			
				if(empty($output['html'])){
					$output['html'] ='';
				}



			}
		}

		echo json_encode($output);
	}
	
	function ajax_map($page_type=false){	
	
		$output = array();
		$output['result']= 'error';
		
		$userArr =array();

		$where_clause1 = "";
		$where_clause2 = "";
		$where_clause3 = "";
		$url = '';
		$name = strtolower($this->input->get('f_name'));
		$l_name = strtolower($this->input->get('l_name'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$zip = strtolower($this->input->get('zip'));
		$employer = strtolower($this->input->get('employer'));
		if($name){
			$url .= 'f_name='.$name.'&';
			$where_clause1 .= " lower(f_name) like '".$name."%' and";
		}

		if($l_name){
			$url .= 'l_name='.$l_name.'&';
			$where_clause1 .= " lower(l_name) like '".$l_name."%'";
		}

		if($employer){
			$url .= 'employer='.$employer.'&';
			$where_clause2 .= " lower(employer_name) like '".$employer."%'";
		}

		if($city){
			$url .= 'city='.$city.'&';
			$where_clause3 .= " lower(city) like '".$city."%' and";
		}

		if($state){
			$url .= 'state='.$state.'&';
			$where_clause3 .= " lower(state) like '".$state."%' and";
		}

		if($zip){
			$url .= 'zip='.$zip.'&';
			$where_clause3 .= " lower(zip_code) like '".$zip."%' and";
		}

/*		echo $url;
		echo '<br>';*/
		$where_clause1 = rtrim($where_clause1,'and');
		$where_clause2 = rtrim($where_clause2,'and');
		$where_clause3 = rtrim($where_clause3,'and');

		$page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*20-20;
			//$offset = $page*2-2;
			$this->data['page_number'] = $page;
        }
		
		$this->data['total'] = $output['total'] = 0;
		if($_REQUEST){
			if($where_clause1 || $where_clause2 || $where_clause3){
				$output['result']= 'ok';
					$stringQuery = "SELECT 
					user_id, 
				    address_1,
				    city,
				    state,
				    cell_phone,
				    zip_code,
				    email_default AS email
					FROM (`final_address_contact_information`) WHERE ".$where_clause3;	
				//die;
				//$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause,false);
				//echo $stringQuery.$where_clause."";die;
				//echo $stringQuery.$where_clause." limit $offset ,$limit";die;
				$this->data['products'] = $this->comman_model->get_query($stringQuery,false);
				//$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause." limit $offset, ".$this->perPage,false);
				$this->data['total'] = $output['total'] = print_count_query($stringQuery);

				$output['html'] = $this->load->view($this->_subView.'ajax_search_map',$this->data,true);
				if(empty($output['html'])){
					$output['html'] ='';
				}

				$checkMoreD = $this->comman_model->get_query($stringQuery,false);
				

			}
		}
		else{
			$output['html'] = '';
		}
		$output['url']= site_url().'search/map?'.$url;
		$output['ajax_url']= site_url().'search/ajax_map?'.$url;
		
		echo json_encode($output);
	}
}
