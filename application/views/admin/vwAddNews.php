<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/news">Manage News </a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <? $this->load->view('admin/controls/vwMessage'); ?>
          <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
        </div>
        <form class="da-home-form form-horizontal"  method="post" action="<?php echo base_url(); ?>admin/news/add_news" enctype="multipart/form-data">
          <div class="box-body">
            
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
            
              
            <div class="form-group">
              <label for="news_name" class="col-sm-3 control-label"><span class="required">*</span>Name</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control" name="news_name" id="news_name" maxlength="150" data-msg-required="Please enter name." value="<? if(isset($_POST["news_name"])){ echo $_POST["news_name"]; }?>" >
              </div>
            </div>
            
            <div class="form-group">
              <label for="news_image" class="col-sm-3 control-label"><span class="required">*</span>Image <?=NEWSEVENTIMGSIZE?></label>
              <div class="col-sm-4">
             <?php /*?> imgwidthheight="<?=NEWS_EVENT_WIDTH?>X<?=NEWS_EVENT_HEIGHT?>"<?php */?>
                <input type="file" required class="form-control"  name="news_image" imgwidthheight="<?=NEWS_EVENT_WIDTH?>X<?=NEWS_EVENT_HEIGHT?>" id="news_image" value="<? if(isset($_POST["news_image"])){ echo $filepath; }?>" data-msg-required="Please upload image." >
              </div>
            </div>
            
            <div class="form-group">
                <label for="created_date" class="col-sm-3 control-label"><span class="required">*</span>Date</label>
                <div class="col-sm-2">
                  <input type="text" required class="form-control date" name="created_date" id="created_date"  value="<? if(isset($_POST["created_date"])){ echo $_POST["created_date"];}?>" data-msg-required="Please enter date." >
                </div>
              </div>
            
            <div class="form-group">
              <label for="short_description" class="col-sm-3 control-label" ><span class="required">*</span>Short Description</label>
              <div class="col-sm-4">
                <textarea  class="form-control" required name="short_description" id="short_description" rows="3" maxlength="150" data-msg-required="Please enter short description."><? if(isset($_POST["short_description"])){ echo $_POST["short_description"];}?>
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
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/news">Cancel</a>
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
    $("#created_date").datepicker();
	});
  
  function newseventType() {
    var sel = document.getElementById("news_event_type_id").selectedIndex;
    //alert(document.getElementsByTagName("option")[sel].value);
	
	if(sel==1)
	{
		$("#location").hide();
		$("#created_by").show();
	}
	else
	{
		$("#location").show();
		$("#created_by").hide();
	}
}
</script>
