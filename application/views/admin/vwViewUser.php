<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/user">Manage <?=$page?>s
      
      </a></div>
  </section>
  <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                
                <div class="box-body">
                  <table class="table table-bordered tableformat" width="100%">
                    <tr>
                      <th width="30%">Full Name</th>
                      <th width="70%"><?=$user->username?></th>
                    </tr>
                    <? if($user->profile_path!=""){ ?>
                    <tr>
                      <th width="30%">Profile Picture</th>
                      <th width="70%"><img src="<?=$user->profile_path?>" style="max-width:200px;" /></img></th>
                    </tr>
                    <? } ?>
                    <tr>
                      <th width="30%">Email</th>
                      <th width="70%"><?=$user->email?></th>
                    </tr>
                     <tr>
                      <th width="30%">Contact Number</th>
                      <th width="70%"><?=$user->phone_number?></th>
                    </tr>
                     
                    
                    <tr>
                      <th width="30%">Register Date</th>
                       <th width="70%"><?=date('d M Y',strtotime($user->created_date))?></th>
                    </tr>
                  </table>
                </div> 
              </div>
            </div>
          </div>
        </section>
