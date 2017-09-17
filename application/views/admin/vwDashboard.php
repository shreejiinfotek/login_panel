<div style="padding-top:10px;">
  <?php if($this->session->flashdata('change_profile'))
{
?>
  <div class="callout callout-success lead">
    <p><?php echo $this->session->flashdata('change_profile'); ?></p>
  </div>
  <?
}
?>
  <?php if($this->session->flashdata('change_password'))
{
?>
  <div class="callout callout-success lead">
    <p><?php echo $this->session->flashdata('change_password'); ?></p>
  </div>
  <?
}
?>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-fuchsia-active">
    <div class="inner">
      <h3>
        <?
			echo $this->common->CountByTable("content","");
			?>
      </h3>
      <p>Pages</p>
    </div>
    <div class="icon"> <i class="fa fa-newspaper-o"></i> </div>
    <a class="small-box-footer" href="<?php echo base_url(); ?>admin/pages">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-teal-active">
    <div class="inner">
      <h3>
        <?php
				  echo $this->common->CountByTable("banner","");
				  ?>
      </h3>
      <p>Banners</p>
    </div>
    <div class="icon"> <i class="fa fa-sliders"></i> </div>
    <a href="<?php echo base_url(); ?>admin/banner" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-olive-active">
    <div class="inner">
      <h3>
        <?php
				  echo $this->common->CountByTable("enquiry","");
				  ?>
      </h3>
      <p>Enquiry</p>
    </div>
    <div class="icon"> <i class="fa fa-book"></i> </div>
    <a href="<?php echo base_url(); ?>admin/enquiry" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-red">
    <div class="inner">
      <h3>
        <?php
		  echo $this->common->CountByTable("press","");
		?>
      </h3>
      <p>Press</p>
    </div>
    <div class="icon"> <i class="fa fa-pie-chart"></i> </div>
    <a href="<?php echo base_url(); ?>admin/press" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-purple-active">
    <div class="inner">
      <h3>
        <?php
				  echo $this->common->CountByTable("news","");
				  ?>
      </h3>
      <p>News</p>
    </div>
    <div class="icon"> <i class="fa fa-calendar"></i> </div>
    <a href="<?php echo base_url(); ?>admin/news" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>
        <?php
				  echo $this->common->CountByTable("event","");
				  ?>
      </h3>
      <p>Events</p>
    </div>
    <div class="icon"> <i class="fa fa-folder-open"></i> </div>
    <a href="<?php echo base_url(); ?>admin/event" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-fuchsia-active">
    <div class="inner">
      <h3>
        <?php
				  echo $this->common->CountByTable("course","");
				  ?>
      </h3>
      <p>Courses</p>
    </div>
    <div class="icon"> <i class="fa fa-graduation-cap"></i> </div>
    <a href="<?php echo base_url(); ?>admin/course" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua-active">
    <div class="inner">
      <h3>
        <?php
				  echo $this->common->CountByTable("blogs","");
				  ?>
      </h3>
      <p>Blogs</p>
    </div>
    <div class="icon"> <i class="fa fa-bold"></i> </div>
    <a href="<?php echo base_url(); ?>admin/blog" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
</div>
<section class="col-lg-12 connectedSortable ui-sortable">

  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right ui-sortable-handle">
      <li class="pull-left header active"><i class="fa fa-graduation-cap"></i> Student Sex Ratio Report</li>
    </ul>
    <div class="tab-content no-padding">
      
      
      <div class="chart tab-pane active">
        <div id="chart_div"></div> 
      </div>
    </div>
  </div>
 
  
</section>

<section class="col-lg-12 connectedSortable ui-sortable">

  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right ui-sortable-handle">
      <li class="pull-left header active"><i class="fa fa-graduation-cap"></i> Student Caste Community  Ratio Report</li>
    </ul>
    <div class="tab-content no-padding">
      
      
      <div class="chart tab-pane active">
        <div id="caste_div"></div> 
      </div>
    </div>
  </div>
 
  
</section>
