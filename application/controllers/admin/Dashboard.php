<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		
    }
	
    public function index() {
		
		$data['table_count']=$this->common->CountByTable('content','');
		$data['ckeditor']=false;
        $data['page']='dash';
		$data['gridTable']=false;
	
	
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
        $this->load->view('admin/vwDashboard',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
		$this->load->view('admin/controls/vwFooter');
    }

    public function Our_Sex_Chart(){
		$data['mail_count']=$this->common->CountByTable('student_register','where gender="Male"');
		$data['femail_count']=$this->common->CountByTable('student_register','where gender="Female"');
		$data['other_count']=$this->common->CountByTable('student_register','where gender="Other"');
		
		$responce->cols[] = array( 
            "id" => "", 
            "label" => "Topping", 
            "pattern" => "", 
            "type" => "string" 
        ); 
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Total", 
            "pattern" => "", 
            "type" => "number" 
        ); 
        
            $responce->rows[]["c"] = array( 
                array( 
                    "v" => "Male", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$data['mail_count'], 
                    "f" => null 
                ) 
            );
			$responce->rows[]["c"] = array( 
                array( 
                    "v" => "Female", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$data['femail_count'], 
                    "f" => null 
                ) 
            ); 
			$responce->rows[]["c"] = array( 
                array( 
                    "v" => "Other", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$data['other_count'], 
                    "f" => null 
                ) 
            ); 
         
 
        echo json_encode($responce); 
        } 
		
		 public function Our_Caste_Chart(){
		$data['apl_count']=$this->common->CountByTable('student_register','where caste_community="APL"');
		$data['bpl_count']=$this->common->CountByTable('student_register','where caste_community="BPL"');
		$data['st_sc_count']=$this->common->CountByTable('student_register','where caste_community="SC & ST"');
		
		$responce->cols[] = array( 
            "id" => "", 
            "label" => "Topping", 
            "pattern" => "", 
            "type" => "string" 
        ); 
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Total", 
            "pattern" => "", 
            "type" => "number" 
        ); 
        
            $responce->rows[]["c"] = array( 
                array( 
                    "v" => "APL", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$data['apl_count'], 
                    "f" => null 
                ) 
            );
			$responce->rows[]["c"] = array( 
                array( 
                    "v" => "BPL", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$data['bpl_count'], 
                    "f" => null 
                ) 
            ); 
			$responce->rows[]["c"] = array( 
                array( 
                    "v" => "SC & ST", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$data['st_sc_count'], 
                    "f" => null 
                ) 
            ); 
         
 
        echo json_encode($responce); 
        }
		
	
    

}

