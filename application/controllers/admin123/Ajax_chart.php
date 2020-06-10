<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_chart extends Admin_Controller {
	public function __construct(){
		parent::__construct();
	}


	function ajax_demo(){
//if (!$this->input->is_ajax_request()) { exit('no valid req.'); }
		$id = $this->input->post('type');
		//$id = 'year';
		$where1  = "on_date > '".date('Y-m-d', strtotime('-30 day',time()))."'";
		$array = array();
		$value = array();
		$query = "SELECT on_date, COUNT(id) AS id
						FROM programs_click
						WHERE  ".$where1." GROUP BY on_date ORDER BY on_date asc";
		$result = $this->comman_model->get_query($query,false);
			//printR($result);
		if(!empty($result)){
			foreach($result as $set_data){
				if(!empty($set_data->on_date)){
					$array[] = h_dateFormat($set_data->on_date,'d-m-Y');
					$value[] = $set_data->id;
				}	
			}
		}
		if(empty($array)){
			$array[] = date('d-m-Y');
			$value[] = 0;
		}
		$goal_data = array(
					'label'=>'A',
					'borderColor'=>'#ff5b57',
					'backgroundColor'=> '#ff5b57',
					'fill'	=> false,
                    'steppedLine'=>true,
					);		
		$goal_data['data'] =$value;
		$output = array('labels'=>$array,'chart_data'=>array($goal_data));
		echo json_encode($output);
	}

	
}

