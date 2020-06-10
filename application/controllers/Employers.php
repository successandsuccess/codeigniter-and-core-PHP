<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employers extends Frontend_Controller {
	public $_subView = 'templates/employers/';
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


	public function view($id=false){
		if(!$id){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$check_data = $this->data['list_data'] = $this->comman_model->get_by('final_employment_info',array('user_id'=>$id),false,true);
		if(!$check_data){
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view($this->_subView.'view',$this->data);
	}

	
	function ajax($page_type=false){	
	
		$output = array();
		$output['result']= 'error';
		

		$userArr =array();

		$where_clause = "";
		$url = '';

		$name = strtolower($this->input->get('name'));
		$address = strtolower($this->input->get('address'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$phone = strtolower($this->input->get('phone'));
		$email = strtolower($this->input->get('email'));
		$zip = strtolower($this->input->get('zip'));
		if($name){
			$where_clause .= " lower(employer_name) like '".$name."%' and";
		}
		$url .= 'name='.$name.'&';

		if($email){
			$where_clause .= " lower(employer_email) like '".$email."%' and";
		}
		$url .= 'email='.$email.'&';

		if($phone){
			$where_clause .= " lower(employer_phone) like '".$phone."%' and";
		}
		$url .= 'phone='.$phone.'&';

		if($city){
			$where_clause .= " LOWER(employer_city) like '".$city."%' and";
		}
		$url .= 'city='.$city.'&';

		if($address){
			$where_clause .= " LOWER(employer_address) like '%".$address."%' and";
		}
		$url .= 'address='.$address.'&';

		if($state){
			$where_clause .= " LOWER(employer_state) like '".$state."%' and";
		}
		$url .= 'state='.$state.'&';

		if($zip){
			$where_clause .= " LOWER(employer_zip) like '".$zip."%' and";
		}
		$url .= 'zip='.$zip.'&';

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
				// $stringQuery = "SELECT 
				// user_id, 
				// (SELECT f_name FROM final_generalinform WHERE user_id = (SELECT user_id FROM final_employment_info WHERE ". $where_clause .")) AS f_name,
				// (SELECT l_name FROM final_generalinform WHERE user_id = (SELECT user_id FROM final_employment_info WHERE ". $where_clause .")) AS l_name,
				// (SELECT email FROM users WHERE id=(SELECT user_id FROM final_employment_info WHERE ". $where_clause .")) AS email, 
				// (SELECT id_certificate FROM temp_stats WHERE user_id = (SELECT user_id FROM final_employment_info WHERE ". $where_clause .")) AS id_certificate,
				// (SELECT first_year FROM temp_stats WHERE user_id = (SELECT user_id FROM final_employment_info WHERE ". $where_clause .")) AS first_year,
				// employer_name,
				// employer_city,
				// employer_state,
				// (SELECT cdq_due FROM temp_stats WHERE user_id = (SELECT user_id FROM final_employment_info WHERE ". $where_clause .")) AS certificate_date
				// FROM (`final_employment_info`) WHERE ".$where_clause;	
				
				$stringQuery = "SELECT * FROM (`final_employment_info`) WHERE ".$where_clause;	
				
				//echo $stringQuery.$where_clause." limit $offset ,$limit";die;
				$this->data['products'] = $this->comman_model->get_query($stringQuery,false);
//				$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause." limit $offset, ".$this->perPage,false);
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
		$output['url']= site_url().'employers?'.$url;
		$output['ajax_url']= site_url().'employers/ajax?'.$url;
		
		echo json_encode($output);
	}

	public function map($id=false){

		if(!$id) {
			die('<center style="font-family:Circe;font-size: 17px;">There are no results for this search criteria.</center>');
		}
        $stringQuery = "SELECT * FROM (`final_employment_info`) WHERE employer_city = (SELECT employer_city FROM final_employment_info WHERE user_id = '". $id ."')";
    				
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

		$where_clause = "";
		$url = '';
		$name = strtolower($this->input->get('name'));
		$address = strtolower($this->input->get('address'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$phone = strtolower($this->input->get('phone'));
		$email = strtolower($this->input->get('email'));
		$zip = strtolower($this->input->get('zip'));
		if($name){
			$where_clause .= " lower(employer_name) like '".$name."%' and";
		}
		$url .= 'name='.$name.'&';

		if($email){
			$where_clause .= " lower(employer_email) like '".$email."%' and";
		}
		$url .= 'email='.$email.'&';

		if($phone){
			$where_clause .= " lower(employer_phone) like '".$phone."%' and";
		}
		$url .= 'phone='.$phone.'&';

		if($city){
			$where_clause .= " LOWER(employer_city) like '".$city."%' and";
		}
		$url .= 'city='.$city.'&';

		if($address){
			$where_clause .= " LOWER(employer_address) like '%".$address."%' and";
		}
		$url .= 'address='.$address.'&';

		if($state){
			$where_clause .= " LOWER(employer_state) like '".$state."%' and";
		}
		$url .= 'state='.$state.'&';

		if($zip){
			$where_clause .= " LOWER(employer_zip) like '".$zip."%' and";
		}
		$url .= 'zip='.$zip.'&';
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
				$stringQuery = "SELECT * FROM (`employers`) WHERE enabled =1 and  gps!='' and ";	
				//echo $stringQuery.$where_clause." limit $offset ,$limit";die;

				//limit data
//				$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause." limit $offset, ".$this->perPage,false);

				$this->data['products'] = $this->comman_model->get_query($stringQuery,false);
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
		$output['url']= site_url().'employers/map?'.$url;
		$output['ajax_url']= site_url().'employers/ajax_map?'.$url;
		
		echo json_encode($output);
	}
	
	function ajax_total_map($page_type=false){	
	
		$output = array();
		$output['result']= 'error';
		
		$userArr =array();

		$where_clause = "";
		$url = '';
		$name = strtolower($this->input->get('name'));
		$address = strtolower($this->input->get('address'));
		$city = strtolower($this->input->get('city'));
		$state = strtolower($this->input->get('state'));
		$phone = strtolower($this->input->get('phone'));
		$email = strtolower($this->input->get('email'));
		$zip = strtolower($this->input->get('zip'));
		if($name){
			$where_clause .= " lower(employer_name) like '".$name."%' and";
		}
		$url .= 'name='.$name.'&';

		if($email){
			$where_clause .= " lower(employer_email) like '".$email."%' and";
		}
		$url .= 'email='.$email.'&';

		if($phone){
			$where_clause .= " lower(employer_phone) like '".$phone."%' and";
		}
		$url .= 'phone='.$phone.'&';

		if($city){
			$where_clause .= " LOWER(employer_city) like '".$city."%' and";
		}
		$url .= 'city='.$city.'&';

		if($address){
			$where_clause .= " LOWER(employer_address) like '%".$address."%' and";
		}
		$url .= 'address='.$address.'&';

		if($state){
			$where_clause .= " LOWER(employer_state) like '".$state."%' and";
		}
		$url .= 'state='.$state.'&';

		if($zip){
			$where_clause .= " LOWER(employer_zip) like '".$zip."%' and";
		}
		$url .= 'zip='.$zip.'&';
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
					$stringQuery = "SELECT * FROM (`final_employment_info`) WHERE ".$where_clause;	
				
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

}
