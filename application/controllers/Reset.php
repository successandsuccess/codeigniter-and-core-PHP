<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends Frontend_Controller {
	public $_subView = 'home/account/';
	public $_tableName = 'users';
	
	/**
     * Default constructor
     */
    function __construct() {
        parent::__construct();
    }

	
	public function verify($id,$code){
		if($id&&$code){
		}
		else{
			redirect('secure/login');
		}
		$checkEmail = $this->comman_model->get_by($this->_tableName,array('md5(id)'=>$id,'reset_password'=>$code),false,true);
		if($checkEmail){
		}
		else{
			redirect('reset/invalid_code');
		}
		$rules = array(
                    'new_password' =>array('field'=>'new_password','label'=>'new_password','rules'=>'trim|required'),
				); 
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE){
			$this->db->where('id', $checkEmail->id);
			$this->db->set('reset_password','', true);
			$this->db->set('password',$this->input->post('new_password'), true);
			$this->db->update($this->_tableName);
			redirect('reset/success');
		}
		
		$this->load->view($this->_subView.'reset_password',$this->data);
	}
	
	public function success(){
		$this->load->view($this->_subView.'reset_success',$this->data);
	}

	public function invalid_code(){
		$this->load->view($this->_subView.'reset_error',$this->data);
	}
	
}
