<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/enquiry">Manage Enquiry</a></div>
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
                      <th width="30%">Email</th>
                      <th width="70%"><?=$enquiry->email;?></th>
                    </tr>
                     <tr>
                      <th width="30%">Name</th>
                      <th width="70%"><?=$enquiry->enquiry_name?></th>
                    </tr>
                     <tr>
                      <th width="30%">Telephone</th>
                      <th width="70%"><?=$enquiry->telephone?></th>
                    </tr>
                   
                     <tr>
                      <th width="30%">Message</th>
                      <th width="70%"><?=$enquiry->message?></th>
                    </tr>
                      <tr>
                      <th width="30%">Received Date</th>
                      <th width="70%"><?=date('d M Y',strtotime($enquiry->created_date))?></th>
                    </tr>
                  </table>
          </div>
        </div>
      </div>
    </div>
  </section>
