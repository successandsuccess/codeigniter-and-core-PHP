<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register extends Frontend_Controller{
	public $_subView = 'home/account/';
	public function __construct(){
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->helper(array('date','string'));	
		$this->load->model(array('register_model','email_model'));
        $this->data['_cancel'] = 'register';
	}

	function index(){//for register 
		$this->load->library('form_validation');

		//set rules
		$rules = $this->register_model->register;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('matches',show_static_text(1,213));
		$this->form_validation->set_message('is_unique',show_static_text(1,220));
		$this->form_validation->set_message('integer',show_static_text(1,221));
		$this->form_validation->set_message('required', show_static_text(1,219));

		//process from
		if ($this->form_validation->run() == true){
			//get post data
			$post_data = $this->comman_model->array_from_post(array('first_name','last_name','email','password','phone','address'));
			$check_api_email = $this->_check_email_api($post_data['email']);
			if($check_api_email=='ok'){
			}
			else{
				$this->session->set_flashdata('error','Please enter a valid email');
				redirect('register');
			}

			
			$post_data['account_type'] = 'U';
			$post_data['status'] = 1;
		
			$dynamic_code =  random_string('alnum', 16);  
			$post_data['confirm'] = $dynamic_code;
			$post_data['username'] = $post_data['first_name'].' '.$post_data['last_name'];
		
			//check email id
			$checkEmail = $this->comman_model->get_by('users',array('email'=>$post_data['email']),false,false);
			if($checkEmail){
				$this->session->set_flashdata('error','Sorry! Email already exist.');
				redirect($this->data['_cancel']);
			}
			
			//insert data
			$post_data['date_added'] =date('Y-m-d H:i:s');
			$registerForm = $this->comman_model->save('users',$post_data);
			h_AddNumber('users',$registerForm,'rand_id',2000,'A');
			
			//send register email verification
			$email_data = $this->comman_model->get_by('email',array('id'=>1),false,true);
						
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{user_name}', $post_data['first_name'], $email_data->subject);
		
			$email_data->message = str_replace('{user_name}', $post_data['first_name'], $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
			$email_data->message = str_replace('{site_link}', base_url().'verify/user/'.$dynamic_code.'/'.md5($registerForm), $email_data->message);
			//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
			$send_data = array('to_email'=>$post_data['email'],'from_email'=>$this->data['settings']['site_email'],'from_name'=>$this->data['settings']['site_name'],'subject'=>$email_data->subject,'html'=>$email_data->message);
			$this->email_model->send_mail_in_smtp($send_data);
		
			$this->session->unset_userdata('user_reg');
			$this->session->set_flashdata('success', 'Thank you! <br>
A verification email has been sent to you, please check your inbox or spam folders for further details. If you do not receive an email in 30 minutes, you probably entered a wrong email. Try filling the form again.');
			//$this->session->set_flashdata('success', show_static_text(1,216));
		
			redirect($this->data['_cancel'].'/success');
		}
		
		//set titile
		$this->data['title'] = 'Register | '.$this->data['settings']['site_name'];

		//set load view
		$this->load->view($this->_subView.'register',$this->data);
	}

	function success(){
		$this->load->view($this->_subView.'register_success',$this->data);
	}

	function _check_email_api($email=false){
//		$email = $this->input->get('email');
		$output = 'error';
		if($email){
			$key = "HJFDYpRFsTWkVZceZZZhq";
			$url = "https://apps.emaillistverify.com/api/verifyEmail?secret=".$key."&email=".$email;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}
		return $output;
	}

	function register_email_exists(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		if (array_key_exists('email',$_GET)) {
			if ( $this->email_exists($this->input->get('email')) == TRUE ) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}	

	private function email_exists($email){
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
	}


}
