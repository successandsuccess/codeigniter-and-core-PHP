<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_model extends MY_Model {
    
    public function upload_file($tmpFile,$path){
		$output =array('status'=>0,'msge'=>'file path not exists');
		$target_dir = $path;
		//$target_file = $target_dir . basename($_FILES[$tmpFile]["name"]);
		//echo $target_file = $target_dir .time().'.'.$imageFileType;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($_FILES[$tmpFile]["name"],PATHINFO_EXTENSION));
		$fileName = time().'.'.$imageFileType;
		$target_file = $target_dir .$fileName;
		// Check if image file is a actual image or fake image
/*		if(isset($_POST["submit"])) {
			echo 'id';
			$check = getimagesize($_FILES[$tmpFile]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}*/
		// Check if file already exists
/*		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}*/
		// Check file size
/*		if ($_FILES[$tmpFile]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}*/
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$output['msge'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES[$tmpFile]["tmp_name"], $target_file)) {
				$output['status'] = 1;
				$output['name'] = $fileName;
				$output['msge'] = '';
/*				echo "The file ". basename( $_FILES[$tmpFile]["name"]). " has been uploaded.";
*/
			} else {
				$output['msge'] = "Sorry, there was an error uploading your file.";
			}
		}
		return $output;
	}
    
}



