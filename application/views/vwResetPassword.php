<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/reset_password.js" type="text/javascript"></script>

<div class="login">
  <div class="container min-sreen-height">
    <div class="row">
      <div class="col-md-12 MB110">
        <h1>
          <?=$content->page_title;?>
        </h1>
      </div>
    </div>
    <?

if(isset($chk)  && $chk!="")
{
	$action_path="";
}
else
{
	$action_path=base_url().'reset_password/update_password/'.$reset_password->verification_code;
}
?>
    <form action="<?=$action_path?>" method="post" id="Form" onSubmit="return reset_password()">
      <div class="row MB85">
        <?
if(isset($chk)  && $chk!="")
{
	?>
        <center class="success-msg">
          <?php echo $chk; ?>
        </center>
        <div class="forgot-pwd"> </div>
        <?
}
else
{
?>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          	<span id="lblpassword"></span>
            <input type="password" name="password" id="password" class="form-control text-box" placeholder="New Password">
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          	<span id="lblrepassword"></span>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control text-box" placeholder="Confirm Password">
            <br>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        	<p><?=$reset_password->security_questions?>?</p>
        	
          <div class="form-group ans_form_group">
            <span id="lblans"></span>
            <input type="text" name="security_answer" id="security_answer" class="form-control text-box" placeholder="Security Answer">
            <input type="hidden" value="<?=$reset_password->register_user_security_answer?>" name="hid_security_answer" id="hid_security_answer" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button type="submit" class="btn btn-default">Reset Now</button>
          <div class="forgot-pwd"> </div>
        </div>
        <?
}
?>
      </div>
    </form>
  </div>
</div>
