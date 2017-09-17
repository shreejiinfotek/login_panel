<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/attendence/add_attendence">Add
    <?=$page?>
    </a>
    <a class="btn btn-info" href="<?php echo base_url(); ?>admin/attendence/import">Import
    <?=$page?>
    </a>
    <a class="btn btn-info" href="<?php echo base_url(); ?>admin/attendence/export">Export
    <?=$page?>
    </a>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <?  $this->load->view('admin/controls/vwMessage');  ?>
          <div id="delete_allmsg_div"></div>
        </div>
        <div class="box-body">
          
            <table id="gridTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="10%"><input type="checkbox" id="bulkDelete" onClick="check_del_all()" />
                  <div class="button_disable" id="deleteTriger" >Delete</div></th>
                  <th width="20%">Student Name</th>
                  <th width="15%">Date</th>
                  <th width="15%">Checkin Time</th>
                  <th width="15%">Checkout Time</th>
                  <th class="TextCenter" width="9%">Is Verified</th>
                  <th class="TextCenter" width="8%" data-orderable="false">Edit</th>
                  <th class="TextCenter" width="8%" data-orderable="false">Delete</th>
                </tr>
              </thead>
            </table>
                     
        </div>
      </div>
    </div>
  </div>
</section>
