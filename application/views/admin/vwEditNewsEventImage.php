<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle;?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/upload_news_event_image/index/<?=$news_event_image->news_event_id?>">Manage
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
        <?
if(count($news_event_image)>0)
{
?>
        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/upload_news_event_image/edit_news_event_image/<?=$id?>" enctype="multipart/form-data">
          <div class="box-body" >
          
          <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
          <div class="form-group">
                <label for="news_event_gallery_type_id" class="col-sm-3 control-label"><span class="required">*</span>Media Type</label>
                <div class="col-sm-3">
                <select required disabled name="news_event_gallery_type_id" id="news_event_gallery_type_id" class="form-control select-control" onChange="galleryType(this.value)">
                      <option value="">--Select Media Type--</option>
					<?
					 foreach($news_event_gallery as $nkey => $news_event_galleryval)
					  {
						if($nkey==$news_event_image->news_event_gallery_type_id)
						{
							$checkid="selected";
						}
						else
						{
							$checkid='';
						}
						echo '<option value='.$nkey.' '.$checkid.'>'.$news_event_galleryval.'</option>';
					  }
					  ?>
                    </select>
                  
                </div>
              </div>
              
              
            <div class="form-group ">
              <label for="caption" class="col-sm-3 control-label">Caption</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="caption" id="caption" maxlength="100" value="<? if(isset($_POST["caption"])){ echo $_POST["caption"];}else{ echo $news_event_image->caption;}?>" data-msg-required="Please enter caption." >
              </div>
            </div>
            
             <? if($news_event_image->news_event_gallery_type_id==1){ ?>
                <div class="form-group Image">
                  <label for="news_event_image" class="col-sm-3 control-label">Image
                    <?=EVENTGALLERYIMGSIZE?>
                  </label>
                  <div class="col-sm-4">
                    <input type="file"  class="form-control" name="news_event_image" id="news_event_image" imgwidthheight="<?=EVENT_GALLERY_WIDTH?>X<?=EVENT_GALLERY_HEIGHT?>">
                  </div>
                </div>
                <div class="form-group Image">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-4"> <img  src="<?=base_url().$news_event_image->large_image_path;?>" class="image-admin-display"> </div>
                </div>
            <?
			 }
			 else if($news_event_image->news_event_gallery_type_id==2)
			 {
			?>
            	<div class="form-group Video">
                <label for="video_link" class="col-sm-3 control-label">Media Embed Code</label>
                <div class="col-sm-4">
                  <textarea class="form-control" name="video_link" id="video_link" rows="3"><? if(isset($_POST["video_link"])){ echo $_POST["video_link"]; }else{ echo $news_event_image->video_link; }?></textarea>
                  <br>
                  <div class="col-sm-4"><?=$news_event_image->video_link;?></div>
                </div>
              </div>
            <?
			 }
			 else if($news_event_image->news_event_gallery_type_id==3)
			 {
			?>
                <div class="form-group Image">
                  <label for="news_event_videofile" class="col-sm-3 control-label">Video File</label>
                  <div class="col-sm-4">
                    <input type="file"  class="form-control" name="news_event_videofile" id="news_event_videofile">
                  </div>
                </div>
                <div class="form-group Image">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-4">

<video controls="controls" preload="none" name="media" class="image-video-display"><source src="<?=base_url().$news_event_image->news_event_videofile;?>" type="video/mp4"></video>
</div>
                </div>
            	
            <? }?>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/upload_news_event_image/index/<?=$news_event_image->news_event_id?>">Cancel</a>
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