<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/student">Manage <?=$page?>s
      
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
                      <th width="70%"><?=$student->student_name?></th>
                    </tr>
                     <tr>
                      <th width="30%">Father Name</th>
                      <th width="70%"><?=$student->student_fathername?></th>
                    </tr>
                    <? if($student->student_email!=""){ ?>
                    <tr>
                      <th width="30%">Email</th>
                      <th width="70%"><?=$student->student_email?></th>
                    </tr>
                    <? } ?>
                    
                     <tr>
                      <th width="30%">Mobile Number</th>
                      <th width="70%"><?=$student->student_mobile?></th>
                    </tr>
                     <? if($student->student_image!=""){ ?>
                    <tr>
                      <th width="30%">Profile Picture</th>
                      <th width="70%"><img src="<?=$student->student_image?>" style="max-width:200px;" /></img></th>
                    </tr>
                    <? } ?>
                     <? if($student->DOB!=""){ ?>
                     <tr>
                      <th width="30%">Date Of Birth</th>
                       <th width="70%"><?=date('d M Y',strtotime($student->DOB))?></th>
                    </tr>
                    <? } ?>
                    <? if($student->caste_community!=""){ ?>
                    <tr>
                      <th width="30%">Caste</th>
                      <th width="70%"><?=$student->caste_community?></th>
                    </tr>
                    <? } ?>
                     <? if($student->gender!=""){ ?>
                    <tr>
                      <th width="30%">Gender</th>
                      <th width="70%"><?=$student->gender?></th>
                    </tr>
                    <? } ?>
                    <? if($student->student_address!=""){ ?>
                    <tr>
                      <th width="30%">Address</th>
                      <th width="70%"><?=$student->student_address?></th>
                    </tr>
                    <? } ?>
                    <? if($student->student_city!=""){ ?>
                    <tr>
                      <th width="30%">Village</th>
                      <th width="70%"><?=$student->student_city?></th>
                    </tr>
                    <? } ?>
                    <? if($student->student_zip!=""){ ?>
                    <tr>
                      <th width="30%">Post Code</th>
                      <th width="70%"><?=$student->student_zip?></th>
                    </tr>
                    <? } ?>
                    <? if($student->student_district!=""){ ?>
                    <tr>
                      <th width="30%">District</th>
                      <th width="70%"><?=$student->student_district?></th>
                    </tr>
                    <? } ?>
                    <? if($student->student_state!=""){ ?>
                    <tr>
                      <th width="30%">State</th>
                      <th width="70%"><?=$student->student_state?></th>
                    </tr>
                    <? } ?>
                    
                    <? if($student->student_country!=""){ ?>
                    <tr>
                      <th width="30%">Country</th>
                      <th width="70%"><?=$student->student_country?></th>
                    </tr>
                    <? } ?>
                    <tr>
                      <th width="30%">Register Date</th>
                       <th width="70%"><?=date('d M Y',strtotime($student->register_date))?></th>
                    </tr>
                  </table>
                </div> 
              </div>
            </div>
          </div>
        </section>
