<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle;?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/course">Manage course</a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <? $this->load->view('admin/controls/vwMessage'); ?>
          <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
        </div>
        <?
if(count($course)>0)
{
?>
        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/course/edit_course/<?=$course->course_id?>"  enctype="multipart/form-data">
          <div class="box-body">
             
             <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
             
              
            <div class="form-group">
              <label for="course_name" class="col-sm-3 control-label"><span class="required">*</span>Name</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control" name="course_name" id="course_name" maxlength="150" value="<? if(isset($_POST['course_name'])){ echo $_POST['course_name']; }else{ echo $course->course_name; }?>" data-msg-required="Please enter title.">
              </div>
            </div>
            
            <div class="form-group">
              <label for="course_subject" class="col-sm-3 control-label"><span class="required">*</span>Subject</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control" name="course_subject" id="course_subject" maxlength="200" data-msg-required="Please enter subject." value="<? if(isset($_POST["course_subject"])){ echo $_POST["course_subject"]; }else{ echo $course->course_subject; }?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="Description" class="col-sm-3 control-label"><span class="required">*</span>Description</label>
              <div class="col-sm-7">
                <textarea required class="form-control" name="description" id="description" rows="3"><? if(isset($_POST["description"])){ echo $_POST["description"];}else{ echo $course->course_details; }?>
</textarea>
                <label for="description" id="error_description"  style="display:none;"  class="errorCK">Please enter description.</label>
              </div>
            </div>
            
            <div class="form-group">
              <label for="course_duration" class="col-sm-3 control-label"><span class="required">*</span>Duration</label>
              <div class="col-sm-2">
                <input type="text" required class="form-control" name="course_duration" id="course_duration" maxlength="100" data-msg-required="Please enter duration." value="<? if(isset($_POST["course_duration"])){ echo $_POST["course_duration"]; }else{ echo $course->course_subject; }?>" >
              </div>
            </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/course">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
        <? } else { ?>
        <div class="box-body">
          <div class="error_occured">Error occured open this page</div>
        </div>
        <? } ?>
      </div>
    </div>
  </div>
</section>
<script>
  $(function() {
    $("#created_date").datepicker();
	});
</script>
