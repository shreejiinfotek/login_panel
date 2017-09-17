<!Doctype html>
<html lang="en-gb" class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kusum Foundation | Forgot Password</title>
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="<?=HTTP_ASSETS_PATH_CLIENT?>images/favicon.ico" type="image/x-icon" />
	
    <link id="default-css" rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/style-login.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/responsive-login.css" type="text/css" media="all"/>
    <script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=HTTP_ASSETS_PATH_CLIENT?>js/common.js"></script>
    <script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/forgot-form.js" type="text/javascript"></script>
	
</head>

<body>
<div class="regisration-wrapper">
	<div class="inner-wrapper bg_img">
    	<div id="login" class="modal">
                  <form class="modal-content animate" action="<?=base_url();?>forgot_password/send_mail" name="LoginForm" id="LoginForm" method="post" style="width:50%;" onSubmit="return verify_login()" autocomplete="off">
            <div class="imgcontainer_form"><a href="<?=base_url();?>"><img src="<?=HTTP_ASSETS_PATH_CLIENT?>images/logo.png"></a>
                        </div>

            <div class="container_form" style="background-color:#f1f1f1">
            <?php if($this->session->flashdata('message')){ ?>
        <br class="clear">
        <center style="color: green; font-size: 15px;">
          <?php echo $this->session->flashdata('message'); ?>
        </center>
        <br class="clear">
        <? }
				  ?>
        <?php if($this->session->flashdata('error')){ ?>
        <center style="color: red; font-size: 15px;">
          <?php echo $this->session->flashdata('error'); ?>
        </center>
        <? } 
?>
             <label><b>Mobile</b></label>
        <input type="text" placeholder="Enter Mobile" name="user_mobile" id="user_mobile">
        <span class="error" id="lblmobile"></span>
              
             
              <button type="submit" name="Submit" id="Submit" value="Login">Forgot Password</button>
             
              
              <div class="psw"><b>Login ? </b><a href="<?=base_url();?>login">Login Now !</a>
              <span class="forgot-pass"><b></b><a href="<?=base_url();?>">Home</a></span> </div>
            </div>

          </form>
        </div>
        
	</div>
</div>
       
</body>
</html>
