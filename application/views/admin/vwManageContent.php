<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><? if(SUPER_ADMIN_ENABLE){?><a class="btn btn-info" href="<?php echo base_url(); ?>admin/pages/add_page">Add <?=$page?>
      </a><? } ?></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
          <?
		  $this->load->view('admin/controls/vwMessage');
		  
		  ?>
          <div id="delete_allmsg_div"></div>
            
          </div>
          <div class="box-body">
         
            <table id="gridTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                <?
				if(SUPER_ADMIN_ENABLE)
				{
				?>
               <th width="10%"> <input type="checkbox" id="bulkDelete" onClick="check_del_all()" /> <div class="button_disable" id="deleteTriger" >Delete</div></th><? }?>
                  <th  width="30%">Page Name</th>
                  <th  width="40%">Page Title</th>
                  <?
				  if(SUPER_ADMIN_ENABLE)
				  {
				  ?>
                  <th class="TextCenter" width="10%">Is Active</th>
                  <?
				  }
				  ?>
                  <th class="TextCenter" width="10%" data-orderable="false">View</th>
                  <th class="TextCenter" width="10%" data-orderable="false">Edit</th>
                                  <?
				if(SUPER_ADMIN_ENABLE)
				{
				?>
                  <th class="TextCenter" width="8%" data-orderable="false">Delete</th>
                  <? } ?>
                </tr>
              </thead>
            </table>
            
          </div>
        </div>
      </div>
    </div>
</section>