<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/assign_course">Manage
    <?=$page;?>s </a></div>
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
        <form class="da-home-form form-horizontal"  method="post" action="<?php echo base_url(); ?>admin/assign_course/add_assign_course" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="page_name" class="col-sm-3 control-label"></label>
              <div class="col-sm-4"> <span class="required"><?php echo validation_errors(); ?></span> </div>
            </div>
            <div class="form-group">
              <label for="student_id" class="col-sm-3 control-label"><span class="required">*</span>Students</label>
              <div class="col-sm-4">
                <select required name="student_id" id="student_id" class="form-control" data-msg-required="Please select student.">
                  <option value="">--Select Student--</option>
                  <?
                  foreach($student_list as $nkey => $student_listval)
                  {
                     echo '<option value='.$nkey.' student='.$student_listval.'>'.$student_listval.'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group da-form-row">
              <label for="team_id" class="col-sm-3 control-label"><span class="required">*</span>Courses</label>
              <div class="col-sm-6 streaming-div">
                <div class="teamsDiv">
                <? foreach($course as $course_val){ ?>
                <? 
				//$student_assign_course_count=$this->common->CountByTable("assign_course_student","where student_id='".$student_list_val['student_id']."'");
//				$course_id=$this->common->GetValue("assign_course_student","course_id","student_id",$student_list_val['student_id']);
//				$course_name=$this->common->GetValue("course","course_name","course_id",$course_id);
				?>
                  <div class="teams-check-design">
                    <input required type="checkbox" value="<?=$course_val["course_id"]?> " name="course_id[]" data-msg-required="Please select course.">
                    <?=$course_val["course_name"]?><br>
                  </div>
                  <? } ?>
                  
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/assign_course">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
  </div>
</section>

