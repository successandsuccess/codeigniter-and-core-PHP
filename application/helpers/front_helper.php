<?php
function format_telephone($phone_number)
{
    $cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
    preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
    return "{$matches[1]}-{$matches[2]}-{$matches[3]}";
}

function h_AddNumber($table,$id,$order_field,$number,$set_alfa=false){
	$CI =& get_instance();
	$order_number =	$number+$id;
	$CI->db->where('id',$id);
	if($set_alfa){
		$CI->db->set($order_field, $set_alfa.$order_number,TRUE);
	}
	else{
		$CI->db->set($order_field, $order_number,TRUE);
	}
	$CI->db->update($table);
	
	return $order_number;
}

function h_youtube_id($url){
	$youtube_id = '';
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
	if(isset($match[1])){
		$youtube_id = $match[1];
	}
	return $youtube_id;
}
function checkPermission($table,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,true);
	if($check){
		return 1;
	}
	else{
		return 0;
	}
}
if ( ! function_exists('h_gDatesByweek')){
	function h_gDatesByweek($sDate,$eDate,$week,$format){
		$arr =array();
		$endDate = strtotime($eDate);
		for($i = strtotime($week, strtotime($sDate)); $i <= $endDate; $i = strtotime('+1 week', $i)){
			$arr[] = date($format, $i);
		}
		return $arr;
	}
}
if ( ! function_exists('h_addDate')){
	function h_addDate($date,$type,$count,$format){
		$string = strtotime($date);
		if($type=='month'){
			$string =strtotime('+'.$count.' day', $string);
		}
		else{
			$string =strtotime('+'.$count.' day', $string);
		}
		$new_date = date($format,$string);
		return $new_date;
	}
};
if ( ! function_exists('h_dateFormat')){
	function h_dateFormat($date,$format){
		$new_date = date($format,strtotime($date));
		return $new_date;
	}
};

function h_orderNumber($table,$orderName,$digit){
	$CI =& get_instance();
	$CI->db->order_by('id','desc'); 
	$CI->db->limit('1'); 
	$order_num_data = $CI->comman_model->get($table,true);
/*	echo '<pre>';
print_r($order_num_data);*/
	if($order_num_data){
		$order_number =	$orderName.str_pad($order_num_data->id+1, $digit, '0', STR_PAD_LEFT);
	}else{
		$order_number = $orderName.str_pad(1, $digit, '0', STR_PAD_LEFT);
	}
	return $order_number;
}

function h_updateNumber($table,$id,$order_field,$digit){
	$CI =& get_instance();
	$order_number =	str_pad($id, $digit, '0', STR_PAD_LEFT);
	$CI->db->where('id',$id);
	$CI->db->set($order_field, $order_number,TRUE);
	$CI->db->update($table);
	
	return $order_number;
}

function h_NumberShow($id,$digit){
	$CI =& get_instance();
	$order_number =	str_pad($id, $digit, '0', STR_PAD_LEFT);
	
	return $order_number;
}

function printR($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
	function getallDate($year){
		$list  = array();
		for($ds=1; $ds<=12; $ds++){
			for($d=1; $d<=31; $d++){
				$time=mktime(12, 0, 0, $ds, $d, $year);          
				if (date('m', $time)==$ds)       
					$list[]=date('Y-m-d', $time);
			}
		}
		return $list;
	}
function getDates($year)
{
    $dates = array();
    for($i = 1; $i <= 366; $i++){
        $month = date('m', mktime(0,0,0,1,$i,$year));
        $wk = date('W', mktime(0,0,0,1,$i,$year));
        $wkDay = date('D', mktime(0,0,0,1,$i,$year));
        $day = date('d', mktime(0,0,0,1,$i,$year));
        $dates[$month][$wk][$day] = $wkDay;
    } 
    return $dates;   
}
function numberFormat($number){
	return number_format((float)$number, 2, '.', '');
}
function sumOfArray(){	
	$sumArray = 0;	
	foreach ($myArray as $k=>$subArray) {
	  foreach ($subArray as $id=>$value) {
		$sumArray = $value+$sumArray;
	  }
	}
	return $sumArray;
}
function show_static_text($lang,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by('static_text',array('id'=>$array),false,true);
	if($check){
		return $check->name;
	}
	else{
		return '';
	}
}
function show_field_value($lang,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang('field_values',$lang,NULL,$array,'field_value_id',true);
	if($check){
		return $check->title;
	}
	else{
		return '-';
	}
}
function print_lang_value($table,$lang,$array,$field_id,$show){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang($table,$lang,NULL,$array,$field_id,true);
	if($check){
		return $check->$show;
	}
	else{
		return '-';
	}
}
function print_value_id($table,$array,$show,$default=false){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,true);
	if($check){
		return $check->$show;
	}
	else{
		if($default)
			return $default;
		else
			return 0;
	}
}
function print_value($table,$array,$show,$default=false){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,true);
	if($check){
		return $check->$show;
	}
	else{
		if($default)
			return $default;
		else
			return '-';
	}
}
function print_count($table,$array=false){
	$CI =& get_instance();
	if($array)
		$CI->db->where($array);
	$CI->db->from($table);
	return $CI->db->count_all_results();
}
function print_count_query($string){
	$CI =& get_instance();
	$result = $CI->db->query($string);
	return $result->num_rows();
}

if ( ! function_exists('time_elapsed_string')){
	function time_elapsed_string($dt,$precision=2){
		$times=array(   365*24*60*60    => "year",
						30*24*60*60     => "month",
						7*24*60*60      => "week",
						24*60*60        => "day",
						60*60           => "hour",
						60              => "minute",
						1               => "second");
		$passed=time()-$dt;
		if($passed<5){
			$output='less than 5 seconds ago';
		}
		elseif($passed > 172800){
			 $output=date("d F, Y",$dt);
		}
		else{
			$output=array();
			$exit=0;
			foreach($times as $period=>$name){
				if($exit>=$precision OR ($exit>0 && $period<60)) break;
				$result = floor($passed/$period);
				if($result>0){
					$output[]=$result.' '.$name.($result==1?'':'s');
					$passed-=$result*$period;
					$exit++;
				}
				else
					if($exit>0)
						$exit++;
			}
			$output=implode(', ',$output).' ago';
		}
		return $output;
	  }
}