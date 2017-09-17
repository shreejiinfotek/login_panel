<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<!-- Bootstrap -->
<link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/style.css" rel="stylesheet">
<link href="<?=HTTP_ASSETS_PATH_CLIENT?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="shortcut icon" href="<?=HTTP_ASSETS_PATH_CLIENT?>images/favicon.ico">

<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/bootstrap.min.js"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.fancybox.pack.js"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/vaakash/jquery-easy-ticker/master/jquery.easy-ticker.min.js"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.easing.min.js"></script>


<script type="text/javascript" src="<?=HTTP_ASSETS_PATH_CLIENT?>js/common.js"></script>
<script type="text/javascript" src="<?=HTTP_ASSETS_PATH_CLIENT?>js/newslettersubscribe.js"></script>

</head>
<body>
<section class="header">
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="<?=base_url();?>login" class="navbar-brand log_img">MY Account</a>
        <div class="clearfix"></div>
      </div>
      
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
        
          <? if($this->session->userdata('is_student_login')){ ?>
           <li class="sign sign-up"><a href="<?=base_url();?>myaccount">My Account</a></li>
          <li class="sign sign-up"><a href="<?=base_url();?>login/logout">LogOut</a></li>
          
         <? } else { ?>
          <li class="sign "><a href="<?=base_url();?>register">Register</a></li>
          <li class="sign"><a href="<?=base_url();?>login">Log In</a></li>
         <? } ?>
        </ul>
      </div>
    </div>
  </nav>
</section>
<input type="hidden" name="site_url" id="site_url" value="<?=base_url();?>" />