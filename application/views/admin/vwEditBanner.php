<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle;?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/banner">Manage
    <?=$page?>s</a></div>
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
        <?
if(count($banner)>0)
{
?>
        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/banner/edit_banner/<?=$banner->banner_id?>"  enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="banner_image" class="col-sm-3 control-label">Banner
                <?=BANNERHOMEIMGSIZE?>
              </label>
              <div class="col-sm-4">
                <input type="file"  class="form-control" imgwidthheight="<?=BANNER_HOME_WIDTH?>X<?=BANNER_HOME_HEIGHT?>" name="banner_image" id="banner_image" >
              </div>
            </div>
            <div class="form-group">
              <label for="banner_image" class="col-sm-3 control-label"></label>
              <div class="col-sm-4"> <img src="<?=base_url().$banner->banner_path;?>" class="banner_edit_class"> </div>
            </div>
            
            <div class="form-group">
              <label for="caption" class="col-sm-3 control-label">Banner Caption</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="caption" id="caption" maxlength="45" value="<? if(isset($_POST['caption'])){ echo $_POST['caption']; }else{ echo $banner->caption; }?>">
              </div>
            </div>
            <div class="form-group">
              <label for="display_order" class="col-sm-3 control-label">Display Order</label>
              <div class="col-sm-4">
                <input type="text" maxlength="2"  class="form-control" name="display_order" id="display_order" value="<? if(isset($_POST["display_order"])){ echo $_POST["display_order"];}else{echo $banner->display_order; }?>" onKeyPress="return numericOnly(this);">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/banner">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
        <? } else { ?>
        <div class="box-body">
          <div style="text-align:center; font-size:24px;">Error occured open this page</div>
        </div>
        <? } ?>
      </div>
    </div>
  </div>
</section>
