<?php
function h_c_match_results($data){
	$output = array();
	if($data){
		foreach($data as $set){
			$output[] = array(
								'<tr data-name="W1"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W1</td></tr>',
								'<tr data-name="W2"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W2</td></tr>',
								'<tr data-name="W0"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W0</td></tr>',
							);
		}
	}
	return $output;
}


function get_combinations_data($arrays) {
	$counts = array_map("count", $arrays);
	$total = array_product($counts);
	
	$combinations = array();
	$curCombs = $total;
	
	foreach ($arrays as $field => $vals) {
		$curCombs = $curCombs / $counts[$field];
		$combinations[$field] = $curCombs;
	}
	$result = array('total'=>$total,'data'=>$combinations,'counts'=>$counts);
	return $result;
}


function get_combinations_result_data($arrays,$combinations,$total,$counts,$per_page=false,$q=false){
/*	echo $total;
	printR($arrays);
	printR($combinations);
*/	
	$perpage = 0;
	$set_total = $total;
	if($per_page>0){
		$perpage =$per_page;
	}
/*	if($total>2){
		$set_total = 100;
		$set_total = 100;
	}*/

	$res = array();
	$set_i=0;
	for ($i = $perpage; $i < $set_total; $i++) {
		$stringsArr = array();
		$set_i++;
		if($set_i>100){
			break;
		}
		foreach ($arrays as $field => $vals) {
			//echo ($i / $combinations[$field]) % $counts[$field];
			if(($i / $combinations[$field]) % $counts[$field]=='0'){
				$stringsArr[] = 'W1';
			}
			elseif(($i / $combinations[$field]) % $counts[$field]=='1'){
				$stringsArr[] = 'W2';
			}
			else{
				$stringsArr[] = 'W0';
			}
			$res[$i][$field] = $vals[($i / $combinations[$field]) % $counts[$field]];
		}

		$strings = implode(', ',$stringsArr);
		if($q){
			//echo '<br>'.$q.' '.$string;
			if(stristr($strings,$q)){}
			else{
				array_pop($res);
			}
		}
		
	}
	return $res;	
	
}

function h_c_match_results_with_combination($data){
	$output = array();
	if($data){
		foreach($data as $set){
			if($set['result']=='W1'){
				$output[] = array(
								'<tr data-name="W1"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W1</td></tr>',
							);
			}
			else if($set['result']=='W2'){
				$output[] = array(
								'<tr data-name="W2"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W2</td></tr>',
							);
			}
			else if($set['result']=='W0'){
				$output[] = array(
								'<tr data-name="W0"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W0</td></tr>',
							);
			}
			else if($set['result']=='W1W2'){
				$output[] = array(
								'<tr data-name="W1"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W1</td></tr>',
								'<tr data-name="W2"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W2</td></tr>',
							);
			}
			else if($set['result']=='W1W0'){
				$output[] = array(
								'<tr data-name="W1"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W1</td></tr>',
								'<tr data-name="W0"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W0</td></tr>',
							);
			}
			else if($set['result']=='W2W0'){
				$output[] = array(
								'<tr data-name="W2"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W2</td></tr>',
								'<tr data-name="W0"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W0</td></tr>',
							);
			}
			else{
				$output[] = array(
								'<tr data-name="W1"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W1</td></tr>',
								'<tr data-name="W2"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W2</td></tr>',
								'<tr data-name="W0"><td>'.$set['team_a'].'</td><td>'.$set['team_b'].'</td><td>W0</td></tr>',
							);
			}
			
		}
	}
	return $output;
}
