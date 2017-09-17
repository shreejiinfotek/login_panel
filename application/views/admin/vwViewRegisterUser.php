<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/register_user">Manage Users</a></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
          <div id="delete_allmsg_div"></div>
            <? //include "Controls/admin-message.php"; ?>
          </div>
          <div class="box-body">
            <table class="table table-bordered tableformat" width="100%">
                    
                     <tr>
                      <th width="30%">Name</th>
                      <th width="70%"><?=$register_user->register_user_first_name?> <?=$register_user->register_user_last_name?></th>
                    </tr>
                     <tr>
                      <th width="30%">Email</th>
                      <th width="70%"><?=$register_user->register_user_email;?></th>
                    </tr>
                     <tr>
                      <th width="30%">Phone Number</th>
                      <th width="70%"><?=$register_user->register_user_phone_number?></th>
                    </tr>
                    <? if($register_user->register_user_profile_picture !=''){ ?>
                    <tr>
                      <th width="30%">Profile</th>
                     <th width="70%"><img src="<?=base_url().$register_user->register_user_profile_picture;?>" class="image-admin-display"></th>
                    </tr>
                    <? } ?>
                    <? if($register_user->security_questions !="") { ?>
                     <tr>
                      <th width="30%">Security Question</th>
                      <th width="70%"><?=$register_user->security_questions?></th>
                    </tr>
                    <? } ?>
                    <? if($register_user->register_user_security_answer !="") { ?>
                     <tr>
                      <th width="30%">Security Answer</th>
                      <th width="70%"><?=$register_user->register_user_security_answer?></th>
                    </tr>
                    <? } ?>
                     <tr>
                      <th width="30%">Register Date</th>
                      <th width="70%"><?=date('d M Y',strtotime($register_user->created_date))?></th>
                    </tr>
                  </table>
          </div>
        </div>
      </div>
    </div>
  </section>
