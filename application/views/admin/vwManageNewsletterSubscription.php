<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"></div>
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
                  <th width="10%"> <input type="checkbox" id="bulkDelete" onClick="check_del_all()" /> <button class="button_disable" id="deleteTriger" data-toggle='modal' data-target='#bulkmodelConfirm' >Delete</button></th>
                  <th  width="55%">Email</th>
                  <th class="TextCenter" width="15%">Subscription Date</th>
                  <th class="TextCenter" width="10%">Is Active</th>
                  <th class="TextCenter" data-orderable="false" width="10%">Delete</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>