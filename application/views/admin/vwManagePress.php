<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/press/add_press">Add <?=$page?>
      
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
            <div id="delete_allmsg_div"></div>
           
          </div>
          <div class="box-body">
            <table id="gridTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="10%"> <input type="checkbox" id="bulkDelete" onClick="check_del_all()" /> <div class="button_disable" id="deleteTriger" >Delete</button></th>
                  <th width="20%">Caption</th>
                  <th class="TextCenter" width="40%">PDF</th>
                  <th class="TextCenter" data-orderable="false" width="10%">Is Active</th>
                  <th class="TextCenter" data-orderable="false" width="10%">Edit</th>
                  <th class="TextCenter" data-orderable="false" width="10%">Delete</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>