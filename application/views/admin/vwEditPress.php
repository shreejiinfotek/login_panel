<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
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
<?
if(count($press)>0)
{
?>
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/press/edit_press/<?=$press->press_id;?>" enctype="multipart/form-data">
            <div class="box-body" >
              
              
           
              
              <div class="form-group ">
                <label for="caption" class="col-sm-3 control-label">Press Title</label>
                <div class="col-sm-4">
                  <input type="text"  class="form-control" name="press_title" id="press_title" maxlength="200" value="<? if(isset($_POST["press_title"])){ echo $_POST["press_title"];}else{ echo $press->press_title;}?>">
                </div>
              </div>
              
              
              
              <div class="form-group Image">
                <label for="press_pdf" class="col-sm-3 control-label">Press (PDF)</label>
                <div class="col-sm-4">
                  <input type="file"  class="form-control" name="press_pdf" id="press_pdf" ></div>
                </div>
              <div class="form-group Image">
                <label for="large_image_path" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                  
                  <a href="<?=base_url().$press->pdf_path;?>" download=""><i class="fa fa-download fa-lg"></i>Download</a>
                </div>
              </div>
              
              <div class="form-group">
                <label for="created_date" class="col-sm-3 control-label"><span class="required">*</span>Date</label>
                <div class="col-sm-2">
                    <input type="text" required  class="form-control date" name="created_date" id="created_date"  value="<? if(isset($_POST["created_date"])){ echo $_POST["created_date"];}else{echo date("m/d/Y",strtotime($press->press_date));}?>" data-msg-required="Please enter date.">
                </div>
              </div>
             
              
            
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer" > <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/press">Cancel</a>
              <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
<?
}
else
{
?>
<div class="box-body">
<div style="text-align:center; font-size:24px;">Error occured open this page</div>
</div>
<?
}
?>

        </div>
      </div>
    </div>
  </section>
  <script>
  $(function() {
    $("#created_date").datepicker();
	});
</script>