<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends Frontend_Controller{
	public $_subView = 'home/account/';
	public function __construct(){
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->helper(array('date','string'));	
		$this->load->model(array('register_model','email_model'));
        $this->data['_cancel'] = 'login';
	}

	//for login page
	function index(){
		$this->data['set_meta'] = 'login';
		$this->data['active'] = "login";
		$this->data['login'] = $this->session->all_userdata();
		//$data['message'] = $this->session->flashdata('success');

        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$rules = $this->register_model->page_login;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE){
			$send = array('email' => $this->input->post('email'),'password'=>$this->input->post('password'),'account_type'=>'U');
			$login = $this->comman_model->get_by('users',$send,false,true);
			if(!empty($login)){
				//check email verfied or not
				if($login->confirm!='confirm'){
					$this->session->set_flashdata('error',show_static_text(1,222));
					redirect($this->data['_cancel']);
				}
				else if($login->status!=1){
					$this->session->set_flashdata('error',show_static_text(1,223));
					redirect($this->data['_cancel']);
				}
				else{
					//set user session
					$logged_id = $this->_log_session($login->id);				
					$session_data = array(
							'logged_id' => $logged_id,
							'loginType' => 'user',
						  	'loggedin' => true,				   
						   	'name' =>$login->username,
						   	'email' =>$login->email,
						   	'id' =>$login->id);				
					//$total = $login['bonus_balance']+10;
					$this->session->sess_expiration = '14400'; 
					
					$this->session->set_userdata('user_session',$session_data);
					
					$this->session->set_userdata('offer_random',random_string('numeric',4));
					redirect('user','refresh');				
				}
			}
			else{
				$this->session->set_flashdata('error', show_static_text(1,224));
				redirect($this->data['_cancel']);
			}
		}
        $this->data['subview'] = $this->_subView.'login';	
		//$this->load->view('templates/_layout_main',$this->data);
		$this->load->view($this->_subView.'login',$this->data);
	}

	function _log_session($id=false){
		if($id){
			if ($this->agent->is_browser()){
				$agent = $this->agent->browser();
	//			$agent = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot()){
				$agent = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile()){
				$agent = $this->agent->mobile();
			}
			else{
				$agent = 'Unidentified';
			}
			$this->db->insert('users_log',array(
									'browser_name'	=> $agent,
									'user_id'		=> $id,
									'ip_address'	=> $this->input->ip_address(),
									'on_date'		=> date('Y-m-d'),
									'on_datetime'	=> date('Y-m-d H:i:s'),
									));
			return $this->db->insert_id();
		}
		return false;
	}

}
