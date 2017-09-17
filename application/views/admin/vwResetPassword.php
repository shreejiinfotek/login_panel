<div class="login-box-body">
  <p class="login-box-msg">Reset password</p>
  <?
	if(isset($chk) && $chk!="")
	 {
		 ?>
  <p style="color:#060;">
    <?=$chk?>
  </p>
  <br/>
  <br/>
  <?
		 
	 }
	 else
	 {
	 ?>
  <form id="CustomValidation" class="da-home-form" method="post" action="<?php echo base_url(); ?>admin/reset_password/update_password/<?=$admin_user[0]['verification_code']?>" enctype="multipart/form-data" autocomplete="off">
    <div class="form-group has-feedback">
      <input  type="password" required name="txtnewpassword" id="txtnewpassword" class="form-control" placeholder="New Password" />
    </div>
    <div class="form-group has-feedback">
      <input  type="password" required name="txtconfirmpassword" id="txtconfirmpassword" class="form-control" placeholder="Confirm Password" />
    </div>
    <div class="row">
      <!-- /.col -->
      <div class="col-xs-6">
        <input  name="submit" type="submit" value="Reset Password" class="btn btn-primary btn-block btn-flat">
      </div>
      <!-- /.col -->
    </div>
  </form>
  <?
	 }
	?>
  <a href="<?=base_url()?>admin/home" class="pull-right">Back to login</a><br>
</div>
