<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/attendence">Manage Attendence </a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <? $this->load->view('admin/controls/vwMessage'); ?>
          <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
        </div>
        <form class="da-home-form form-horizontal"  method="post" action="<?php echo base_url(); ?>admin/attendence/add_attendence" enctype="multipart/form-data">
          <div class="box-body">
            
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
            <div class="form-group">
              <label for="student_id" class="col-sm-3 control-label"><span class="required">*</span>Student</label>
              <div class="col-sm-4">
                <select required="" name="student_id" id="student_id" class="form-control" onchange="return get_student_name();" data-msg-required="Please select student.">
                <option value="">--Select Student--</option>
                <? foreach($student_list as $student_list_val){ ?>
                  
                  <option value="<?=$student_list_val["student_id"]?>" student="<?=$student_list_val["student_name"]?>"><?=$student_list_val["student_name"]?></option>
                 
                  <? } ?>      
                 </select>
                 <input type="hidden" name="students_name" id="students_name" value="" />
              </div>
            </div>
              
            
            <div class="form-group">
                <label for="created_date" class="col-sm-3 control-label"><span class="required">*</span>Date</label>
                <div class="col-sm-2">
                  <input type="text" required class="form-control date" name="date" id="date" readonly="readonly"  value="<? if(isset($_POST["date"])){ echo $_POST["date"];}?>" data-msg-required="Please enter date." >
                </div>
              </div>
              
              <div class="form-group">
                <label for="checkin_time" class="col-sm-3 control-label"><span class="required">*</span>Checkin Time</label>
                <div class="col-sm-2">
                  <input type="text" required class="form-control"  name="checkin_time" id="checkin_time"  value="<? if(isset($_POST["checkin_time"])){ echo $_POST["checkin_time"];}?>" data-msg-required="Please enter checkin time." >
                </div>
              </div>
              <div class="form-group">
                <label for="checkout_time" class="col-sm-3 control-label">Checkout Time</label>
                <div class="col-sm-2">
                  <input type="text"  class="form-control" name="checkout_time" id="checkout_time"  value="<? if(isset($_POST["checkout_time"])){ echo $_POST["checkout_time"];}?>" data-msg-required="Please enter checkout time." >
                </div>
              </div>
            <div class="form-group">
              <label for="notes" class="col-sm-3 control-label" >Notes</label>
              <div class="col-sm-4">
                <textarea  class="form-control" cols="4" rows="4" name="notes" id="notes" data-msg-required="Please enter notes."><? if(isset($_POST["notes"])){ echo $_POST["notes"];}?>
</textarea>
                
              </div>
            </div>
            
            
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/attendence">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
  </div>
</section>
<script>
function get_student_name()
{
	var student_name=$("#student_id").find(':selected').attr('student');
	$("#students_name").val(student_name);
	//alert(student_name);
}

  $(function() {
    
	 $("#date").datepicker({
								format: 'LT',
								maxDate: new Date(),
	});
	$('#checkin_time').datetimepicker({
                    format: 'LT'
                });
	$('#checkout_time').datetimepicker({
                    format: 'LT'
                });
	});

</script>