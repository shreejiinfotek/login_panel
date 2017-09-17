<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <?
	
	  ?>
      <li class="treeview <? if($page=="Page"){?> active <? } ?> "> <a href="<? if(!SUPER_ADMIN_ENABLE){ ?><?=base_url()?>admin/pages <? }else{ ?>#<? } ?>"> <i class="fa fa-newspaper-o"></i> <span>Manage Pages</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("content"," ");?></span>
        <? if(SUPER_ADMIN_ENABLE) { ?>
        <i class="fa fa-angle-left pull-right"></i>
        <? } ?>
        </a>
        <? if(SUPER_ADMIN_ENABLE) { ?>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/pages/add_page"><i class="fa fa-circle-o"></i>Add Page</a></li>
          <li ><a href="<?php echo base_url(); ?>admin/pages"><i class="fa fa-circle-o"></i>Manage Pages</a></li>
        </ul>
        <? } ?>
      </li>
      <li class="treeview <? if($page=="Banner"){?> active <? } ?> "> <a href="#"> <i class="fa fa-sliders"></i> <span>Manage Banners</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("banner"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/banner/add_banner"><i class="fa fa-circle-o"></i>Add Banner</a></li>
          <li><a href="<?php echo base_url(); ?>admin/banner"><i class="fa fa-circle-o"></i>Manage Banners</a></li>
        </ul>
      </li>
      <? if($this->session->userdata('id')==1){ ?>
      <li class="treeview <? if($page=="User"){?> active <? } ?> "> <a href="#"> <i class="fa fa-file-image-o"></i> <span>Manage Users</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("admin"," where id!=1  ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
        
          <li><a href="<?php echo base_url(); ?>admin/user"><i class="fa fa-circle-o"></i>Manage Users</a></li>
        </ul>
      </li>  
      <? } ?>
      <li class="treeview <? if($page=="Student"){?> active <? } ?> "> <a href="#"> <i class="fa fa-user"></i> <span>Manage Students</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("student_register","");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
        
          <li><a href="<?php echo base_url(); ?>admin/student"><i class="fa fa-circle-o"></i>Manage Students</a></li>
        </ul>
      </li>   
      <li class="treeview <? if($page=="Attendence"){?> active <? } ?> "> <a href="#"> <i class="fa fa-file-excel-o"></i> <span>Manage Attendence</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable('attendance','');?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/attendence/add_attendence"><i class="fa fa-circle-o"></i>Add Attendence</a></li>
          <li><a href="<?php echo base_url(); ?>admin/attendence"><i class="fa fa-circle-o"></i>Manage Attendences</a></li>
          <li><a href="<?php echo base_url(); ?>admin/attendence/import"><i class="fa fa-circle-o"></i>Import Attendence Sheet</a></li>
        
        </ul>
      </li> 
      <li class="treeview <? if($page=="News"){?> active <? } ?> "> <a href="#"> <i class="fa fa-calendar"></i> <span>Manage News</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("news"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/news/add_news"><i class="fa fa-circle-o"></i>Add News</a></li>
          <li><a href="<?php echo base_url(); ?>admin/news"><i class="fa fa-circle-o"></i>Manage News</a></li>
        </ul>
      </li>
      <li class="treeview <? if($page=="Event"){?> active <? } ?> "> <a href="#"> <i class="fa fa-calendar"></i> <span>Manage Events</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("event"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/event/add_event"><i class="fa fa-circle-o"></i>Add Event</a></li>
          <li><a href="<?php echo base_url(); ?>admin/event"><i class="fa fa-circle-o"></i>Manage Events</a></li>
        </ul>
      </li>
      <li class="treeview <? if($page=="Course"){?> active <? } ?> "> <a href="#"> <i class="fa fa-graduation-cap"></i> <span>Manage Courses</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("course"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/course/add_course"><i class="fa fa-circle-o"></i>Add Course</a></li>
          <li><a href="<?php echo base_url(); ?>admin/course"><i class="fa fa-circle-o"></i>Manage Courses</a></li>
        </ul>
      </li>
      <li class="treeview <? if($page=="Assign Course"){?> active <? } ?> "> <a href="#"> <i class="fa fa-futbol-o"></i> <span>Manage Assign Course</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("assign_course_student"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/assign_course/add_assign_course"><i class="fa fa-circle-o"></i>Add Assign Course</a></li>
          <li><a href="<?php echo base_url(); ?>admin/assign_course"><i class="fa fa-circle-o"></i>Manage Assign Course</a></li>
        </ul>
      </li>
      <li class="treeview <? if($page=="Blog"){?> active <? } ?> "> <a href="#"> <i class="fa fa-bold"></i> <span>Manage Blogs</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("event"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/blog/add_blog"><i class="fa fa-circle-o"></i>Add Blog</a></li>
          <li><a href="<?php echo base_url(); ?>admin/blog"><i class="fa fa-circle-o"></i>Manage Blogs</a></li>
        </ul>
      </li>
      
      <li class="treeview <? if($page=="Press"){?> active <? } ?> "> <a href="#"> <i class="fa fa-image"></i> <span>Press</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable("press"," ");?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/press/add_press"><i class="fa fa-circle-o"></i>Add Press</a></li>
          <li><a href="<?php echo base_url(); ?>admin/press"><i class="fa fa-circle-o"></i>Manage Press</a></li>
        </ul>
      </li>
       <li class="treeview <? if($page=="Newsletter" || $page=="Newsletter Subscription"){?> active <? } ?> "> <a href="#"> <i class="fa fa-send-o"></i> <span>Manage Newsletter</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable('newsletter_subscription','');?></span><i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/newsletter/add_newsletterform"><i class="fa fa-circle-o"></i>Add Newsletter</a></li>
          <li><a href="<?php echo base_url(); ?>admin/newsletter"><i class="fa fa-circle-o"></i>Manage Newsletters</a></li>
          <li><a href="<?php echo base_url(); ?>admin/newsletter_send"><i class="fa fa-circle-o"></i>Send Newsletter</a></li>
           <li><a href="<?php echo base_url(); ?>admin/newsletter_subscription"><i class="fa fa-circle-o"></i>Newsletter Subscription</a></li>
        </ul>
      </li>
     
      
      <li class="treeview <? if($page=="Enquiry"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/enquiry"> <i class="fa fa-envelope"></i> <span>Manage Enquiry</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable('enquiry','');?></span></a></li>
      
      <li class="treeview <? if($page=="MIS Report"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/mis_reports"> <i class="fa fa-gears"></i> <span>MIS Report</span> </a> </li>
       <? if($this->session->userdata('id')==1){ ?>   
      <li class="treeview <? if($page=="Site Settings"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/site_settings"> <i class="fa fa-gears"></i> <span>Site Settings</span> </a> </li>
     <? } ?>
      
      <li class="treeview <? if($page=="Google Analytics"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/google_analytics"> <i class="fa fa-map-marker"></i> <span>Google Analytics</span> </a> </li>
    
    
      <li class="treeview <? if($page=="Profile"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/change_profile"> <i class="fa fa-user-md"></i> <span>Change Profile</span><span class="label label-primary pull-right"></span></a></li>
    
    
      <li class="treeview <? if($page=="Change Password"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/change_password"> <i class="fa fa-lock"></i> <span>Change Password</span><span class="label label-primary pull-right"></span></a></li>
       
       <?php /*?><? if($this->session->userdata('user_type')=="SA"){?>
         
	 <li class="treeview <? if($page=="Code Backup"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/backup"> <i class="fa fa-cube"></i> <span>Code Backups</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable('manage_backup','');?></span></a></li>
      
      <li class="treeview <? if($page=="Database Backup"){?> active <? } ?> "> <a href="<?php echo base_url(); ?>admin/backup_db"> <i class="fa fa-database"></i> <span>Database Backups</span><span class="label label-primary pull-right"><? echo $this->common->CountByTable('manage_backup_db','');?></span></a></li>
       
	   <? } ?><?php */?>
    </ul>
    </section>
    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
