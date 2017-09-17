<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/news">Manage News</a></div>
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
                      <th width="30%">News Title</th>
                      <th width="70%"><?=$news->news_name?></th>
                    </tr>
                    <? if($news->news_image !=''){ ?>
                    <tr>
                      <th width="30%">News Image</th>
                     <th width="70%"><img src="<?=base_url().$news->news_image;?>" class="image-admin-display"></th>
                    </tr>
                    <? } ?>
                     <tr>
                      <th width="30%">Short Description</th>
                      <th width="70%"><?=$news->short_description;?></th>
                    </tr>
                     <tr>
                      <th width="30%">Description</th>
                      <th width="70%"><?=$news->description?></th>
                    </tr>
                     <tr>
                      <th width="30%">News Date</th>
                      <th width="70%"><?=date('d M Y',strtotime($news->created_date))?></th>
                    </tr>
                    
                  </table>
          </div>
        </div>
      </div>
    </div>
  </section>
