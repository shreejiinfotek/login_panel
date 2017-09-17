<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendence extends Admin_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->
load->model('Attendence_model','attendence');
		$this->load->model('Student_model','student');
		
		$this->load->library('form_validation');
	
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
	}

	public function index()
	{
		$data['page'] = 'Attendence';
		$data['path'] = ''.base_url().'admin/attendence/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/attendence/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/attendence/content_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['is_verified_path']=''.base_url().'admin/attendence/is_verified/';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
        $this->load->view('admin/vwManageAttendence',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
		$this->load->view('admin/controls/vwFooter');
	}

	public function content_view()
	{
		$data['page'] = 'Attendence';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->attendence->get_datatables($sql_details);
	}
	
	public function add_attendence() { //this is use for redirect form in add section start
		$data['page'] = 'Attendence';
	
		$data['pagetitle']='Manage Attendence | Add  '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;

		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				
					$filepath="";			
					$tblName = "attendance";
						
						
							$data = array(
							'student_id'=>$this->input->post('student_id'),
							'students_name'=>$this->input->post('students_name'),
							'date'=> date('Y-m-d', strtotime($this->input->get_post('date'))),
							'checkin_time'=>$this->input->post('checkin_time'),
							'checkout_time'=>$this->input->post('checkout_time'),
							'notes'=>$this->input->post('notes'),
							'created_at' => date('Y-m-d'),
							'created_by'=>$this->session->userdata('id')
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'Attendence has been added successfully.');
							redirect('admin/attendence/','refresh'); //redirect in manage with msg
				
					
				
			}
			else
			{	$data['student_list']=$this->student->get_student_list();
				$this->form_validation->set_rules('student_id', 'student_id', 'required');
				if ($this->form_validation->run() === FALSE)
				{
					
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					
					$this->load->view('admin/vwAddAttendence',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
		
	}
	
	public function edit_attendence($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Attendence';
		$data['pagetitle']='Manage Attendence | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "attendance";
				 $fieldName = "attendance_id";
				
					
					$data = array(
							'date'=> date('Y-m-d', strtotime($this->input->get_post('date'))),
							'checkin_time'=>$this->input->post('checkin_time'),
							'checkout_time'=>$this->input->post('checkout_time'),
							'notes'=>$this->input->post('notes'),
							'updated_at' => date('Y-m-d'),
							'updated_by'=>$this->session->userdata('id')
							);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Attendence has been updated successfully.');
					redirect('admin/attendence/','refresh'); //redirect in manage with msg
				
			}
			
			
			$data['attendence']=$this->attendence->get_attendence_by_id($id);
			$data['student_list']=$this->student->get_student_list();
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditAttendence',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/attendence');
        }
    }
	
	
	public function delete_content($id) {
		
		$arr['page'] = 'Attendence';
		
		$this->attendence->delete_record('attendance_id',$id,'attendance');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Attendence';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->attendence->delete_all($ids);
			echo 'delete';
			
    }
	public function is_verified($val,$id)
	{
		$fieldName='is_verified';
		$fieldId='attendance_id';
		$tableName='attendance';
		$this->common->update_is_verified($val,$id,$fieldName,$fieldId,$tableName);
	}

	
	
	public function import()
	{	
		
		$data['page'] = 'Import Attendence';
		$data['pagetitle']='Manage '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		
		
		require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
		
		if(!empty($_FILES['import_path']['name']))
		{
			
			$data['error']="";
			$tmp = $_FILES['import_path']['name'];
			$ext = explode('.',$tmp);
			$extension  = strtolower($ext[1]);
			if(($extension =="xls" || $extension =="xlsx")==false)
			{
				$data['error']="Please upload correct file( xls).";
			}
			if($data['error']=="")
			{
				$import_temp_file = $_FILES['import_path']['tmp_name'];
				
				
				
				$objPHPExcel = new PHPExcel();
				$objPHPExcel = PHPExcel_IOFactory::load($import_temp_file);
				//get only the Cell Collection
				
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
				//extract to a PHP readable array format
				
				foreach ($cell_collection as $cell) {
					
					$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
					
					$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
					
					//header will/should be in row 1 only. of attendence this can be modified to suit your need.
					
					if ($row == 1) {
						$header[$row][$column] = $data_value;
						
					} else {
						$arr_data[$row][$column] = $data_value;
						
					}
					
				}
				
				
				$Import_row=0;
				//send the data in an array format
				if(empty($header))
				{
					$this->session->unset_userdata('file_name');
					$this->session->set_flashdata('error', 'No data imported');
					$this->session->set_flashdata('import', $Import_row);
					redirect('admin/attendence/import/','refresh');	
					exit();
				}
				else
				{
					$data['header'] = $header;
				}
				 if(empty($arr_data))
				 {
					$this->session->unset_userdata('file_name');
					$this->session->set_flashdata('error', 'No data imported');
					$this->session->set_flashdata('import', $Import_row);
					redirect('admin/attendence/import/','refresh');
						exit();
				 }
				else
				{
					$data['values'] = $arr_data;
				}
				

				//$data['location']=$this->attendence->get_location();
				//$this->session->set_userdata('location',$data['location']);
					
				
				
				
				$delete_record=true;
				$i=0;
				foreach($arr_data as $value)
				{
				
				
				$student_id="";
				$student_name="";
				$attendence_date="";
				$checkin_time="";
				$checkout_time="";
				$notes="";
				$reason_not_upload_data="";
				
				if(array_key_exists('A', $value))
				{
					//$category_id=$this->common->GetValue("category","category_id","category_name",''.$value['G'].'');
					$student_id=$value['A'];
					
				}
				if(array_key_exists('B', $value))
				{
					//$sub_category_id=$this->common->GetValue("sub_category","sub_category_id","sub_category_name",''.$value['H'].'');
					$student_name=$value['B'];
					
				}
				if(array_key_exists('C', $value))
				{  
				
				$attendence_date=$this->common->excel_number_to_date($value['C']);
					
					
				}
				if(array_key_exists('D', $value))
				{
					//$sub_category_id=$this->common->GetValue("sub_category","sub_category_id","sub_category_name",''.$value['H'].'');
					$checkout_time=$value['D'];
				}
				if(array_key_exists('E', $value))
				{
					//$sub_category_id=$this->common->GetValue("sub_category","sub_category_id","sub_category_name",''.$value['H'].'');
					$checkin_time=$value['E'];
				}
				if(array_key_exists('F', $value))
				{
					$notes = $value['F'];
				}
				
				
				
				
					
				if(($student_id=="" || $student_name=="" || $attendence_date=="") == false)
				{
					
					if($student_id=="")
					{
						$reason_not_upload_data="Invalid student id";
					}
					else if($student_name=="")
					{
						$reason_not_upload_data="Invalid Student Name";
					}
					else if($attendence_date=="")
					{
						$reason_not_upload_data="Invalid Attendence Date";
					}
					
					$value['G']=$reason_not_upload_data;
					
					$import_error_result[] = array("student_id" => $student_id,
													   	"student_name"=>$student_name,
														"attendence_date"=>$attendence_date,
														"reason" =>$value['G']
									  );
				}
				
				if($student_id!="" && $student_name!="" && $attendence_date!="")
				{
					$tblName='attendance';
						$data = array(
								  	"student_id"=>$student_id,
									"students_name"=>$student_name,
									"date"=>$attendence_date,
									'checkout_time' => $checkout_time,
									'checkin_time' => $checkin_time,
									'notes' => $notes,
									'created_at' => date('Y-m-d'),
									'created_by' => $this->session->userdata('id'),
								);
					
						$this->common->insert_record($tblName,$data);
					
					
					$Import_row++;
				}
				
			}
			
			
			if(!empty($import_error_result))
			{
				

							$objPHPExcel = new PHPExcel();
							for ($col = 'A'; $col != 'H'; $col++) {
						   $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
									}
			
					
			
							
							$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);
					
			
			
							//echo date('H:i:s') , " Add some data" , EOL;
							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A1', "Student ID")
										->setCellValue('B1', "Name")
										->setCellValue('C1', "Date")
										->setCellValue('D1', "Reason");
									   
			
							$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
			
							$i =2;
							foreach($import_error_result as $value)
							{
													
								
								
								// Miscellaneous glyphs, UTF-8
								$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A'.$i, $value['student_id'])
										->setCellValue('B'.$i, $value['student_name'])
										->setCellValue('C'.$i, $value['attendence_date'])
										->setCellValue('D'.$i, $value['reason']);
									   
								$i++;
							}
							
			$filename=date('mdyHis').'.xls'; //save our workbook as this file name
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('./uploads/attendence/'.$filename);
			if($Import_row!=0)
			{
				
				$this->session->set_flashdata('msg', 'Attendence data has been import successfully.');
				$this->session->set_flashdata('import', $Import_row);
				$this->session->set_userdata('file_name',$filename);
				redirect('admin/attendence/import/','refresh');
			}
			}
			if(count($arr_data)==$Import_row)
			{
				$this->session->unset_userdata('file_name');
				$this->session->set_flashdata('msg', 'Full data has been import successfully.');
				$this->session->set_flashdata('import', $Import_row);
				redirect('admin/attendence/import/','refresh');
			}
			if($Import_row==0)
			{
				$this->session->set_userdata('file_name',$filename);
				$this->session->set_flashdata('error', 'No data imported');
				$this->session->set_flashdata('import', $Import_row);
				redirect('admin/attendence/import/','refresh');
			}
		}
}
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwImportAttendence',$data);
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
		
	
	}
	
	public function export()
   { 
   		
		 require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
		 
		 //$sql_details=$this->common->sql_detial();
		$data['attendence']= $this->attendence->get_attendance_list();
		//print_r($data['attendence']); exit();
		
		//$sql=$this->course->Get_export();
		$objPHPExcel = new PHPExcel();
for ($col = 'A'; $col != 'G'; $col++) {
       $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                }




              //  $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
              //  $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFill()->getStartColor()->setARGB('FF1E1E');
                // Add some data
                $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);
            //    $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


                //echo date('H:i:s') , " Add some data" , EOL;
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', "ID")
                            ->setCellValue('B1', "Name")
							->setCellValue('C1', "Date")
                            ->setCellValue('D1', "Time Out")
							->setCellValue('E1', "Time In")
							->setCellValue('F1', "Notes");
							
                           

                $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);

                $i =2;
                foreach($data['attendence'] as $item)
                {
					
					
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

					

                    // Miscellaneous glyphs, UTF-8
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i, $item['student_id'])
                            ->setCellValue('B'.$i, $item['students_name'])
							->setCellValue('C'.$i, $item['date'])
                            ->setCellValue('D'.$i, $item['checkin_time'])
							->setCellValue('E'.$i, $item['checkout_time'])
							->setCellValue('F'.$i, $item['notes'] );
                           
                    $i++;
                }
$filename=date('mdyHis').'.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
            
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
		//$this->excel->filename = 'abc123';
		//$this->excel->make_from_db($sql);
}



  

}