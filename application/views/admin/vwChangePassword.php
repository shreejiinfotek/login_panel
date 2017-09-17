<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"></div>
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
            <form id="CustomValidation" class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/change_password/update_password/<?=$admin->id?>" enctype="multipart/form-data">
            <div class="box-body">
            	<div class="form-group">
                	<label for="page_name" class="col-sm-3 control-label"></label>
               			<div class="col-sm-4">
                    		<span class="required"><?php echo validation_errors(); ?></span>
               		 </div>
              	</div>
              <div class="form-group da-form-row">
                <label class="col-sm-3 control-label">Username</label>
                <div class="col-sm-4">
                 <input type="text"  readonly  class="form-control" name="txtemail" maxlength="100" id="txtemail" value="<?=$admin->email?>" >
                 
                </div>
              </div>
              <div class="form-group">
                <label for="txtoldpassword" class="col-sm-3 control-label"><span class="required">*</span>Old Password</label>
                <div class="col-sm-4">
                    <input required name="txtoldpassword" id="txtoldpassword"   maxlength="100"  type="password" class="form-control"  value="" data-msg-required="Please enter old password."/>
                  <input name="txtold" type="hidden"  id="hdoldpassword" value="<?=$this->encrypt->decode($admin->password)?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="txtnewpassword" class="col-sm-3 control-label"><span class="required">*</span>New Password</label>
                <div class="col-sm-4">
                  <input required name="txtnewpassword" id="txtnewpassword"   maxlength="100"  type="password" class="form-control"  value="" data-msg-required="Please enter new password."/>
                </div>
              </div>
              <div class="form-group">
                <label for="txtconfirmpassword" class="col-sm-3 control-label"><span class="required">*</span>Confirm Password</label>
                <div class="col-sm-4">
                  <input required name="txtconfirmpassword" id="txtconfirmpassword" type="password"  maxlength="100"  class="form-control"  value="" data-msg-required="Please enter confirm password."/>
                </div>
              </div>
               
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer" >
                        
              <button type="submit" name="Submit" value="Change Password" id="Submit" class="btn btn-info pull-right">Change Password</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>