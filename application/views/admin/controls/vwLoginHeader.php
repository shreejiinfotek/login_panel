<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?
$project_name=$this->data['admin_site_settings']->site_project_name;
?>
<title>Welcome to
<?=$project_name?>
</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/custom.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<? echo HTTP_ASSETS_PATH_CLIENT;?>images/favicon.ico" />
</head>
<body class="login-page">
<header class="main-header" >
  <!-- Logo -->
  <a href="<?php echo base_url(); ?>admin/dashboard" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="<? echo HTTP_ASSETS_PATH_CLIENT;?>images/favicon.ico"/></span>
  <!-- logo for regular state and mobile devices -->
 	
	    <span class="logo-lg"><img alt="<?=$this->data['admin_site_settings']->site_project_name?> Admin"  src="<? echo HTTP_ASSETS_PATH_CLIENT;?>images/logo.png"/></span>
	
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation"><br>
    <div class="admintext"> Welcome To Admin Area </div>
  </nav>
</header>
<div class="login-box">
  <div class="login-logo"><b>Admin</b>&nbsp;
    <?=$project_name?>
  </div>