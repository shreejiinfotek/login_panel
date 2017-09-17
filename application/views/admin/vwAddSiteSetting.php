<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/site_setting">Manage <?=$page;?>s
      
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
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/site_setting/add_site_setting">
            <div class="box-body">
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"><span class="required">*</span>Caption</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control"  maxlength="500" name="caption" id="caption" value="<? if(isset($_POST["caption"])){ echo $_POST["caption"]; }?>" data-msg-required="Please enter caption." >
                </div>
              </div>
              <div class="form-group">
                <label for="meta_keyword" class="col-sm-3 control-label"><span class="required">*</span>Value</label>
                <div class="col-sm-4">
                 <textarea required class="form-control" name="value" id="value" maxlength="4000" rows="3" data-msg-required="Please enter value."><? if(isset($_POST["value"])){ echo $_POST["value"];}?></textarea>
                </div>
              </div>
			 <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"><span class="required">*</span>Site Key</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control"  maxlength="100" name="site_key" id="site_key" value="<? if(isset($_POST["site_key"])){ echo $_POST["site_key"]; }?>" data-msg-required="Please enter site key." >
                </div>
              </div>
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >
            <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/site_setting">Cancel</a>
           
                <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>