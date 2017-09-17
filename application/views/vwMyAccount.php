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
        <div class="text">
        <?php if($this->session->flashdata('msg')){ ?>
                 <center style="color:green;"><?php echo $this->session->flashdata('msg'); ?>  </center>
                  <? }
?>    
                <div > Welcome<strong style="color:#e92c55;"> <?=$this->session->userdata('student_name')?> ! </strong>
          <div class="margin20"></div>
                    
          
        </div>
      </div>
      
      <div class="row ">
        <div class="col-lg-6 col-sm-6 col-xs-12 tile">
          <p style="background-color:#3EC7F3;height:100px;"><a style="color:#FFF;font-size:32px;" href="<?=base_url()?>change_profile"><i class="fa fa-user"></i> View or Change My Information.</a></p>
        </div>
        <div class="col-lg-6 col-sm-6  col-xs-12 tile">
          <p style="background-color:#FCC120;color:#FFF;height:100px;"><a style="color:#FFF;font-size:32px;" href="<?=base_url()?>change_password"><i class="fa fa-user-secret"></i> Change Password</a> </p>
        </div>
        
        
      </div>
      </section>
      </div>
    </div>
  </div>
</section>
