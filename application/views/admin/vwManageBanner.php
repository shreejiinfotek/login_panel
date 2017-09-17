<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/banner/add_banner">Add
    <?=$page?>
    </a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <?  $this->load->view('admin/controls/vwMessage'); ?>
          <div id="delete_allmsg_div"></div>
        </div>
        <div class="box-body">
          <? if(DISPLAY_ORDER)  {  ?>
          <form method="post" action="<?php echo base_url(); ?>admin/update_display_order/index" name="frmteamorder">
            <?  }  ?>
            <table id="gridTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="10%"><input type="checkbox" id="bulkDelete" onClick="check_del_all()" />
                    <div class="button_disable" id="deleteTriger" >Delete</div></th>
                  <th width="45%" class="TextCenter">Banner</th>
                  <? if(DISPLAY_ORDER)
 					{ ?>
                  <th class="TextCenter" width="15%">Display Order</th>
                  <? } ?>
                  <th class="TextCenter" width="10%">Is Active</th>
                  <th class="TextCenter" width="10%" data-orderable="false">Edit</th>
                  <th class="TextCenter" width="10%" data-orderable="false">Delete</th>
                </tr>
              </thead>
            </table>
            <? if(DISPLAY_ORDER)
		  		{
			  ?>
            <div class="box-footer" >
              <button type="submit" name="Submit" value="Update Order" id="Submit" class="btn btn-info pull-right">Update Order</button>
            </div>
          </form>
          <? } ?>
        </div>
      </div>
    </div>
  </div>
</section>
