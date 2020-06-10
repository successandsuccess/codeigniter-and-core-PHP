<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_contact extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('email_model'));

	}
	

	function send_contact(){
		$rel = array();
		$rel['status']= "error";
		$rel['msg']= '';
		$lang_id = 1;
		if($this->input->post('email')){
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL) === false) {
				$email_data = $this->comman_model->get_by('email',array('id'=>4),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->subject);
		
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{name}', $this->input->post('user_name'), $email_data->message);
				$email_data->message = str_replace('{phone}', $this->input->post('phone'), $email_data->message);
				//$email_data->message = str_replace('{subject}', $this->input->post('subject'), $email_data->message);
				$email_data->message = str_replace('{email}', $this->input->post('email'), $email_data->message);
				$email_data->message = str_replace('{message}', $this->input->post('messege'), $email_data->message);
				$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);
				
				$send_data = array('to_email'=>$this->data['settings']['site_email'],'from_email'=>$this->input->post('email'),'from_name'=>$this->input->post('user_name'),'subject'=>$email_data->subject,'html'=>$email_data->message);
				$this->email_model->send_mail_in_ci($send_data);
										
				$rel['status']= "ok";
				$rel['msg']="<p style='color:#0F0'>".show_static_text($lang_id,199)."</p>";
			}
			else{
				$rel['msg']= "<p style='color:#F00'>".show_static_text($lang_id,201)."</p>";
			}
		}
		else{
			$rel['msg']= "<p style='color:#F00'>".show_static_text($lang_id,202)."</p>";
		}
		echo json_encode($rel);
	}

	function save_newsletter(){
		if($this->input->post('newsEmail')){
			$email = $this->input->post('newsEmail');
			$check =$this->comman_model->get_by('users_email',array('email'=>$email),false,false);
			if($check){
				echo '2';
			}
			else{
				$this->comman_model->save('users_email',array('email'=>$email));
				echo "1";
			}
		}
		
		
		//redirect($_SERVER['HTTP_REFERER']);
	}	

}
