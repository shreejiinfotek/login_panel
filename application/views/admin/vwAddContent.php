<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/pages">Manage <?=$page?>s
      
      </a></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            
            <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
            <form  class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/pages/add_page">
            
            
            <div class="box-body">
            
            <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <span class="required"><?php echo validation_errors(); ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="page_name" class="col-sm-3 control-label"><span class="required">*</span>Page Name</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control"  maxlength="100" name="page_name" id="page_name" value="<? if(isset($_POST['page_name'])){ echo $_POST['page_name']; }?>" data-msg-required="Please enter page name.">
                </div>
              </div>
              <div class="form-group">
                <label for="page_title" class="col-sm-3 control-label"><span class="required">*</span>Page Title</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" maxlength="100" name="page_title" id="page_title" value="<? if(isset($_POST['page_title'])){ echo $_POST['page_title']; }?>" data-msg-required="Please enter page title." >
                </div>
              </div>
              <div class="form-group">
                <label for="page_description" class="col-sm-3 control-label">Page Description</label>
                <div class="col-sm-7">
                    <textarea   class="form-control"  name="description" id="description" rows="3" ><? if(isset($_POST['description'])){ echo $_POST['description']; }?></textarea>
                <!--    <label for="page_description" id="error_description"  style="display:none;"  class="errorCK">Please enter page description.</label>-->
                </div>
              </div>
              <div class="form-group">
                <label for="meta_title" class="col-sm-3 control-label"><span class="required">*</span>Meta Title</label>
                <div class="col-sm-4">
                    <input type="text" required  class="form-control" maxlength="100" name="meta_title" id="meta_title" value="<? if(isset($_POST['meta_title'])){ echo $_POST['meta_title']; }?>" data-msg-required="Please enter meta title." >
                </div>
              </div>
              <div class="form-group">
                <label for="meta_keyword" class="col-sm-3 control-label">Meta Keyword</label>
                <div class="col-sm-4">
                 <textarea  class="form-control" name="meta_keyword" id="meta_keyword" maxlength="2000" rows="3"><? if(isset($_POST['meta_keyword'])){ echo $_POST['meta_keyword']; }?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="meta_description" class="col-sm-3 control-label">Meta Description</label>
                <div class="col-sm-4">
                    <textarea  class="form-control" name="meta_description" id="meta_description" maxlength="4000" rows="3"><? if(isset($_POST['meta_description'])){ echo $_POST['meta_description']; }?></textarea>
                </div>
              </div>
              
              <?
				if(SUPER_ADMIN_ENABLE)
				{
				?>
              	<div class="form-group">
                  <label for="is_banner" class="col-sm-3 control-label">Is Background Image</label>
                  <div class="col-sm-4">
                	 <input type="checkbox" name="is_banner" class="checkbox_span"  <? if($this->input->post('is_banner')=="on") {?> checked <? }?>   />
                  </div>
                </div>
                <? } ?>
                <div class="form-group">
              <label for="display_order" class="col-sm-3 control-label">Display Order</label>
              <div class="col-sm-4">
                <input type="text" maxlength="2"  class="form-control" name="display_order" id="display_order" value="<? if(isset($_POST["display_order"])){ echo $_POST["display_order"];}?>" onKeyPress="return numericOnly(this);" >
              </div>
            </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" >
            <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/pages">Cancel</a>
           
                <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>
