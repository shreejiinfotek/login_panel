<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/press">Manage <?=$page?>
      
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
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/press/add_press" enctype="multipart/form-data" novalidate>
            <div class="box-body">
            
              
              <div class="form-group Image">
                <label for="press_title1" class="col-sm-3 control-label"><span class="required">*</span>Press Title</label>
                <div class="col-sm-4">
                  <input type="text" required class="form-control" name="press_title" id="press_title" maxlength="50" value="<? if(isset($_POST["press_title1"])){ echo $_POST["press_title"];}?>"  data-msg-required="Please enter press title.">
                </div>
              </div>
         
              <div class="form-group Image">
                <label for="press_pdf" class="col-sm-3 control-label"><span class="required">*</span>Press (PDF)</label>
                <div class="col-sm-4">
                  <input type="file" required class="form-control" name="press_pdf"  id="press_pdf" data-msg-required="Please upload press pdf.">
                </div>
              </div>
              <div class="form-group">
                <label for="created_date" class="col-sm-3 control-label"><span class="required">*</span>Date</label>
                <div class="col-sm-2">
                  <input type="text" required class="form-control date" name="created_date" id="created_date"  value="<? if(isset($_POST["created_date"])){ echo $_POST["created_date"];}?>" data-msg-required="Please enter date." >
                </div>
              </div>
              </div>
            <!-- /.box-body -->
            <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/press">Cancel</a>
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
  </script>
  