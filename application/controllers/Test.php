<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends Frontend_Controller {
	public $_subView = 'templates/caas/';
	public function __construct(){
		parent::__construct();
        $this->perPage = 20;
	}

	public function get_list(){
		$all_data = $this->comman_model->get('caas',false);
		if($all_data){
			foreach($all_data as $set_d){
				$this->db->where('id',$set_d->id);
				$this->db->set('gps',$set_d->gps,true);
				$this->db->update('certificates');
			}
		}
	}
	
	public function get_caas_test(){
		$strings = "select id,gps,address,city,state from caas where lower(state) ='ca'";
		$all_data = $this->comman_model->get_query($strings,false);
		//printR($all_data);die;
//		$all_data = $this->comman_model->get_by('employers',array('gps'=>''),false);
		if($all_data){
			foreach($all_data as $set_d){
				$address = $set_d->address.', '.$set_d->city.', '.$set_d->state;
//				echo '<br>'.$address;
				$string = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go";
				$json = file_get_contents($string);
				$json = json_decode($json);
				if($json->{'status'}=='OK'){
					$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
					$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
					$this->db->where('id',$set_d->id);
					$this->db->set('gps',$lat.', '.$long,true);
					$this->db->update('caas');
				}
				
				
			}
		}
	}

	public function get_emp(){
		die;
		$strings = "select id,gps,address,city from employers";
		$all_data = $this->comman_model->get_query($strings,false);
//		printR($all_data);
//		$all_data = $this->comman_model->get_by('employers',array('gps'=>''),false);
		if($all_data){
			foreach($all_data as $set_d){
				$address = $set_d->address.', '.$set_d->city;

				$string = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go";
				$json = file_get_contents($string);
				$json = json_decode($json);
				if($json->{'status'}=='OK'){
					$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
					$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
					$this->db->where('id',$set_d->id);
					$this->db->set('gps',$lat.', '.$long,true);
					$this->db->update('employers');
				}
				
				
			}
		}
	}

	public function get_caas(){
		die;
		$strings = "select id,gps, address from caas where gps is NULL or gps =''";
		$all_data = $this->comman_model->get_query($strings,false);
//		printR($all_data);
//		$all_data = $this->comman_model->get_by('employers',array('gps'=>''),false);
		if($all_data){
			foreach($all_data as $set_d){
				$address = $set_d->address;
//				$region = $set_d->state;

				$string = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go";
				$json = file_get_contents($string);
				$json = json_decode($json);
				if($json->{'status'}=='OK'){
					$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
					$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
					$this->db->where('id',$set_d->id);
					$this->db->set('gps',$lat.', '.$long,true);
					$this->db->update('caas');
				}
				
				
			}
		}
	}
	
	function address($address){
		$url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address).'&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
		$responseJson = curl_exec($ch);
		curl_close($ch);
		
		$response = json_decode($responseJson);
		
		if ($response->status == 'OK') {
			$latitude = $response->results[0]->geometry->location->lat;
			$longitude = $response->results[0]->geometry->location->lng;
		
			echo 'Latitude: ' . $latitude;
			echo '<br />';
			echo 'Longitude: ' . $longitude;
		} else {
			echo $response->status;
			var_dump($response);
		}    
	}
}
