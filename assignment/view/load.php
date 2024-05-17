<?php
class Load {

	function view($file_name, $data = null, $page_title = "")
	{
		if( is_array($data) ) {
			extract($data);
		}



		include $file_name . '.php';
		
	}
}
?>