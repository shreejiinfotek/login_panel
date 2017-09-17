<!Doctype html>
<html lang="en-gb" class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kusum Foundation | Otp Varification</title>
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="<?=HTTP_ASSETS_PATH_CLIENT?>images/favicon.ico" type="image/x-icon" />
	
    <link id="default-css" rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/style-login.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/responsive-login.css" type="text/css" media="all"/>
    <link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=HTTP_ASSETS_PATH_CLIENT?>js/common.js"></script>
    <script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/otp-form.js" type="text/javascript"></script>
	
</head>

<body>
<div class="regisration-wrapper">
	<div class="inner-wrapper bg_img">
    	<div id="login" class="modal">
                  <form class="modal-content animate" action="<?=base_url()?>otp_varfication/student_varification_update" name="LoginForm" id="LoginForm" method="post" style="width:50%;" onSubmit="return verify_login()" autocomplete="off">
            <div class="imgcontainer_form"><a href="<?=base_url();?>"><img src="<?=HTTP_ASSETS_PATH_CLIENT?>images/logo.png"></a>
                        </div>

            <div class="container_form" style="background-color:#f1f1f1">
            <?php if($this->session->flashdata('msg')){ ?>
                  <br class="clear">
                  <center style="color: green; font-size: 16px;line-height: 30px;">
                    <?php echo $this->session->flashdata('msg'); ?>
                  </center>
                  <br class="clear">
                  <? }
				  ?>
                  <?php if($this->session->flashdata('error')){ ?>
            <center style="color: red; font-size: 18px; line-height: 30px;">
              <?php echo $this->session->flashdata('error'); ?>
            </center>
            <? } 
?>
               <h1 style="text-align:center">OTP Varification</h1>   
              <label><b>Mobile</b></label>
              <input type="text" placeholder="Enter Mobile" name="user_mobile" id="user_mobile" value="<? if($this->session->userdata('user_mobile')!=""){echo $this->session->userdata('user_mobile'); }?>">
        		<span class="error" id="lblmobile"></span>
              <label><b>OTP Code</b></label>
              <input type="number" placeholder="Enter OTP" name="user_otp" id="user_otp">
                <span class="error" id="lblpassword"></span>
              <button type="submit" name="Submit" id="Submit" value="OTP Varification">OTP Varification</button>
             
              
              
                           <div class="other-btn">
          <div class="back"><b><a href="<?=base_url();?>">Return To Home <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
</a></b>
          </div>
          <div class="psw"><b> Not A Member ?</b><a href="<?=base_url();?>register"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Register Now !</a>
          </div>
          
          
        </div>
                          

          </form>
        </div>
        
	</div>
</div>
       
</body>
</html>
