<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
      </h1>
    </div>
    <div class="headerbutton"><!--<a class="btn btn-info" href="<?//php echo base_url(); ?>admin/location/">Manage <?//=$page?>s
      
      </a>--></div>
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
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/site_settings/index" enctype="multipart/form-data">
            <div class="box-body">
            
              <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
            
              <div class="form-group">
                <label for="site_project_name" required class="col-sm-3 control-label"><span class="required">*</span>Web Site Name</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" maxlength="100" name="site_project_name" id="site_project_name" value="<? if(isset($_POST["site_project_name"])){ echo $_POST["site_project_name"]; }else{ if(!empty($site_settings->site_project_name)){ echo $site_settings->site_project_name;} }?>" data-msg-required="Please enter project name.">
                </div>
              </div>
              
              <div class="form-group">
                <label for="site_url" class="col-sm-3 control-label"><span class="required">*</span>Website Url</label>
                <div class="col-sm-4">
                    <input type="url" required class="form-control" maxlength="100" name="site_url" id="site_url" value="<? if(isset($_POST["site_url"])){ echo $_POST["site_url"]; }else{ if(!empty($site_settings->site_url)){ echo $site_settings->site_url;} }?>" data-msg-required="Please enter project url.">
                </div>
              </div>
              
          <div class="form-group">
                <label for="site_email" class="col-sm-3 control-label"><span class="required">*</span>Email</label>
                <div class="col-sm-4">
                    <input type="email" required class="form-control" maxlength="100" name="site_email" id="site_email" value="<? if(isset($_POST["site_email"])){ echo $_POST["site_email"]; }else{ if(!empty($site_settings->site_email)){ echo $site_settings->site_email;} }?>" data-msg-required="Please enter email.">
                </div>
              </div>
            <div class="form-group">
                <label for="site_phone_number" class="col-sm-3 control-label"><span class="required">*</span>Phone Number</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" maxlength="50" name="site_phone_number" id="site_phone_number" value="<? if(isset($_POST["site_phone_number"])){ echo $_POST["site_phone_number"]; }else{ if(!empty($site_settings->site_phone_number)){ echo $site_settings->site_phone_number;} }?>" data-msg-required="Please enter phone number.">
                </div>
              </div>
           <div class="form-group">
                <label for="fax_number" class="col-sm-3 control-label"><span class="required">*</span>Fax Number</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" maxlength="20" name="fax_number" id="fax_number" value="<? if(isset($_POST["fax_number"])){ echo $_POST["fax_number"]; }else{ if(!empty($site_settings->fax_number)){ echo $site_settings->fax_number;} }?>" data-msg-required="Please enter fax number.">
                </div>
              </div>   
            
            
             
              
              
                     
              
              <div class="form-group">
                <label for="site_office_address" class="col-sm-3 control-label"><span class="required">*</span>Office Address</label>
                <div class="col-sm-4">
                    <textarea class="form-control" required name="site_office_address" id="site_office_address" rows="4" data-msg-required="Please enter office address."><? if(isset($_POST["site_office_address"])){ echo $_POST["site_office_address"]; }else{ if(!empty($site_settings->site_office_address)){ echo $site_settings->site_office_address;} }?></textarea>
                </div>
              </div>
              
               
             
              <div class="form-group">
                <label for="admin_mailing_address" class="col-sm-3 control-label"><span class="required">*</span>Admin Mailing Address</label>
                <div class="col-sm-4">
                    <input type="email" required class="form-control" maxlength="100" name="admin_mailing_address" id="admin_mailing_address" value="<? if(isset($_POST["admin_mailing_address"])){ echo $_POST["admin_mailing_address"]; }else{ if(!empty($site_settings->admin_mailing_address)){ echo $site_settings->admin_mailing_address;} }?>" data-msg-required="Please enter admin mailing address.">
                </div>
              </div>
               
              
              <div class="form-group">
                <label for="site_copy_right" class="col-sm-3 control-label"><span class="required">*</span>Copy Right</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" maxlength="100" name="site_copy_right" id="site_copy_right" value="<? if(isset($_POST["site_copy_right"])){ echo $_POST["site_copy_right"]; }else{ if(!empty($site_settings->site_copy_right)){ echo $site_settings->site_copy_right;} }?>" data-msg-required="Please enter copy right.">
                </div>
              </div>
              
              <div class="form-group">
                <label for="meta_title" class="col-sm-3 control-label"><span class="required">*</span>Meta Title</label>
                <div class="col-sm-4">
                    <textarea class="form-control" required name="meta_title" id="meta_title" rows="2" data-msg-required="Please enter meta title."><? if(isset($_POST["meta_title"])){ echo $_POST["meta_title"]; }else{ if(!empty($site_settings->meta_title)){ echo $site_settings->meta_title;} }?></textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label for="sitemeta_keyword_email" class="col-sm-3 control-label"><span class="required">*</span>Meta Keyword</label>
                <div class="col-sm-4">
                    <textarea class="form-control" required name="meta_keyword" id="sitemeta_keyword_email" rows="2" data-msg-required="Please enter meta keyword."><? if(isset($_POST["meta_keyword"])){ echo $_POST["meta_keyword"]; }else{ if(!empty($site_settings->meta_keyword)){ echo $site_settings->meta_keyword;} }?></textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label for="meta_description" class="col-sm-3 control-label"><span class="required">*</span>Meta Description</label>
                <div class="col-sm-4">
                    <textarea class="form-control" required name="meta_description" id="meta_description" rows="2" data-msg-required="Please enter meta description."><? if(isset($_POST["meta_description"])){ echo $_POST["meta_description"]; }else{ if(!empty($site_settings->meta_description)){ echo $site_settings->meta_description;} }?></textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label for="default_page_size" class="col-sm-3 control-label"><span class="required">*</span>Default Page Size</label>
                <div class="col-sm-1">
                    <input type="number" required class="form-control" maxlength="3" name="default_page_size" id="default_page_size" value="<? if(isset($_POST["default_page_size"])){ echo $_POST["default_page_size"]; }else{ if(!empty($site_settings->default_page_size)){ echo $site_settings->default_page_size;} }?>" data-msg-required="Please enter default page size.">
                </div>
              </div>
              
              
              <br />
              
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer" >
				<a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/dashboard">Cancel</a>
                <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>

<script> 
function RemoveLogoImages(site_settings_id)
{
 var dataString = 'site_settings_id='+site_settings_id;
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/site_settings/delete_website_logo",
			data: dataString,
			cache: false,
			success: function(html)
			{
				if(html=="delete"){
				window.location.reload();
				}
			},
			error: function() {
				
			},
		});
 
 }
</script>