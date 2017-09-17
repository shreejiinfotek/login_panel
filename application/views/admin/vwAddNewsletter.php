<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/newsletter">Manage <?=$page;?>s
      
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
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/newsletter/add_newsletterform">
            <div class="box-body">
              <div class="form-group">
                <label for="subject" class="col-sm-3 control-label"><span class="required">*</span>Subject</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control"  maxlength="100" name="subject" id="subject" value="<? if(isset($_POST["subject"])){ echo $_POST["subject"]; }?>"  data-msg-required="Please enter subject.">
                </div>
              </div>
              
              <div class="form-group">
                <label for="description" class="col-sm-3 control-label"><span class="required">*</span>Description</label>
                <div class="col-sm-7">
                    <textarea required class="form-control" name="description" id="description" rows="3" ><? if(isset($_POST["description"])){ echo $_POST["description"];}?></textarea>
                    <label for="description" id="error_description"  style="display:none;"  class="errorCK">Please enter description.</label>
                </div>
              </div>
              
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >
            <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/newsletter">Cancel</a>
           
                <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>