<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/student">Manage <?=$page?>s
      
      </a></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <?
		  	$this->load->view('admin/controls/vwMessage');
		  	?>
            <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
<?
if(count($student)>0)
{
?>
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/student/edit_student/<?=$student->student_id?>" enctype="multipart/form-data">
            <div class="box-body">
            	<div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="student_name" class="col-sm-3 control-label"><span class="required">*</span>Full Name</label>
                <div class="col-sm-4">
                  <input type="text"   required class="form-control" name="student_name" maxlength="100" id="student_name" value="<? if(isset($_POST["student_name"])){ echo $_POST["student_name"]; }else{echo $student->student_name;}?>" data-msg-required="Please enter full name." >
                </div>
              </div>
              
              <div class="form-group">
                <label for="student_fathername" class="col-sm-3 control-label"><span class="required">*</span>Father Name</label>
                <div class="col-sm-4">
                  <input type="text"   required class="form-control" name="student_fathername" maxlength="100" id="student_fathername" value="<? if(isset($_POST["student_fathername"])){ echo $_POST["student_fathername"]; }else{echo $student->student_fathername;}?>" data-msg-required="Please enter father name." >
                </div>
              </div>   
              <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" name="student_email" maxlength="100" id="student_email" value="<? if(isset($_POST["student_email"])){ echo $_POST["student_email"]; }else{echo $student->student_email;}?>"  >
                </div>
              </div>
                        
                         
           	  
              <div class="form-group">
                <label for="student_mobile" class="col-sm-3 control-label"><span class="required">*</span>Mobile Number</label>
                <div class="col-sm-4">
                  <input type="text" readonly  class="form-control" name="student_mobile" maxlength="15" id="student_mobile" value="<? if(isset($_POST["student_mobile"])){ echo $_POST["student_mobile"]; }else{echo $student->student_mobile;}?>">
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-3 control-label"><span class="required">*</span>Password</label>
                <div class="col-sm-4">
                  <input type="password" required class="form-control" name="password" maxlength="50" id="password" value="<? if(isset($_POST["password"])){ echo $_POST["password"]; }else{echo $this->encrypt->decode($student->password);}?>" data-msg-required="Please enter password." >
                </div>
              </div>
              <div class="form-group">
                <label for="dob" class="col-sm-3 control-label"><span class="required">*</span>Date Of Birth</label>
                <div class="col-sm-2">
                  <input type="text" readonly="readonly" required class="form-control date" name="dob" id="dob"  value="<? if(isset($_POST["dob"])){ echo $_POST["dob"];}else{echo $student->DOB;}?>" data-msg-required="Please enter date of birth." >
                </div>
              </div>
              <div class="form-group">
                <label for="caste_community" class="col-sm-3 control-label">Demography</label>
                <div class="col-sm-4">
                  <select class="form-control" name="caste_community" id="caste_community">
                        <option value="">--Select Caste--</option>
                        <option value="APL" <? if($student->caste_community=="APL"){?>selected <? } ?>>APL</option>
                        <option value="BPL" <? if($student->caste_community=="BPL"){?>selected <? } ?>>BPL </option>
                        <option value="SC & ST" <? if($student->caste_community=="SC & ST"){?>selected <? } ?>>SC & ST </option>
                 </select>
                </div>
              </div>
              <div class="form-group">
                <label for="gender" class="col-sm-3 control-label">Gender</label>
                <div class="col-sm-4">
                  
                <input type="radio" name="gender" value="Male" class="checkbox_span" <? if($student->gender=="Male"){ ?>checked <? } ?> > Male
                <input type="radio" name="gender" value="Female" class="checkbox_span" <? if($student->gender=="Female"){ ?>checked <? } ?>> Female
                <input type="radio" name="gender" value="Other" class="checkbox_span" <? if($student->gender=="Other"){ ?>checked <? } ?>> Other<br />
                </div>
              </div>
              <div class="form-group">
              <label for="student_address" class="col-sm-3 control-label">Address</label>
              <div class="col-sm-4">
                <textarea class="form-control"  name="student_address" maxlength="1500" id="student_address" ><? if(isset($_POST['student_address'])){ echo $_POST['student_address']; }else{ if($student->student_address!=""){ echo $student->student_address;} }?>
</textarea>
              </div>
            </div>
            <div class="form-group">
                <label for="student_city" class="col-sm-3 control-label">Village </label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="student_city" maxlength="100" id="student_city" value="<? if(isset($_POST["student_city"])){ echo $_POST["student_city"]; }else{echo $student->student_city;}?>" >
                </div>
              </div>
               <div class="form-group">
                <label for="student_zip" class="col-sm-3 control-label">Post Code </label>
                <div class="col-sm-4">
                  <input type="text"  class="form-control" name="student_zip" maxlength="100" id="student_zip" value="<? if(isset($_POST["student_zip"])){ echo $_POST["student_zip"]; }else{echo $student->student_zip;}?>">
                </div>
              </div>
              <div class="form-group">
                <label for="student_district" class="col-sm-3 control-label">District</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="student_district" maxlength="100" id="student_district" value="<? if(isset($_POST["student_district"])){ echo $_POST["student_district"]; }else{echo $student->student_district;}?>" >
                </div>
              </div>  
            <div class="form-group">
                <label for="student_state" class="col-sm-3 control-label">State</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="student_state" maxlength="100" id="student_state" value="<? if(isset($_POST["student_state"])){ echo $_POST["student_state"]; }else{echo $student->student_state;}?>" >
                </div>
              </div>  
              
              
              
             
              
              <div class="form-group">
                <label for="student_country" class="col-sm-3 control-label">Country</label>
                <div class="col-sm-4">
                  <select class="form-control" name="student_country" id="student_country">
                        <option value="">--Select Country--</option>
                        <option value="India" <? if($student->student_country=="India"){?>selected <? } ?>>India</option>
                        <option value="United Kingdom" <? if($student->student_country=="United Kingdom"){?>selected <? } ?>>United Kingdom </option>
                        <option value="USA" <? if($student->student_country=="USA"){?>selected <? } ?>>USA </option>
                 </select>
                </div>
              </div>
              
              
            
            
            
            
			</div>
            <!-- /.box-body -->
            <div class="box-footer" >
              <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/student">Cancel</a>
           
              <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
          <?
}
else
{
?>
<div class="box-body">
<div style="text-align:center; font-size:24px;">Error occured open this page</div>
</div>
<?
}
		  ?>
        </div>
      </div>
    </div>
  </section>
  <script>
 //var dateToday = new Date();
//var yrRange = (dateToday.getFullYear() - 50) + ":" + (dateToday.getFullYear() - 10);
var start = new Date();
start.setFullYear(start.getFullYear() - 70);
var end = new Date();
end.setFullYear(end.getFullYear() - 10);
  
  $( function() {
    $( "#dob" ).datepicker({
		
			changeMonth: true,
            changeYear: true,
			minDate: start,
        	
			 yearRange: start.getFullYear() + ':' + end.getFullYear(),
			
								
	});
  } );
  </script>

   