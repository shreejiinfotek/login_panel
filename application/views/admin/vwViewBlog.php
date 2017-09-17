<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/blog">Manage Blog</a></div>
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
                      <th width="30%">Blog Title</th>
                      <th width="70%"><?=$blog->blog_name?></th>
                    </tr>
                    <? if($blog->blog_image !=''){ ?>
                    <tr>
                      <th width="30%">Blog Image</th>
                     <th width="70%"><img src="<?=base_url().$blog->blog_image;?>" class="image-admin-display"></th>
                    </tr>
                    <? } ?>
                     <tr>
                      <th width="30%">Short Description</th>
                      <th width="70%"><?=$blog->short_description;?></th>
                    </tr>
                     <tr>
                      <th width="30%">Description</th>
                      <th width="70%"><?=$blog->description?></th>
                    </tr>
                     <tr>
                      <th width="30%">Blog Date</th>
                      <th width="70%"><?=date('d M Y',strtotime($blog->created_date))?></th>
                    </tr>
                    
                  </table>
          </div>
        </div>
      </div>
    </div>
  </section>
