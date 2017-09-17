<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle;?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/news">Manage News</a></div>
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
if(count($news)>0)
{
?>
        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/news/edit_news/<?=$news->news_id?>"  enctype="multipart/form-data">
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
                <input type="text" required class="form-control" name="news_name" id="news_name" maxlength="150" value="<? if(isset($_POST['news_name'])){ echo $_POST['news_name']; }else{ echo $news->news_name; }?>" data-msg-required="Please enter title.">
              </div>
            </div>
            
            <div class="form-group">
              <label for="news_image" class="col-sm-3 control-label">Image <?=NEWSEVENTIMGSIZE?></label>
              <div class="col-sm-4">
                <input type="file" class="form-control" imgwidthheight="<?=NEWS_EVENT_WIDTH?>X<?=NEWS_EVENT_HEIGHT?>" name="news_image"  id="news_image" data-msg-required="Please upload image." >
              </div>
            </div>
            <?
			   if($news->news_image!="")
			   {
			  ?>
            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-4"> <img class="pageBg" src="<?=base_url().$news->news_image;?>"> </div>
            </div>
            <?  } ?>
            
            <div class="form-group">
                <label for="created_date" class="col-sm-3 control-label"><span class="required">*</span>Date</label>
                <div class="col-sm-2">
                    <input type="text" required  class="form-control date" name="created_date" id="created_date"  value="<? if(isset($_POST["created_date"])){ echo $_POST["created_date"];}else{echo date("m/d/Y",strtotime($news->created_date));}?>" data-msg-required="Please enter date.">
                </div>
              </div>
              
              <div class="form-group">
              <label for="short_description" class="col-sm-3 control-label"><span class="required">*</span>Short Description</label>
              <div class="col-sm-4">
                <textarea required class="form-control" name="short_description" id="short_description" rows="3" data-msg-required="Please enter short description."><? if(isset($_POST["short_description"])){ echo $_POST["short_description"];}else{ echo $news->short_description; }?>
</textarea>
              </div>
            </div>
            
            
              
              
                       
            <div class="form-group">
              <label for="Description" class="col-sm-3 control-label"><span class="required">*</span>Description</label>
              <div class="col-sm-7">
                <textarea required class="form-control" name="description" id="description" rows="3"><? if(isset($_POST["description"])){ echo $_POST["description"];}else{ echo $news->description; }?>
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
