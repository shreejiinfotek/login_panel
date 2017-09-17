<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <?
		  	$this->load->view('admin/controls/vwMessage');
		  	?>
            <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/change_profile/update_profile/<?=$admin->id?>" enctype="multipart/form-data">
            <div class="box-body">
				<div class="form-group">
                	<label for="page_name" class="col-sm-3 control-label"></label>
               			<div class="col-sm-4">
                    		<span class="required"><?php echo validation_errors(); ?></span>
               		 </div>
              	</div>
            
              <div class="form-group da-form-row">
                <label class="col-sm-3 control-label"><? if(SUPER_ADMIN_ENABLE) { ?><span class="required">*</span><? }?>Username</label>
                <div class="col-sm-4">
                <? if(!SUPER_ADMIN_ENABLE) { ?>
                <input type="email" readonly class="form-control" name="email" maxlength="100" id="email" value="<? if(isset($_POST["email"])){ echo $_POST["email"];}else{ echo $admin->email;} ?>" >
                <?
				}
				?>
                <? if(SUPER_ADMIN_ENABLE) { ?>
                <input type="email" required class="form-control" name="email" maxlength="100" id="email" value="<? if(isset($_POST["email"])){ echo $_POST["email"];}else{ echo $admin->email;} ?>" >
                <?
				}
				?>
                  
                 </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-3 control-label"><span class="required">*</span>Name</label>
                <div class="col-sm-4">
                  <input type="text" required class="form-control" name="username" maxlength="100" id="username" value="<? if(isset($_POST["username"])){ echo $_POST["username"]; }else{ echo $admin->username; }?>" data-msg-required="Please enter name." >
                </div>
              </div>
               <div class="form-group Image">
                <label for="profile_path" class="col-sm-3 control-label">Profile Picture<!--(100px W * 100px H)--></label>
                <div class="col-sm-4">
                  <input type="file" class="form-control" name="profile_path"  id="profile_path" > </div>
              </div>
              
              <div class="form-group Image">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                <?
				if($admin->profile_path!="")
				{
				?>
                <img class="img-circle profile_image" src="<?="../".$admin->profile_path;?>">
                <?
				}
				?>  </div>
              </div>
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer" >
                         
              <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>