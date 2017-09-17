<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/banner">Manage
    <?=$page;?>s</a></div>
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
        <form class="da-home-form form-horizontal"  method="post" action="<?php echo base_url(); ?>admin/banner/add_banner" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="page_name" class="col-sm-3 control-label"></label>
              <div class="col-sm-4"> <span class="required"><?php echo validation_errors(); ?></span> </div>
            </div>
            <div class="form-group">
              <label for="banner_image" class="col-sm-3 control-label"><span class="required">*</span>Banner
                <?=BANNERHOMEIMGSIZE?>
              </label>
              <div class="col-sm-4">
                <input type="file" required class="form-control" imgwidthheight="<?=BANNER_HOME_WIDTH?>X<?=BANNER_HOME_HEIGHT?>" name="banner_image"  id="banner_image" value="<? if(isset($_POST["banner_image"])){ echo $filepath; }?>" data-msg-required="Please upload banner." >
              </div>
            </div>
             <div class="form-group">
              <label for="caption" class="col-sm-3 control-label"><span class="required">*</span>Banner Caption</label>
              <div class="col-sm-4">
                <input type="text" required class="form-control"  maxlength="45" name="caption" id="caption" value="<? if(isset($_POST['caption'])){ echo $_POST['caption']; }?>" data-msg-required="Please enter banner caption.">
              </div>
            </div>
          
            <div class="form-group">
              <label for="display_order" class="col-sm-3 control-label">Display Order</label>
              <div class="col-sm-4">
                <input type="text" maxlength="2"  class="form-control" name="display_order" id="display_order" value="<? if(isset($_POST["display_order"])){ echo $_POST["display_order"];}?>" onKeyPress="return numericOnly(this);" >
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/banner">Cancel</a>
            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
  </div>
</section>
