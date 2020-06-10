<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

global $user_id;
global $token;
global $user_name;
global $user_email;
global $user_access;
global $user_level;
global $organization_id;

class ajaxObject extends utilObject
{

	

	public function init(  ) {
		//print "<pre>_REQUEST<br>\n";
		//var_dump( $_REQUEST );
		//print "</pre><br>\n";

		$this->ajax_action( 'ajax_form_post', 'form_post' );

	}

	public function ajax_action( $action, $function ) {
		global $user_id;
		global $token;
		global $user_name;
		global $user_email;
		global $user_access;
		global $user_level;
		global $organization_id;

/*
		if ((isset( $_REQUEST ) ) && (isset($_REQUEST["userid"])) ) {
			$sql = "SELECT people.* FROM ".$this->peopleTable." AS people WHERE `id`='".$_REQUEST["userid"]."' AND people.status='active' AND people.role='user';";
			//print "sql:$sql<br>\n";
			$data = $this->sqlquery( $sql );
			//print "data:<pre><br>\n";
			//var_dump( $data );
			//print "<pre><br>\n";
			if ( is_array( $data ) ) {
				foreach( $data AS $user ) {
					$user_id=$user["id"];
					$organization_id=$user["organization_id"];
					$user_name=$user["name"];
					$user_email=$user["email"];
					$user_access=$user["access"];
					$user_level=$user["level"];
				}
			}
		}
*/
		$user_id="";
		
		if ((isset( $_REQUEST ) ) && (isset($_REQUEST["token"])) ) {
			$token = $_REQUEST["token"];
			$token_expire=date("Y-m-d H:i:s");
			$sql = "SELECT people.*, token.token, token.token_timestamp FROM ".$this->tokenTable." AS token LEFT JOIN ".$this->peopleTable." AS people ON ( people.id=token.user_id) WHERE token.token='".$token."' AND token.token_timestamp >= '".$token_expire."' AND people.status='active' AND people.role='user';";
			//print "sql:$sql<br>\n";
			$data = $this->sqlquery( $sql );
			//print "data:<pre><br>\n";
			//var_dump( $data );
			//print "<pre><br>\n";
			if ( is_array( $data ) ) {
				foreach( $data AS $user ) {
					$user_id=$user["id"];
					$token=$user["token"];
					$organization_id=$user["organization_id"];
					$user_name=$user["name"];
					$user_email=$user["email"];
					$user_access=$user["access"];
					$user_level=$user["level"];
				}
			}
		} else {
       echo json_encode(array('success' => false, 'result' => "Authorization invalid", 'id' => $_REQUEST["userid"] ));
       die(0);
		}

		if ( $user_id=="" ) {
       echo json_encode(array('success' => false, 'result' => "Cannot verify user", 'token' => $_REQUEST["token"] ));
       die(0);
		}
		
		if ((isset( $_REQUEST ) ) && (isset($_REQUEST["action"])) && ( $_REQUEST["action"]==$action )) $this->$function();


	}

	public function form_post() {
		//print "_REQUEST:<pre><br>\n";
		//var_dump( $_REQUEST );
		//print "</pre><br>\n";

		// The $_REQUEST contains all the data sent via ajax
		if ( isset($_REQUEST) ) {
			$dbtable = $_REQUEST['dbtable'];
			$dbkey = $_REQUEST['dbkey'];
			$objectClass = $_REQUEST['objectClass']."Object";
		
			//print "_REQUEST:<pre><br>\n";
			//var_dump( $_REQUEST );
			//print "</pre><br>\n";

			$output["settings"] = $_REQUEST["settings"];
			
			foreach (explode('&', $_REQUEST["settings"]) as $chunk) {
	    	$param = explode("=", $chunk);
				$output["chunk"] .= $chunk."\r\n";

	    	if ($param) {
	        //printf("Value for parameter \"%s\" is \"%s\"<br/>\n", base64_decode($param[0]), base64_decode($param[1]));
					$index=urldecode($param[0]);
					$value=urldecode($param[1]);
	        $output["decoded"] .= "Value for parameter ".$index." is ".$value."<br/>\n";
					$settings[$index]=$value;
	    	}
			}

			$output["objectClass"] = $objectClass;
			
			$class = new $objectClass;
			$class->init();
			$uresult = $class->update( $settings, $dbkey );
			
			$output["uresult"] = $uresult;
		
			$output["id"]="undefined";
			$output["message"]="undefined";
			list( $key, $value ) = split(":",$uresult);
			if ( $key=="id" ) $output["id"]=$value;
			if ( $key=="message" ) $output["message"]=$value;
			
			
			//print "settings:<pre><br>\n";
			//var_dump( $settings );
			//print "<pre><br>\n";

	    if($output) {
	    	if ( $output["message"]=="undefined" ) {
	        echo json_encode(array('success' => true, 'result' => $output, 'id' => $output["id"], 'message' => $output["message"] ));
				} else {
	        echo json_encode(array('success' => false, 'result' => $output, 'id' => $output["id"], 'message' => $output["message"] ));
				}
	    }
	    else {
	        echo json_encode(array('success' => false, 'result' => $output));
	    }

		}


		// Always die in public functions echoing ajax content
	   die();
	}

	public function object_delete() {
		//print "_REQUEST:<pre><br>\n";
		//var_dump( $_REQUEST );
		//print "</pre><br>\n";

		// The $_REQUEST contains all the data sent via ajax
		if ( isset($_REQUEST) ) {
			$dbtable = $_REQUEST['dbtable'];
			$dbkey = $_REQUEST['dbkey'];
			$objectClass = $_REQUEST['objectClass']."Object";
		
			//print "_REQUEST:<pre><br>\n";
			//var_dump( $_REQUEST );
			//print "</pre><br>\n";

			$output["objectClass"] = $objectClass;
			
			$class = new $objectClass;
			$class->init();
			$output["results"]  = $class->delete( $dbkey );
			
			//print "settings:<pre><br>\n";
			//var_dump( $settings );
			//print "<pre><br>\n";

	    if($output) {
	        echo json_encode(array('success' => true, 'result' => $output));
	    }
	    else {
	        echo json_encode(array('success' => false, 'result' => $output));
	    }

		}


		// Always die in public functions echoing ajax content
	   die();
	}

	public function field_update() {
		//print "_REQUEST:<pre><br>\n";
		//var_dump( $_REQUEST );
		//print "</pre><br>\n";

		// The $_REQUEST contains all the data sent via ajax
		if ( isset($_REQUEST) ) {
			$dbtable = $_REQUEST['dbtable'];
			$dbkey = $_REQUEST['dbkey'];
			$dbencode = $_REQUEST['dbencode'];
			$dbfield = $_REQUEST['dbfield'];
			$fieldvalue = $_REQUEST['fieldvalue'];
					
			//print "_REQUEST:<pre><br>\n";
			//var_dump( $_REQUEST );
			//print "</pre><br>\n";


			do_trigger( $dbtable, $dbfield, $dbkey, $fieldvalue );
			
			$message = "";
			if ( $dbfield=="sku" ) {
				$class = new productsObject;
				$class->init();
				if ( $class->does_sku_exist( $dbkey, $fieldvalue ) ) $message='<strong>SKU '.$value.' Already Exists...NOT updated';
			}
			
			if ( $message=="" ) {
				
				$update=true;
				if ( $dbencode=="json" ) {
					$update=false;
					$sql = "SELECT `data` FROM ".$dbtable." WHERE `id`='".$dbkey."';";
					$base64data = $this->sqlsingle( $sql, 'data' );
					if ( $base64data!="" ) {
						$jsondata = base64_decode( $base64data );
						$data = json_decode( $jsondata, true );
						if ( is_array( $data ) ) {
							$update=true;
							$data[$dbfield] = $fieldvalue;
							$data_json = json_encode( $data );
							$fieldvalue = base64_encode( $data_json );
							$dbfield="data";
						} else $message = "could not json decode ( $base64data )";
					} else $message = "base64data was empty ( $sql )";
					
				}

				if ( $update ) {
					$sql = "UPDATE ".$dbtable." SET `".$dbfield."`='".$fieldvalue."' WHERE `id`='".$dbkey."';";
					$output["sql"] = $sql;
					$output["result"] = $this->sqlquery( $sql );
				}
				 						
				//print "settings:<pre><br>\n";
				//var_dump( $settings );
				//print "<pre><br>\n";


			}
			
	    if($output) {
	        echo json_encode(array('success' => true, 'result' => $output, 'message' => $message ));
	    }
	    else {
	        echo json_encode(array('success' => false, 'result' => $output, 'message' => $message ));
	    }

		}


		// Always die in public functions echoing ajax content
	   die();
	}


}

?>
 