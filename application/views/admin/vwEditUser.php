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
<?
if(count($user)>0)
{
?>
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/user/edit_user/<?=$user->id?>" enctype="multipart/form-data">
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
                  <input type="text" readonly class="form-control" name="email" maxlength="50" id="email" value="<? if(isset($_POST["email"])){ echo $_POST["email"]; }else{echo $user->email;}?>"  >
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label"><span class="required">*</span>Full Name</label>
                <div class="col-sm-4">
                  <input type="text"   required class="form-control" name="username" maxlength="50" id="username" value="<? if(isset($_POST["username"])){ echo $_POST["username"]; }else{echo $user->username;}?>" data-msg-required="Please enter full name." >
                </div>
              </div>             
                         
           	  
              <div class="form-group">
                <label for="phone_number" class="col-sm-3 control-label"><span class="required">*</span>Contact Number</label>
                <div class="col-sm-4">
                  <input type="text"  required class="form-control" name="phone_number" maxlength="15" id="phone_number" value="<? if(isset($_POST["phone_number"])){ echo $_POST["phone_number"]; }else{echo $user->phone_number;}?>" data-msg-required="Please enter contact number." >
                </div>
              </div>
              <div class="form-group">
              <label for="address" class="col-sm-3 control-label"><span class="required">*</span>Address</label>
              <div class="col-sm-4">
                <textarea  required class="form-control"  name="address" maxlength="1500" id="address" data-msg-required="Please enter address." ><? if(isset($_POST['address'])){ echo $_POST['address']; }else{ if($user->address!=""){ echo $user->address;} }?>
</textarea>
              </div>
            </div>
            
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label"><span class="required">*</span>Password</label>
                <div class="col-sm-4">
                  <input type="password"   required class="form-control" name="password" maxlength="50" id="password" value="<? if(isset($_POST["password"])){ echo $_POST["password"]; }?>" data-msg-required="Please enter password." >
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
          <?
}
else
{
?>
<div class="box-body">
<div style="text-align:center; font-size:24px;">Error occured open this page</div>
</div>
<?
}
		  ?>
        </div>
      </div>
    </div>
  </section>

   