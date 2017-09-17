<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle;?>
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
            <? $this->load->view('admin/controls/vwMessage');?>
            <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
<?
if(count($contents)>0)
{
?>
            <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/pages/edit_page/<?=$contents->content_id?>" enctype="multipart/form-data">
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
                    <input type="text" required readonly class="form-control" name="page_name" id="page_name" maxlength="100" value="<? if(isset($_POST['page_name'])){ echo $_POST['page_name']; }else{ echo $contents->page_name; }?>" data-msg-required="Please enter page name.">
                </div>
              </div>
              <div class="form-group">
                <label for="page_title" class="col-sm-3 control-label"><span class="required">*</span>Page Title</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" name="page_title" id="page_title" maxlength="100" value="<? if(isset($_POST['page_title'])){ echo $_POST['page_title']; }else{ echo $contents->page_title;}?>" data-msg-required="Please enter page title." >
                </div>
              </div>
              
                <? if($contents->is_banner==1) { ?>
              <div class="form-group">
                <label for="inner_images" class="col-sm-3 control-label">Background  Image <?=BACKGROUNDIMGSIZE?></label>
                <div class="col-sm-3">
                  <input type="file" class="form-control" name="inner_images"  id="inner_images" data-msg-required="Please upload background image." >
                </div>
              </div>
              <?
			   
			   if($contents->inner_images!="" && $contents->is_banner==1)
			   {
			  ?>
              	<div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                  <img  class="pageBg" src="<?=base_url().$contents->inner_images;?>"> </div>
                </div>
                <?
			   }
				?>
              
              <? } ?>
              
                  <? if($contents->is_page_description==1) { ?>
              <div class="form-group">
                <label for="page_description" class="col-sm-3 control-label">Page Description</label>
                <div class="col-sm-7">
                    <textarea  class="form-control" name="description" id="description" rows="3" ><? if(isset($_POST['description'])){ echo $_POST['description']; }else{ echo $contents->page_description; }?></textarea>
                   <!-- <label for="page_description" id="error_description"  style="display:none;"  class="errorCK">Please enter page description.</label>-->
                </div>
              </div>
              <? } ?>
             <? if($contents->content_id==1) { ?>
             <div class="form-group">
             <label for="page_description" class="col-sm-3 control-label"></label>
             <div class="col-sm-7">
             <a href="<?=base_url();?>admin/pages/edit_page/11">EDIT OUR ONGOING WORKS</a><br />
              <a href="<?=base_url();?>admin/pages/edit_page/16">EDIT SUCCESSFUL
STORIES</a>
             </div>
             </div>
             
             <? } ?> 
              <div class="form-group">
                <label for="meta_title" class="col-sm-3 control-label"><span class="required">*</span>Meta Title</label>
                <div class="col-sm-4">
                    <input type="text" required class="form-control" name="meta_title" id="meta_title" maxlength="100" value="<? if(isset($_POST['meta_title'])){ echo $_POST['meta_title']; }else{ echo $contents->meta_title;}?>" data-msg-required="Please enter meta title.">
                </div>
              </div>
              <div class="form-group">
                <label for="meta_keyword" class="col-sm-3 control-label">Meta Keyword</label>
                <div class="col-sm-4">
                <textarea  class="form-control" name="meta_keyword" id="meta_keyword" maxlength="2000" rows="3"><? if(isset($_POST['meta_keyword'])){ echo $_POST['meta_keyword']; }else{ echo $contents->meta_keyword; }?></textarea>
                    
                </div>
              </div>
              <div class="form-group">
                <label for="meta_description" class="col-sm-3 control-label">Meta Description</label>
                <div class="col-sm-4">
                    <textarea  class="form-control" name="meta_description" id="meta_description" maxlength="4000" rows="3"><? if(isset($_POST['meta_keyword'])){ echo $_POST['meta_keyword']; }else{ echo $contents->meta_description; }?></textarea>
                </div>
              </div>
              <?
				if(SUPER_ADMIN_ENABLE)
				{
				?>
              <div class="form-group">
                  <label for="is_deleted" class="col-sm-3 control-label">Is Background Image</label>
                  <div class="col-sm-4">
                	 <input type="checkbox" name="is_banner" class="checkbox_span" <? if(isset($_POST["is_banner"])){ if(isset($_POST["is_banner"]) == 1){ ?> checked <? };}else{if($contents->is_banner==1) {?> checked <? } }?>   />
                  </div>
                </div>
                <? } ?>
               
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >
               <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>admin/pages">Cancel</a>
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
<div class="error_occured">Error occured open this page</div>
</div>
<?
}
?>
        </div>
      </div>
    </div>
  </section>

   