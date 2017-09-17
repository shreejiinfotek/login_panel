<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/assign_course">Manage <?=$page?>s
      
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
if(!empty($assigncourse))
{
?>

<?
$assign_courses = array();
foreach($getassigncourse as $getassigncourse_val){ 
$assign_courses[]=$getassigncourse_val["course_id"];

}
?>


            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/assign_course/edit_assign_course/<?=$assigncourse->assign_course_student_id?>" enctype="multipart/form-data">
            <div class="box-body">
            	<div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label for="student_id" class="col-sm-3 control-label"><span class="required">*</span>Students</label>
                <div class="col-sm-2">
                <select required disabled="disabled" name="student_id" id="student_id" class="form-control" data-msg-required="Please select student.">
                      <option value="">--Select Student--</option>
					<?
					 foreach($student_list as $nkey => $student_listval)
					  {
						if($nkey==$assigncourse->student_id)
						{
							$checkid="selected";
						}
						else
						{
							$checkid='';
						}
						echo '<option value='.$nkey.' '.$checkid.'>'.$student_listval.'</option>';
					  }
					  ?>
                    </select>
                  <input type="hidden" name="hd_student_id" id="hd_student_id" value="<?=$assigncourse->student_id?>" />
                </div>
              </div>
             <div class="form-group da-form-row">
              <label for="team_id" class="col-sm-3 control-label"><span class="required">*</span>Courses</label>
              <div class="col-sm-8 streaming-div">
                <div class="teamsDiv">
                <? foreach($course as $course_list){ ?>
              <div class="teams-check-design">
                    <input required type="checkbox" <? if(in_array($course_list["course_id"], $assign_courses)){?> checked="checked" <? } ?> value="<?=$course_list["course_id"]?> " name="course_id[]" data-msg-required="Please select course.">
                    <?=$course_list["course_name"]?><br>
                  </div>
                  <? } ?>
                  
                  
                </div>
              </div>
            </div>
              
              
              
              </div>
              
         </div>
            <!-- /.box-body -->
            <div class="box-footer" >
              <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/assign_group">Cancel</a>
           
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
<div class="no-found-record">Error occured open this page</div>
</div>
<?
}
		  ?>
        </div>
      </div>
    </div>
  </section>
  <script>
function get_group()
{
if(check_session())
		{
				var id=$("#tournament_id").val();
				if(id > 0)
				{
					
			
					var dataString = 'id='+ id;
						$.ajax
						({
							type: "POST",
							url: "<?php echo base_url(); ?>admin/assign_group/get_group",
							data: dataString,
							cache: false,
							success: function(html)
							{
								$("#divGroup").html(html);
							} 
						});
				}
				else
				{
					$("#divGroup").html('');
				}
			
		}
	}
</script>

   