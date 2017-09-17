<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/assign_course/add_assign_course">Add <?=$page?>
      
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
                   <th width="15%"> <input type="checkbox" id="bulkDelete" onClick="check_del_all()" /> <div class="button_disable" id="deleteTriger" >Delete</div></th>
                  	<th width="20%">Course Name</th>
                    <th width="20%">Student Name</th>
                    <th class="TextCenter" width="15%">Assign Date</th>
                    <th class="TextCenter" width="15%" data-orderable="false">Edit</th>
                    <th class="TextCenter" width="15%" data-orderable="false">Delete</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <script>
function viewAllTeam(id)
{
	$.ajax({
			type: "POST",
			url: "<?=base_url()?>admin/assign_group/view_teams",
			data: {id:id},
			success: function(result) {
				$("#display_view").empty();
				$("#display_view").append(result);
				
			},
			async:false
	   });
}
</script>
  <div class="modal fade" id="teams_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modalTeamTop modal-width" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Teams</h4>
      </div>
      <div class="modal-body ">
        <div id="display_view"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 