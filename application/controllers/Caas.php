<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caas extends Frontend_Controller {
	public $_subView = 'templates/caas/';
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
	

	public function v($id=false){
		if(!$id){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$check_data = $this->data['user_data'] = $this->comman_model->get_by('users',array('id'=>$id),false,true);
		$this->data['caa_data'] = $this->comman_model->get_by('temp_stats',array('user_id'=>$id),false,true);
		$this->data['grad_date'] = $this->comman_model->get_by('final_program_university_info',array('user_id'=>$id),false,true);
		
		if(!$check_data){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$this->data['title'] =$this->data['settings']['site_name'];
		$this->load->view($this->_subView.'view_certificate',$this->data);
	}
		
	public function view($id=false){
		if(!$id){
			die('no data');
		}
		$check_data = $this->data['list_data'] = $this->comman_model->get_by('final_address_contact_information', array('user_id'=>$id),false,true);
		$this->data['user_data'] = $this->comman_model->get_by('users',array('id'=>$id),false,true);
		
		if(!$check_data){
			die('no data');
		}
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view($this->_subView.'view',$this->data);
	}

	function ajax($page_type=false){	
	
		$output = array();
		$output['result']= 'error';
		
/*		$years = $this->input->get('years');
		$age = $this->input->get('age');
		$gender = $this->input->get('gender');
*/
		$userArr =array();

		$where_clause1 = "";
		$where_clause2 = "";
		$where_clause3 = "";
		$url = '';
		$name = strtolower($this->input->get('f_name'));
		$l_name = strtolower($this->input->get('l_name'));
		$address = strtolower($this->input->get('address'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$phone = strtolower($this->input->get('phone'));
		$email = strtolower($this->input->get('email'));
		$zip = strtolower($this->input->get('zip'));
		if($name){
			$where_clause1 .= " LOWER(f_name) like '".$name."%' and";
		}
		$url .= 'f_name='.$name.'&';

		if($l_name){
			$where_clause1 .= " LOWER(l_name) like '".$l_name."%'";
		}
		$url .= 'l_name='.$l_name.'&';

		if($email){
			$where_clause2 .= " lower(email_default) like '".$email."%' and";
		}
		$url .= 'email='.$email.'&';

		if($phone){
			$where_clause2 .= " lower(cell_phone) like '".$phone."%' and";
		}
		$url .= 'phone='.$phone.'&';

		if($address){
			$where_clause2 .= " LOWER(address_1) like '%".$address."%' and";
		}
		$url .= 'address='.$address.'&';


		if($city){
			$where_clause2 .= " LOWER(city) like '".$city."%' and";
		}
		$url .= 'city='.$city.'&';

		if($state){
			$where_clause2 .= " LOWER(state) like '".$state."%' and";
		}
		$url .= 'state='.$state.'&';

		if($zip){
			$where_clause2 .= " LOWER(zip_code) like '".$zip."%' and";
		}
		$url .= 'zip='.$zip.'&';

/*
		if($age){
			$where_clause .= " age='".$age."' and";
		}
		$url .= 'age='.$age.'&';

		if($years){
			$where_clause .= " years='".$years."' and";
		}
		$url .= 'years='.$years.'&';

		if($gender){
			$where_clause .= " gender='".$gender."' and";
		}
		$url .= 'gender='.$gender.'&';*/


/*		echo $url;
		echo '<br>';*/
		$where_clause1 = rtrim($where_clause1,'and');
		$where_clause2 = rtrim($where_clause2,'and');

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
			if($where_clause1 || $where_clause2){
				$output['result']= 'ok';
                if(empty($where_clause1) == false){
					$stringQuery = "SELECT * FROM (`final_generalinform`) WHERE ".$where_clause1;	
					
				}
                if(empty($where_clause2) == false){
					$stringQuery = "SELECT * FROM (`final_address_contact_information`) WHERE ".$where_clause2;	
					
				}
				
				$obj = $this->comman_model->get_query($stringQuery,false);
				$member_cert_id = array();
				$member_fullname = array();
				if($obj){
	                    for($i = 0; $i < count($obj); $i++){
	                        
	                        $member_cert_id[$i] = $this->comman_model->get_by('temp_stats',array('user_id'=>$obj[$i]->user_id),false,true);
	                        $member_fullname[$i] = $this->comman_model->get_by('final_generalinform',array('user_id'=>$obj[$i]->user_id),false,true);
	                    }
				}
				

				$this->data['member_cert_id'] = $member_cert_id;

                $this->data['member_fullname'] = $member_fullname;
                
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
		$output['url']= site_url().'caas?'.$url;
		$output['ajax_url']= site_url().'caas/ajax?'.$url;
		
		echo json_encode($output);
	}



	public function map($id=false){

		if(!$id) {
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
        $stringQuery = "SELECT 
    					user_id, 
    				    address_1,
    				    city,
    				    state,
    				    cell_phone,
    				    zip_code,
    				    email_default AS email
    					FROM (`final_address_contact_information`) WHERE city = (SELECT city FROM final_address_contact_information WHERE user_id = '". $id ."')";
    				
    	$check_data = $this->data['products'] = $this->comman_model->get_query($stringQuery,false);

		
		if(!$check_data){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$this->data['title'] =$this->data['settings']['site_name'];
		$this->load->view($this->_subView.'index_map',$this->data);
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
		$address = strtolower($this->input->get('address'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$phone = strtolower($this->input->get('phone'));
		$email = strtolower($this->input->get('email'));
		$zip = strtolower($this->input->get('zip'));
		if($name){
			$where_clause1 .= " LOWER(f_name) like '".$name."%' and";
		}
		$url .= 'f_name='.$name.'&';

		if($l_name){
			$where_clause1 .= " LOWER(l_name) like '".$l_name."%'";
		}
		$url .= 'l_name='.$l_name.'&';

		if($email){
			$where_clause2 .= " lower(email) like '".$email."%' ";
		}
		$url .= 'email='.$email.'&';

		if($phone){
			$where_clause3 .= " lower(cell_phone) like '".$phone."%' and";
		}
		$url .= 'phone='.$phone.'&';

		if($address){
			$where_clause3 .= " LOWER(address_1) like '%".$address."%' and";
		}
		$url .= 'address='.$address.'&';


		if($city){
			$where_clause3 .= " LOWER(city) like '".$city."%' and";
		}
		$url .= 'city='.$city.'&';

		if($state){
			$where_clause3 .= " LOWER(state) like '".$state."%' and";
		}
		$url .= 'state='.$state.'&';

		if($zip){
			$where_clause3 .= " LOWER(zip_code) like '".$zip."%' and";
		}
		$url .= 'zip='.$zip.'&';

		$where_clause1 = rtrim($where_clause1,'and');
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
				$stringQuery = "SELECT * FROM (`caas`) WHERE enabled =1 and  gps!='' and ";	
				//die;
				//$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause,false);
				//echo $stringQuery.$where_clause."";die;
				//echo $stringQuery.$where_clause." limit $offset ,$limit";die;
				$this->data['products'] = $this->comman_model->get_query($stringQuery,false);
//				$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause." limit $offset, ".$this->perPage,false);
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
		$output['url']= site_url().'caas/map?'.$url;
		$output['ajax_url']= site_url().'caas/ajax_map?'.$url;
		
		echo json_encode($output);
	}
	
	function ajax_total_map($page_type=false){	

		$output = array();
		$output['result']= 'error';
		
		$userArr =array();

		$where_clause1 = "";
		$where_clause2 = "";
		$url = '';
		$name = strtolower($this->input->get('f_name'));
		$l_name = strtolower($this->input->get('l_name'));
		$address = strtolower($this->input->get('address'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$phone = strtolower($this->input->get('phone'));
		$email = strtolower($this->input->get('email'));
		$zip = strtolower($this->input->get('zip'));
		if($name){
			$where_clause1 .= " LOWER(f_name) like '".$name."%' and";
		}
		$url .= 'f_name='.$name.'&';

		if($l_name){
			$where_clause1 .= " LOWER(l_name) like '".$l_name."%'";
		}
		$url .= 'l_name='.$l_name.'&';

		if($email){
			$where_clause2 .= " lower(email_default) like '".$email."%' ";
		}
		$url .= 'email='.$email.'&';

		if($phone){
			$where_clause2 .= " lower(cell_phone) like '".$phone."%' and";
		}
		$url .= 'phone='.$phone.'&';

		if($address){
			$where_clause2 .= " LOWER(address_1) like '%".$address."%' and";
		}
		$url .= 'address='.$address.'&';


		if($city){
			$where_clause2 .= " LOWER(city) like '".$city."%' and";
		}
		$url .= 'city='.$city.'&';

		if($state){
			$where_clause2 .= " LOWER(state) like '".$state."%' and";
		}
		$url .= 'state='.$state.'&';

		if($zip){
			$where_clause2 .= " LOWER(zip_code) like '".$zip."%' and";
		}
		$url .= 'zip='.$zip.'&';

		$where_clause1 = rtrim($where_clause1,'and');
		$where_clause2 = rtrim($where_clause2,'and');

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
			if(empty($where_clause1) == false){
				$stringQuery = "SELECT * FROM (`final_generalinform`) WHERE ".$where_clause1;	
				
				$obj = $this->comman_model->get_query($stringQuery,false);
				$member_user_id = array();
				if($obj){
					for($i = 0; $i < count($obj); $i++){
						
						$member_info[$i] = $this->comman_model->get_by('final_address_contact_information',array('user_id'=>$obj[$i]->user_id),false,true);
					}
					
					$check_data = $this->data['products'] = $member_info;
				}

			}else if(empty($where_clause2) == false){
			    
				$stringQuery = "SELECT * FROM (`final_address_contact_information`) WHERE ".$where_clause2;	
				
				$check_data = $this->data['products'] = $this->comman_model->get_query($stringQuery,false);
			
			}
		
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

		echo json_encode($output);
	}

}

