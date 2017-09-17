<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends My_Controller {
   
    public function __construct() {
        parent::__construct();
		$this->load->model('Common_function_model','common');
	
    }

    public function index() {

		  if(isset($_FILES['upload']) && $_FILES['upload']['name']!="")
		{
		move_uploaded_file($_FILES['upload']['tmp_name'],'./uploads/ContentImage/'.$_FILES['upload']['name']);
		
		
		// Required: anonymous function number as explained above.
	$funcNum = $_GET['CKEditorFuncNum'] ;
	// Optional: instance name (might be used to load specific configuration file or anything else)
	$CKEditor = $_GET['CKEditor'] ;
	// Optional: might be used to provide localized messages
	$langCode = $_GET['langCode'] ;
	 
	// Check the $_FILES array and save the file. Assign the correct path to some variable ($url).
	$url = base_url().'uploads/ContentImage/'.$_FILES['upload']['name'];
	// Usually you will assign here something only if file could not be uploaded.
	$message = '';
	 
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
	
	}

    }
}
?>