<section class="content-header">
  <div class="headertitle">
    <h1>
      <?=$pagetitle?>
    </h1>
  </div>
  <div class="headerbutton"> <a class="btn btn-info" onClick="return db_backup();">
    <?=$page;?>
    </a></div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <? $this->load->view('admin/controls/vwMessage'); ?>
          <div id="delete_allmsg_div"></div>
        </div>
        <div class="box-body">
          <table id="gridTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10%"><input type="checkbox" id="bulkDelete" onClick="check_del_all()" />
                  <button class="button_disable" id="deleteTriger" data-toggle='modal' data-target='#bulkmodelConfirm'>Delete</button></th>
                <th width="50%">File Name</th>
                <th width="20%" class="TextCenter">Download</th>
                <th width="10%">Backup Date</th>
                <th class="TextCenter" width="10%">Delete</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
function db_backup()
{
	StartLoading()
	$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/backup_db/backup_database",
			success: function(result) {
				if(result!="")
				{
					var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been created successfully.</p></div>';
					$('#delete_allmsg_div').html(dhtml);
					dataTable.fnDraw(); // redrawing datatable
					StopLoading();
				}
					},
					//async:false
					error: function() {
						StopLoading();
					},
				});
}
</script>
