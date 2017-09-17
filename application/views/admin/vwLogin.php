<div class="login-box-body">
  <p class="login-box-msg">Sign in to start your session</p>
  <?  if(isset($error) && $error !='') { ?>
  <div class="callout callout-danger lead">
    <p>
      <?=$error?>
    </p>
  </div>
  <? } ?>
  <form  id="login" class="da-home-form" action="<?php echo base_url(); ?>admin/home/do_login" method="post" autocomplete="off">
    <div class="form-group has-feedback">
      <input type="email" required name="username" class="form-control" placeholder="Email" value="" />
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
    <div class="form-group has-feedback">
      <input type="password" required name="password" class="form-control" placeholder="Password" />
      <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
    <div class="row">
      <div class="col-xs-4">
        <input  name="submit" type="submit" value="Sign In" class="btn btn-primary btn-block btn-flat">
      </div>
    </div>
  </form>
  <a style="float:right" href="<?php echo base_url(); ?>admin/forgot_password">I forgot my password</a><br>
</div>
