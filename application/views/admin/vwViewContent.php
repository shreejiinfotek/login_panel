<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/pages">Manage <?=$page?>s</a></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
          <div id="delete_allmsg_div"></div>
            <? //include "Controls/admin-message.php"; ?>
          </div>
          <div class="box-body">
            <table class="table table-bordered tableformat" width="100%">
                    <tr>
                      <th width="30%">Page Name</th>
                      <th width="70%"><?=$contents->page_name?></th>
                    </tr>
                     <tr>
                      <th width="30%">Page Title</th>
                      <th width="70%"><?=$contents->page_title?></th>
                    </tr>
                    <? if($contents->is_banner==1 && $contents->inner_images!="") { ?>
                     <tr>
                     <th width="30%">Background Image</th>
                    <th width="70%"><img src="<?=base_url().$contents->inner_images;?>" class="pageBg"></th>
                    </tr>
                    <? } ?>
                    <? if($contents->is_page_description==1) { ?>
                     <tr>
                      <th width="30%">Page Description</th>
                      <th width="70%"><?=$contents->page_description;?></th>
                    </tr>
                    <? } ?>
                   
                    
                    <? if($contents->meta_title!=="") { ?>
                     <tr>
                      <th width="30%">Meta Title</th>
                      <th width="70%"><?=$contents->meta_title?></th>
                    </tr>
                    <? } ?>
                    <? if($contents->meta_keyword!=="") { ?>
                     <tr>
                      <th width="30%">Meta Keyword</th>
                      <th width="70%"><?=$contents->meta_keyword?></th>
                    </tr>
                    <? } ?>
                    <? if($contents->meta_description!=="") { ?>
                      <tr>
                      <th width="30%">Meta Description</th>
                      <th width="70%"><?=$contents->meta_description?></th>
                    </tr>
                    <? } ?>
                  </table>
          </div>
        </div>
      </div>
    </div>
  </section>
