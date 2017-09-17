<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/user">Manage <?=$page?>s
      
      </a></div>
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
<form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/user/add_user" enctype="multipart/form-data">
            <div class="box-body">
            	<div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-3 control-label"><span class="required">*</span>Email</label>
                <div class="col-sm-4">
                  <input type="text" required class="form-control" name="email" maxlength="200" id="email" value="<? if(isset($_POST["email"])){ echo $_POST["email"]; }?>"  data-msg-required="Please enter email." >
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label"><span class="required">*</span>Full Name</label>
                <div class="col-sm-4">
                  <input type="text"   required class="form-control" name="username" maxlength="200" id="username" value="<? if(isset($_POST["username"])){ echo $_POST["username"]; }?>" data-msg-required="Please enter full name." >
                </div>
              </div>             
                         
           	  
              <div class="form-group">
                <label for="phone_number" class="col-sm-3 control-label"><span class="required">*</span>Contact Number</label>
                <div class="col-sm-4">
                  <input type="text"  required class="form-control" name="phone_number" maxlength="15" id="phone_number" value="<? if(isset($_POST["phone_number"])){ echo $_POST["phone_number"]; }?>" data-msg-required="Please enter contact number." >
                </div>
              </div>
              <div class="form-group">
              <label for="address" class="col-sm-3 control-label"><span class="required">*</span>Address</label>
              <div class="col-sm-4">
                <textarea  required class="form-control"  name="address" maxlength="1500" id="address" data-msg-required="Please enter address." ><? if(isset($_POST['address'])){ echo $_POST['address'];}?>
</textarea>
              </div>
            </div>
            
            <div class="form-group">
              <label for="profile_path" class="col-sm-3 control-label"><span class="required">*</span>Profile Picture</label>
              <div class="col-sm-4">
                <input type="file" required class="form-control" name="profile_path"  id="profile_path" data-msg-required="Please upload profile picture." >
              </div>
            </div>
            
            
			</div>
            <!-- /.box-body -->
            <div class="box-footer" >
              <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/user">Cancel</a>
           
              <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>

   