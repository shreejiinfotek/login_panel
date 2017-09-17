<div class="login-box-body">
  <p class="login-box-msg reset-title">Forgot password</p>
  <?  if($this->session->flashdata('error')) { ?>
  <div class="callout callout-danger lead">
    <p>
      <?=$this->session->flashdata('error')?>
    </p>
  </div>
  <? } ?>
  <?php if($this->session->flashdata('message')){ ?>
  <div class="callout callout-success lead">
    <p> <?php echo $this->session->flashdata('message'); ?></p>
  </div>
  <? }
?>
  <form  id="login" class="da-home-form" action="<?php echo base_url(); ?>admin/forgot_password/send_mail" method="post" autocomplete="off">
    <div class="form-group has-feedback">
      <input  type="email" required name="email" class="form-control" placeholder="Email" />
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
    <div class="row">
      <div class="col-xs-6">
        <input  name="submit" type="submit" value="Reset Password" class="btn btn-primary btn-block btn-flat">
      </div>
    </div>
  </form>
  <a href="<?=base_url()?>admin/home" class="pull-right">Back to login</a><br>
</div>
