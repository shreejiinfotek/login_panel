<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
      </h1>
    </div>
    <div class="headerbutton"><!--<a class="btn btn-info" href="<?//php echo base_url(); ?>admin/location/">Manage <?//=$page?>s
      
      </a>--></div>
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
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/google_analytics/index">
            <div class="box-body">
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="google_analytics_code" class="col-sm-3 control-label">Google Analytics Code</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="google_analytics_code" id="google_analytics_code" rows="6" maxlength="500" data-msg-required="Please enter google analytics code."><? if(isset($_POST["google_analytics_code"])){ echo $_POST["google_analytics_code"]; }else{ echo $google_analytics->google_analytics_code; }?></textarea>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >

                <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>