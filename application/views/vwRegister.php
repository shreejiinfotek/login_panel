<!Doctype html>
<html lang="en-gb" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?

		if(!empty($meta_title))
		{
			
			$title=$meta_title;
			$meta_description=$meta_title;
			$meta_keyword=$meta_title;
		}
		else
		{
			$title=$content->meta_title;
			$meta_description=$content->meta_description;
			$meta_keyword=$content->meta_keyword;
		}
		?>
<title><?=$title?></title>
<meta content="<?=$meta_description?>" name="description" />
<meta content="<?=$meta_keyword;?>" name="keywords" />
<link rel="shortcut icon" href="<?=HTTP_ASSETS_PATH_CLIENT?>images/favicon.ico" type="image/x-icon" />
	
<link id="default-css" rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/style-login.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/responsive-login.css" type="text/css" media="all"/>
<link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.js" type="text/javascript"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/user-register.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
</head>

<body>
<div class="regisration-wrapper">
	<div class="regisration-wrapper bg_img">
  <div class="inner-wrapper bg_img">
    <div id="registration" class="modal">
    
      <form class="modal-content animate" name="registrationForm" id="registrationForm" action="<?=base_url()?>register/register_users" method="post" onSubmit="return verify()" autocomplete="off" enctype="multipart/form-data">
        <div class="imgcontainer_form"><a href="<?=base_url();?>"><img src="<?=HTTP_ASSETS_PATH_CLIENT?>images/logo.png"></a></div>
                <div class="container_form" style="background-color:#f1f1f1">
                 <?php if($this->session->flashdata('msg')){ ?>
                  <br class="clear">
                  <center style="color: green; font-size: 15px;">
                    <?php echo $this->session->flashdata('msg'); ?>
                  </center>
                  <br class="clear">
                  <? }
				  ?>
        <div class="form-left">
        <input type="hidden" name="hid_base_url" id="hid_base_url" value="<?=base_url();?>" />
          <label><b>Full Name<span class="required">*</span></b></label>
          <input type="text" placeholder="Full Name" name="fullname" id="fullname" class="artist-input">
           <span class="error" id="lblfname"></span>
           <label><b>Father's Name<span class="required">*</span></b></label>
          <input type="text" placeholder="Father's name" name="father_name" id="father_name" class="artist-input">
           <span class="error" id="lblfathername"></span>
          <label><b>Email</b></label>
          <input type="text" placeholder="Email" name="user_email" id="user_email" class="artist-input" >
          <span class="error" id="lblemail"></span>
          <label><b>Mobile<span class="required">*</span></b></label>
          <input type="text" placeholder="10 Digit Mobile Number" name="user_mobile" id="user_mobile" class="artist-input" onBlur="duplicate_mobile(this.value);">
          <span>** Your Mobile Number is Your Username.<br /></span>
          <span class="error" id="lblmobile"></span>
          <label><b>Password<span class="required">*</span></b></label>
          <input type="password" placeholder="Password" name="user_password" id="user_password" class="artist-input">
         <span class="error" id="lblpassword"></span>
         <label><b>Retype Password<span class="required">*</span></b></label>
          <input type="password" placeholder="Retype Password" name="user_retype_password" id="user_retype_password" class="artist-input">
         <span class="error" id="lblrepassword"></span>
          <label><b>Profile Picture</b></label>
          <input type="file" placeholder="Profile Picture" name="user_profile" id="user_profile" class="artist-input">
          <span class="error" id="lblfile"></span> 
            
          
          <label><b>Date Of Birth<span class="required">*</span></b></label><br />
          <input type="text" placeholder="Date Of Birth" readonly style="max-width:200px;" name="dob" id="dob" class="artist-input">
        
          <span class="error" id="lbldob"></span>
          
          </div>
          <div class="form-right">
          <label><b>Demography</b></label>
            <select class="form-control" name="cast_name" id="cast_name">
                <option value="APL">APL</option>
                <option value="BPL">BPL</option>
                <option value="SC & ST">SC & ST </option>
                
            </select>
           <label><b>Gender<br /></b></label>
          <input type="radio" name="gender" value="male" checked> Male
  		  <input type="radio" name="gender" value="female"> Female
  		  <input type="radio" name="gender" value="other"> Other<br />
          
          <label><b>Address</b></label>
          <textarea name="user_address" id="user_address" placeholder="Address" class="artist-input" rows="5"></textarea>
          <span class="error" id="lbladdress"></span>
          <label><b>Village</b></label>
          <input type="text" placeholder="Village" name="user_city" id="user_city" class="artist-input">
           <span class="error" id="lblcity"></span>
           <label><b>Post Code</b></label>
          <input type="text" placeholder="Post Code" name="user_zip" id="user_zip" class="artist-input">
          <span class="error" id="lblzip"></span>
          <label><b>District</b></label>
          <input type="text" placeholder="District" name="user_district" id="user_district" class="artist-input">
          <span class="error" id="lbldistrict"></span>
          <label><b>State</b></label>
          <input type="text" placeholder="State" name="user_state" id="user_state" class="artist-input">
          <span class="error" id="lblstate"></span>
          <label><b>Country</b></label>
            <select class="form-control" name="country_name" id="country_name">
                <option value="">--Select Country--</option>
                <option value="India">India</option>
                <option value="United Kingdom">United Kingdom </option>
                <option value="USA">USA </option>
            </select>
  
          <span class="error" id="lblstate"></span>
          
          
          
          
         
          
          </div>
          <div class="submit-btn">
          <button type="submit" name="Submit" id="Submit" value="Register">Register</button>
          </div>
          <div class="other-btn">
          <div class="back"><b><a href="<?=base_url()?>">Return To Home <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
</a></b>
          </div>
          <?
		  
		  if($this->session->userdata('is_otp_varification')=="" || $this->session->userdata('is_otp_varification')==0){ ?>
          
          <div class="back otp"><a href="<?=base_url()?>otp-varfication">OTP Verification <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></div>
          
          <? } ?>
          <div class="psw"><b> Already Registered ? </b><a href="<?=base_url()?>login"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Login Now !</a>
          </div>
          
          
        </div>
      </form>
    </div>
  </div>
</div>
</div>
       
</body>
</html>
<script>
 //var dateToday = new Date();
//var yrRange = (dateToday.getFullYear() - 50) + ":" + (dateToday.getFullYear() - 10);
//var start = new Date();
//start.setFullYear(start.getFullYear() - 70);
//var end = new Date();
//end.setFullYear(end.getFullYear() - 10);
//  
//  $( function() {
//    $( "#dob" ).datepicker({
//		
//			changeMonth: true,
//            changeYear: true,
//			minDate: start,
//        	
//			 yearRange: start.getFullYear() + ':' + end.getFullYear(),
//			
//								
//	});
//  } );
  var d = new Date();
var year = d.getFullYear() - 10;
d.setFullYear(year);
$('#dob').datepicker({ changeYear: true, changeMonth: true, yearRange: '1950:' + year + '', defaultDate: d});
  </script>