<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/attendence">Manage 
    Attendence
    </a>
      
      </div>
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
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/attendence/import" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              <div class="form-group da-form-row">
                <label for="import_path" class="col-sm-3 control-label"><span class="required">*</span>Select Excel File(.xls /.xlsx)</label>
                <div class="col-sm-3">
                  <input type="file" required class="form-control" name="import_path"  id="import_path" data-msg-required="Please upload attendence excel sheet.">
                </div>
              </div>
              <?
			  if($this->session->flashdata('error') || $this->session->flashdata('import')>0)
			  {
			  ?>
                    <div class="form-group da-form-row">
                    <label class="col-sm-2 control-label">Rows Import</label>
                    <div class="col-sm-3 paddingtop5">
                     <?
                     echo $this->session->flashdata('import');
                     ?>
                    </div>
                  </div>
                  <?
                  if($this->session->userdata('file_name'))
                  {
                  ?>
                  <div class="form-group da-form-row">
                    <label class="col-sm-2 control-label">Failed Rows</label>
                    <div class="col-sm-3 paddingtop5">
                     <?
                      if(file_exists('./uploads/Course/'.$this->session->userdata('file_name').''))
                      {
                      ?>
                      <a href="<?php echo base_url(); ?>uploads/Course/<?=$this->session->userdata('file_name');?>" download>Download</a>
                      <?
                      }
                      ?>
                    </div>
                  </div>
                  <?
                  }
				  ?>
				  <?
                  
			  }
              ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >
              <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/attendence">Cancel</a>
           
              <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Upload</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>