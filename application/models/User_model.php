<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	public $page_login = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    
                    ); 


	public $create_admin = array(
                    'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
                    'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|integer|required'),
                    'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim'),
                    'city' =>array('field'=>'city','label'=>'City','rules'=>'trim'),
                    'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim'),
                    );
    
	public $update_admin = array(
                    'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
                    'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
                    'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|integer|required'),
                    'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim'),
                    'city' =>array('field'=>'city','label'=>'City','rules'=>'trim'),
                    'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim'),
                    );
    

    public $rules_password =  array(
              'old_password'=> array(
                     'field'   => 'old_password',
                     'label'   => 'Old Password',
                     'rules'   => 'trim|required|callback__check_old_password'
                  ),
              'password'=> array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
              'password_confirm'=> array(
                     'field'   => 'password_confirm',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim|required|matches[password]'
                  ));

    public $update_rules = array(
			'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
			'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
			'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|required|integer'),
			'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
			'city' =>array('field'=>'city','label'=>'City','rules'=>'trim|required'),
   );

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	   
					
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>