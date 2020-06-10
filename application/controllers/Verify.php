<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify extends frontend_Controller {

 	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('users_model','email_model'));


	}

	function user($key=false,$id= false){
		if($key and $id){

			//check $id : id by md5 and key : comfirm field data from users table
			
			$show = $this->users_model->check_user($id,$key);
			if($show=='error'){//sometime error
				$this->session->set_flashdata('error', 'Sorry You have something mistake');
			}
			else if($show=='verified'){//already verified
				$this->session->set_flashdata('error', 'You have already verified.');				
			}
			else {
				// if user set verified then send mail to admin 
				//get email data to id=2  from email table
				$email_data = $this->comman_model->get_by('email',array('id'=>2),false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);

				$email_data->message = str_replace('{user_name}', $show['username'], $email_data->message);
				$email_data->message = str_replace('{user_email}', $show['email'], $email_data->message);
				$email_data->message = str_replace('{user_password}', $show['password'], $email_data->message);
				//echo $email_data->message ;die;
				$send_data = array('to_email'=>$this->data['settings']['site_email'],'from_email'=>$this->data['settings']['site_email'],'from_name'=>$this->data['settings']['site_name'],'subject'=>$email_data->subject,'html'=>$email_data->message);
				$this->email_model->send_mail_in_ci($send_data);

				if($show['account_type']=='U'){
					$session_data = array(
							'loginType' => 'user',
						  	'loggedin' => true,				   
						   	'name' =>$show['username'],
						   	'id' =>$show['id']);				
					//$total = $login['bonus_balance']+10;
					$this->session->sess_expiration = '14400'; 
					
					$this->session->set_userdata('user_session',$session_data);	
				}
//				printR($show);
				$this->session->set_flashdata('success', 'Your application has been received. An accounts specialist will be in touch with you shortly!');				
				redirect('secure/login');
			}
			redirect('secure/login');
		}
	}
}
