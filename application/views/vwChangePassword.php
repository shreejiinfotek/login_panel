.<link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/custom.css" rel="stylesheet">
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/changepassword.js" type="text/javascript"></script>

 <section class="cms-page">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-title">
          <?=$content->page_title?>
        </h1>
      </div>
      <div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <section class="myaccount">
        <div class="text-form">
                
          <div class="margin20"></div>
                    
          <form id="frmcpass" class="form" name="frmcpass" action="<?=base_url();?>change_password/update_password" method="POST" onSubmit="return verify();" enctype="multipart/form-data">
          <div class="FloatRightIndicates"> <span class="error">*</span> Indicates a required field </div>
          <br class="clear" />
          <br class="clear" />
          <br class="clear" />
          <ul id="Rform">

            <li> <span class="error">*</span>
              <label>Old Password</label>
              <input name="txtoldpass" id="txtoldpass" maxlength="20"  type="password" />
              &nbsp;<span id="lbloldpass" class="error"></span>
              <input name="txtold" type="hidden"  id="txtold" value="<?=$this->encrypt->decode($student->password)?>" />
            </li>
            <li> <span class="error">*</span>
              <label>New Password</label>
              <input name="txtnewpass" id="txtnewpass"  maxlength="20" type="password" />
              &nbsp;<span  id="lblnewpass" class="error"></span> </li>
            <li> <span class="error">*</span>
              <label>Confirm Password</label>
              <input name="txtconpass" id="txtconpass"  type="password"/>
              &nbsp;<span id="lblconpass" class="error"></span> </li>
            <li>
              <div class="margin10"></div>
              <label class="btn-margin"></label>
              &nbsp;&nbsp;
              
              <button type="submit" name="submit" id="submit" class="btn btn-blue btn-default" value="Change Password">Change Password</button>
            </li>
          </ul>
        </form>
       
      </div>
      </section>
      </div>
    </div>
  </div>
</section>

