<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/course">Manage courses</a></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
          <div id="delete_allmsg_div"></div>
            <? //include "Controls/admin-message.php"; ?>
          </div>
          <div class="box-body">
            <table class="table table-bordered tableformat" width="100%">
                    
                     <tr>
                      <th width="30%">Course Name</th>
                      <th width="70%"><?=$course->course_name?></th>
                    </tr>
                    <tr>
                      <th width="30%">Course Subject</th>
                      <th width="70%"><?=$course->course_subject?></th>
                    </tr>
                   
                     <tr>
                      <th width="30%">Description</th>
                      <th width="70%"><?=$course->course_details?></th>
                    </tr>
                    <tr>
                      <th width="30%">Duration</th>
                      <th width="70%"><?=$course->course_duration?></th>
                    </tr>
                     <tr>
                      <th width="30%">Created Date</th>
                      <th width="70%"><?=date('d M Y',strtotime($course->created_at))?></th>
                    </tr>
                    
                  </table>
          </div>
        </div>
      </div>
    </div>
  </section>
