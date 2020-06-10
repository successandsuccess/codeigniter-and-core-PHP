<?php

class Program_model extends MY_Model {
    protected $_table_name = 'programs';		//set table
    protected $_order_by = 'id';	//set order

	//set rules
    public $rules = array(
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'description' => array('field'=>'description', 'label'=>'Description', 'rules'=>'trim'),
   );
   
   public $rules_lang = array();
   
    public function __construct(){
        parent::__construct();
   }

	//set a new one
    public function get_new()
    {
        $page = new stdClass();
        $page->parent_id = 0;
        $page->name = '';
        $page->link = '';
        $page->description ='';
        return $page;
    }
    
}



