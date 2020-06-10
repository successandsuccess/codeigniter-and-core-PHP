<?php

class Offers_model extends MY_Model {
    protected $_table_name = 'offers_questions'; //table name
    protected $_order_by = 'parent_id, order, id';//set order field
    public $rules = array();
   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
                                  
	}

	function get_product_options($product_id,$level=false){		
		$this->db->where('offer_id',$product_id); 
		if($level){
			$this->db->where('level',$level); 
		}
		$this->db->order_by('order', 'ASC');
		
		$result	= $this->db->get($this->_table_name);
		
		$return = array();
		foreach($result->result() as $option)
		{
			$return[]	= $option;
		}
		return $return;
	}

	function save_option($data,$level,$id){
		//delete
		if(!empty($data)){
			$deleteArray = array();
			foreach($data as $set_option){
				if(isset($set_option['id'])&&!empty($set_option['id'])){
					$deleteArray[] =$set_option['id'];
				}
			}
			if($deleteArray){
				$this->db->where_not_in('id',$deleteArray);
				$this->db->where('level',$level);
				$this->db->where('offer_id',$id);
				$this->db->delete($this->_table_name);
			}
		}

		//echo '<pre>';
		//print_r($deleteArray);
		//print_r($data);
		$count = 1;
		foreach ($data as $option)
		{
			$option['offer_id'] = $id;
			$option['order'] = $count;
			$option['level'] = $level;
			if(isset($option['values'])&&!empty($option['values'])){
				$option['values'] = implode(',',$option['values']);
			}
			
			if(isset($option['id'])&&!empty($option['id'])){
				$this->db->where('id', $option['id']);
				$this->db->update($this->_table_name, $option);
			}
			else{
				unset($option['id']);
				$this->db->insert($this->_table_name, $option);
				$this->db->insert_id();
			}
			$count++;
		}
	}

	function save_option_value($data,$user_id){
/*		echo '<pre>';
		print_r($_FILES);*/
		//echo '<pre>';
			//print_r($data);

        // There was errors, we have to delete the uploaded files
		foreach ($data as $option=>$value){
			$array = array(
						'form_id'=>$user_id,
						'field_id'=>$option,
						'value'=>$value,
						
						);
			if(is_array($value)){
				$array['value'] =  implode(',',$value['mult']);
			}
			else{
				$array['value'] =  $value;
			}
			//print_r($array);

			$this->db->insert('widgets_form_filled', $array);
		}
		return true;
	}
	
}


