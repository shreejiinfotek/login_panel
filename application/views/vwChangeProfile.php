<link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/custom.css" rel="stylesheet">
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/changeprofile.js" type="text/javascript"></script>


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
                    
          <form id="frmreg" class="form" name="frmreg" action="<?=base_url();?>change_profile/update_profile" method="POST" onSubmit="return changeprofileverify();" enctype="multipart/form-data">
          <div class="FloatRightIndicates"> <span class="error">*</span> Indicates a required field </div>
          <br class="clear" />
          <ul id="Rform">
            <li> <span class="error">*</span>
              <label>Full Name</label>
              <input type="text"  maxlength="200" name="student_name" id="student_name" value="<?=$student->student_name?>">
               <span class="error" id="lblname"></span> </li>
            </li>
            <li> <span class="error">*</span>
              <label>Father Name</label>
              <input type="text"  maxlength="200" name="student_fathername" id="student_fathername" value="<?=$student->student_fathername?>">
               <span class="error" id="lblfname"></span> </li>
            </li>
            <li> <span  style="visibility:hidden" class="error">*</span>
              <label>Email</label>
              <input type="text" maxlength="200" name="student_email" id="student_email" value="<?=$student->student_email?>">
              <span class="error" id="lblemail"></span> </li>
              
             <li> <span class="error">*</span>
              <label>Mobile</label>
              <input type="text"  disabled="disabled" maxlength="10" name="student_email" id="student_email" value="<?=$student->student_mobile?>">
              <span class="error" id="lblemail"></span> </li>
              
              <li> <span  style="visibility:hidden" class="error">*</span>
              <label>Change Profile</label>
              <input type="file" name="student_image" id="student_image" >
              <span class="error" id="lblmobile"></span> </li>
              <li> <span  style="visibility:hidden" class="error">*</span>
              <label></label>
              <? if($student->student_image!=""){ ?>
              <img src="<?=base_url().$student->student_image?>" alt="profile" style="width:100px; height:100px;" />
              <? } ?>
             </li>
             <li> <span class="error">*</span>
              <label>Date Of Birth</label>
              <input type="text" style="max-width:150px;" name="dob" id="dob" value="<?=$student->DOB?>">
              <span class="error" id="lbldob"></span> </li>
              <li><span class="error" style="visibility:hidden">*</span>
              <label>Demography</label>
              <select name="caste_community" id="caste_community">
                        <option value="">--Select Demography--</option>
                        <option value="APL" <? if($student->caste_community=="APL"){?>selected <? } ?>>APL</option>
                        <option value="BPL" <? if($student->caste_community=="BPL"){?>selected <? } ?>>BPL </option>
                        <option value="SC & ST" <? if($student->caste_community=="SC & ST"){?>selected <? } ?>>SC & ST </option>
                 </select>
               </li>
               <br />
              <li><span class="error" style="visibility:hidden">*</span>
              <label>Gender</label>
               <input type="radio" name="gender" value="Male" class="checkbox_span" <? if($student->gender=="Male"){ ?>checked <? } ?> > Male
                <input type="radio" name="gender" value="Female" class="checkbox_span" <? if($student->gender=="Female"){ ?>checked <? } ?>> Female
                <input type="radio" name="gender" value="Other" class="checkbox_span" <? if($student->gender=="Other"){ ?>checked <? } ?>> Other<br />
               </li>
               <br />
            <li> <span class="error align-top" style="visibility:hidden">*</span>
              <label  class="align-top">Address</label>
              <textarea name="student_address" id="student_address" style="height:70px;"  rows="2"><?=$student->student_address?></textarea>
              <span class="error" style="vertical-align:top" id="lbladdress"></span> </li>
               <li><span class="error" style="visibility:hidden">*</span>
              <label>Village </label>
              <input name="city" type="text"  id="city"   value="<?=$student->student_city?>" maxlength="100"/>
              <span class="error" id="lblcity"></span> </li>
               <li> <span  style="visibility:hidden" class="error">*</span>
              <label>Post Code </label>
              <input name="zip" type="text"  id="zip" value="<?=$student->student_zip?>"  maxlength="10" />
            </li>
              <li><span class="error" style="visibility:hidden">*</span>
              <label>District</label>
              <input name="student_district" type="text"  id="student_district"   value="<?=$student->student_district?>" maxlength="100"/>
              <span class="error" id="student_district"></span> </li>
              <li><span class="error" style="visibility:hidden">*</span>
              <label>State</label>
              <input name="state" type="text"  id="state"   value="<?=$student->student_state?>" maxlength="100"/>
              <span class="error" id="lblstate"></span> </li>
              
              
           
            
            
           
            <li><span class="error" style="visibility:hidden">*</span>
              <label>Country</label>
              <select name="student_country" id="student_country">
                        <option value="">--Select Country--</option>
                        <option value="India" <? if($student->student_country=="India"){?>selected <? } ?>>India</option>
                        <option value="United Kingdom" <? if($student->student_country=="United Kingdom"){?>selected <? } ?>>United Kingdom </option>
                        <option value="USA" <? if($student->student_country=="USA"){?>selected <? } ?>>USA </option>
                 </select>
               </li>
            
            <li>
              <div class="margin20"></div>
              <label class="btn-margin"></label>
              &nbsp;&nbsp;
              <button type="submit" name="submit" id="submit" class="btn btn-blue btn-default" value="Change Profile">Change Profile</button>
              
            </li>
          </ul>
        </form>
       
      </div>
      </section>
      </div>
    </div>
  </div>
</section> 
<script>
var start = new Date();
start.setFullYear(start.getFullYear() - 70);
var end = new Date();
end.setFullYear(end.getFullYear() - 10);


  $( function() {
    $( "#dob" ).datepicker({
			
			autoclose: true,
			changeMonth: true,
            changeYear: true,
			yearRange: start.getFullYear() + ':' + end.getFullYear(),
			
			
								
	});
  } );
  </script>

