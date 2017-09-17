<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to <?=$this->data['admin_site_settings']->site_project_name;?> Admin

</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/custom.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/daterangepicker.css" rel="stylesheet" type="text/css" />
<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />

<link href="<? echo HTTP_ASSETS_PATH_ADMIN;?>css/jquery-ui.css" rel="stylesheet" type="text/css">

<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/jquery-1.10.2.js" type="text/javascript"></script>
<link rel="shortcut icon" href="<?=HTTP_ASSETS_PATH_CLIENT;?>images/favicon.ico?v=1" />
</head>
<div id="loadingPanel" class="loadingPanel"> &nbsp; </div>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header" >
  <!-- Logo -->
  <a href="<?php echo base_url(); ?>admin/dashboard" class="logo">
  <!-- logo for regular state and mobile devices -->
  
 	
	    <span class="logo-lg"><img alt="<?=$this->data['admin_site_settings']->site_project_name?> Admin"  src="<?=HTTP_ASSETS_PATH_CLIENT;?>images/logo.png"/></span>
	  
   </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         <?
				/*$profile_path=GetValue('admin','profile_path','admin_id',''.$_SESSION[$_SESSION['project_name']].'');*/
				$profile_path=$this->common->GetValue("admin","profile_path","id",''.$this->session->userdata('id').'');
				if($profile_path=="")
				{
					$profile_path=base_url()."Assets/dist/img/avatar5.png";
				}
				else
				{
						$profile_path=base_url().$profile_path;
				}
				?>
                 <img  src="<?=$profile_path;?>" class="user-image" alt="User Image">
          <span class="hidden-xs">
          <?=$this->session->userdata('username')?>
          </span> </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            
            <li class="user-header">
          	 <img src="<?=$profile_path;?>" class="img-circle" alt="User Image">
              <p> <?=$this->session->userdata('username')?></p>
            </li>
            <!-- Menu Body -->
            <!--<li class="user-body">
              <div class="col-xs-4 text-center"> <a href="#">Followers</a> </div>
              <div class="col-xs-4 text-center"> <a href="#">Sales</a> </div>
              <div class="col-xs-4 text-center"> <a href="#">Friends</a> </div>
            </li>-->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left"> <a href="<?php echo base_url(); ?>admin/change_profile" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> <a href="<?php echo base_url(); ?>admin/home/logout" class="btn btn-default btn-flat">Sign out</a> </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li> <a href="<?php echo base_url(); ?>admin/site_settings" ><i class="fa fa-gears"></i></a> </li>
      </ul>
    </div>
  </nav>
</header>


<div class="modal fade" id="modelConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body ">
        Are you sure, you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="del_ok">Ok</button>
      </div>
    </div>
  </div>
</div>

<!--bulk delete code start-->
<div class="modal fade" id="bulkmodelConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body ">
        Are you sure, you want to delete All this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="del_all_ok">Ok</button>
      </div>
    </div>
  </div>
</div> 
<!--bulk delete code end-->