<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/upload_news_event_image/index/<?=$id?>">Manage
    <?=$page;?>s</a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <? $this->load->view('admin/controls/vwMessage'); ?>
          <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
        </div>
        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/upload_news_event_image/add_news_event_image/<?=$id?>" enctype="multipart/form-data">
          <div class="box-body">
          
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              
            <div class="form-group">
              <label for="page_name" class="col-sm-3 control-label"></label>
              <div class="col-sm-4"> <span class="required"><?php echo validation_errors(); ?></span> </div>
            </div>
            
            <div class="form-group">
                <label for="news_event_gallery_type_id" class="col-sm-3 control-label"><span class="required">*</span>Media Type</label>
                <div class="col-sm-3">
                <select required name="news_event_gallery_type_id" id="news_event_gallery_type_id" class="form-control select-control" data-msg-required="Please select media type." onchange="galleryType(this.value)">
                      <?
					  foreach($news_event_gallery as $nkey => $news_event_galleryval)
					  {
						 echo '<option value='.$nkey.'>'.$news_event_galleryval.'</option>';
					  }
					  ?> 
                    </select>
                </div>
              </div>
            
            <div class="form-group Image">
              <label for="caption1" class="col-sm-3 control-label">Caption</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="caption1" id="caption1" maxlength="100" value="<? if(isset($_POST["caption1"])){ echo $_POST["caption1"];}?>">
              </div>
            </div>
            
            <div class="form-group Image">
              <label for="news_event_image1" class="col-sm-3 control-label"><span class="required">*</span>Image
                <?=EVENTGALLERYIMGSIZE?>
              </label>
              <div class="col-sm-4">
                <input type="file" required class="form-control" name="news_event_image1"  id="news_event_image1" imgwidthheight="<?=EVENT_GALLERY_WIDTH?>X<?=EVENT_GALLERY_HEIGHT?>" data-msg-required="Please upload image.">
              </div>
            </div>
            
            <div class="form-group Image">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-4"> <a href="javascript:;" class="btn btn-success btn-xs add-txt" onClick="AddText();"><i class="fa fa-plus"></i> add more</a> </div>
            </div>
            <div id="content"></div>
            <input type="hidden" value="1" name="hide_total_field" id="hide_total_field" />
            
            <div class="form-group Video" style="display:none">
                <label for="caption_video" class="col-sm-3 control-label">Caption</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="caption_video" id="caption_video" maxlength="100" value="<? if(isset($_POST["caption_video"])){ echo $_POST["caption_video"];}?>" data-msg-required="Please enter caption." >
                </div>
              </div>
              
              <div class="form-group Video" style="display:none">
                <label for="video_link" class="col-sm-3 control-label"><span class="required">*</span>Media Embed Code</label>
                <div class="col-sm-4">          
                  <textarea  class="form-control" required name="video_link" id="video_link" data-msg-required="Please enter embed code."><? if(isset($_POST["video_link"])){ echo $_POST["video_link"]; }?></textarea>
                </div>
              </div>	
              
             <div class="form-group VideoFile" style="display:none">
              <label for="caption_videofile" class="col-sm-3 control-label">Caption</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="caption_videofile" id="caption_videofile" maxlength="100" value="<? if(isset($_POST["caption_videofile"])){ echo $_POST["caption_videofile"];}?>">
              </div>
            </div>
            
            <div class="form-group VideoFile" style="display:none">
              <label for="news_event_videofile" class="col-sm-3 control-label"><span class="required">*</span>Video File</label>
              <div class="col-sm-4">
                <input type="file" required class="form-control" name="news_event_videofile"  id="news_event_videofile" data-msg-required="Please upload video.">
              </div>
            </div>
                                       
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/upload_news_event_image/index/<?=$id?>">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
  </div>
</section>
<script>
 //Add More
 var intTextBox =1;
 var imgsize='<?=EVENTGALLERYIMGSIZE?>';
		function AddText()
		{
			 intTextBox++;
			 var objNewDiv = document.createElement('div');
			 objNewDiv.setAttribute('id', 'div_' + intTextBox);
			 objNewDiv.setAttribute('class', 'news_event_image');
             objNewDiv.innerHTML= '<div class="form-group Image"><label for="caption'+intTextBox+'" class="col-sm-3 control-label">Caption</label><div class="col-sm-4"><input type="text" class="form-control" name="caption'+intTextBox+'" id="caption'+intTextBox+'" maxlength="100"></div></div><div class="form-group Image"><label for="news_event_image'+intTextBox+'" class="col-sm-3 control-label"><span class="required">*</span>Image '+imgsize+'</label><div class="col-sm-4 input-group"><input type="file" required class="form-control" name="news_event_image'+intTextBox+'"  id="news_event_image'+intTextBox+'" imgwidthheight="<?=EVENT_GALLERY_WIDTH?>X<?=EVENT_GALLERY_HEIGHT?>" data-msg-required="Please upload image."><span class="input-group-addon"><a href="javascript:;" class="btn btn-danger btn-xs remove-txt" onClick="removeElement(this);"><i class="fa fa-fw fa-trash-o"></i></a></span></div></div>';
			  document.getElementById('content').appendChild(objNewDiv);
			  $("#hide_total_field").val(intTextBox);
		}
		

function removeElement(p_this) {
    var parentdiv=$(p_this).parents("div.news_event_image:first");
  parentdiv.remove();
  intTextBox--;
  $("#hide_total_field").val(intTextBox);
  var idindex=2;
  $(".news_event_image").each(function(){
			$(this).attr("id","div_"+idindex);
			$("input[type='file']",this).attr("id","news_event_image"+idindex);
			$("input[type='file']",this).attr("name","news_event_image"+idindex);
			$("input[type='hidden']",this).attr("id","hid_news_event_image_id"+idindex);
			$("input[type='hidden']",this).attr("name","hid_news_event_image_id"+idindex);
			idindex++;
			
});
}

</script>