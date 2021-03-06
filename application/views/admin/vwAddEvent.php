<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/event">Manage Event </a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <? $this->load->view('admin/controls/vwMessage'); ?>
          <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
        </div>
        <form class="da-home-form form-horizontal"  method="post" action="<?php echo base_url(); ?>admin/event/add_event" enctype="multipart/form-data">
          <div class="box-body">
            
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
            
              
            <div class="form-group">
              <label for="event_name" class="col-sm-3 control-label"><span class="required">*</span>Name</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control" name="event_name" id="event_name" maxlength="100" data-msg-required="Please enter name." value="<? if(isset($_POST["event_name"])){ echo $_POST["event_name"]; }?>" >
              </div>
            </div>
            
            <div class="form-group">
              <label for="event_image" class="col-sm-3 control-label"><span class="required">*</span>Image <?=NEWSEVENTIMGSIZE?></label>
              <div class="col-sm-4">
             <?php /*?> imgwidthheight="<?=NEWS_EVENT_WIDTH?>X<?=NEWS_EVENT_HEIGHT?>"<?php */?>
                <input type="file" required class="form-control" imgwidthheight="<?=NEWS_EVENT_WIDTH?>X<?=NEWS_EVENT_HEIGHT?>"  name="event_image"  id="event_image" value="<? if(isset($_POST["event_image"])){ echo $filepath; }?>" data-msg-required="Please upload image." >
              </div>
            </div>
            
           
            
            <div class="form-group">
              <label for="short_description" class="col-sm-3 control-label" ><span class="required">*</span>Short Description</label>
              <div class="col-sm-4" >
                <textarea  class="form-control" required name="short_description" id="short_description" maxlenth="505" rows="5" data-msg-required="Please enter short description."><? if(isset($_POST["short_description"])){ echo $_POST["short_description"];}?>
</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-sm-3 control-label" ><span class="required">*</span>Description</label>
              <div class="col-sm-7">
                <textarea  class="form-control" required name="description" id="description" data-msg-required="Please upload description."><? if(isset($_POST["description"])){ echo $_POST["description"];}?>
</textarea>
                <label for="description" id="error_description"  style="display:none;"  class="errorCK">Please enter description.</label>
              </div>
            </div>
            <div class="form-group">
              <label for="event_venue" class="col-sm-3 control-label"><span class="required">*</span>Venue</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control" name="event_venue" id="event_venue" maxlength="100" value="<? if(isset($_POST['event_venue'])){ echo $_POST['event_venue']; }?>" data-msg-required="Please enter venue.">
              </div>
            </div>
            <div class="form-group">
              <label for="event_city" class="col-sm-3 control-label"><span class="required">*</span>City</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control" name="event_city" id="event_city" maxlength="100" value="<? if(isset($_POST['event_city'])){ echo $_POST['event_city']; }?>" data-msg-required="Please enter city.">
              </div>
            </div>
            
             <div class="form-group">
                <label for="created_date" class="col-sm-3 control-label"><span class="required">*</span>Date</label>
                <div class="col-sm-3">
                
                  <input type="text" required class="form-control date" name="created_date" id="created_date"  value="<? if(isset($_POST["created_date"])){ echo $_POST["created_date"];}?>" data-msg-required="Please enter date." >
                  
                  
                </div>
              </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/event">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
  </div>
</section>
<script>
  $(function() {
    $("#created_date").datetimepicker();
	});
  
  
 
</script>
