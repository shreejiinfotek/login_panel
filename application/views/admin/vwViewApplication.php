<section class="content-header">
    <div class="headertitle">
      <h1>
        <?=$pagetitle?> | View <?=$page?>
      </h1>
    </div>
    <div class="headerbutton"><a class="btn btn-info" href="<?php echo base_url(); ?>admin/application_form"><?=$pagetitle?></a></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-body">
            <table class="table table-bordered tableformat" width="100%">
                <h3 class="grey">Section 1 - Applicant Details</h3>
                 <tr>
                  <th width="30%">Full Name</th>
                  <th width="70%"><?=$application_form->full_name?></th>
                </tr>
                 <tr>
                  <th width="30%">Employee Email</th>
                  <th width="70%"><?=$application_form->employee_email?></th>
                </tr>
                 <tr>
                  <th width="30%">Tr Employee Id</th>
                  <th width="70%"><?=$application_form->tr_employee_id;?></th>
                </tr>
            </table>
                    
			<?
            $x_external_qualification_list=$external_qualification_list;
            if(count($x_external_qualification_list)>0)
            {
            ?>
             <h3 class="grey">Section 2 - Qualification</h3>
             <table class="table table-bordered tableformat qualification-tbl" width="100%">
                <tbody>
                    <tr>
                        <th width="25%">Certification(s)</th>
                        <th width="25%">Level</th>
                        <th width="25%">Result</th>
                        <th width="25%">Date of Completion</th>
                    </tr>
                    <? foreach($x_external_qualification_list as $x_external_qualification_list_val){?>
                    <tr class="PD25">
                        <td><?=$x_external_qualification_list_val["certification"];?></td>
                        <td><?=$x_external_qualification_list_val["level"];?></td>
                        <td><?=$x_external_qualification_list_val["result"];?></td>
                        <td><?=date('d M Y',strtotime($x_external_qualification_list_val["date_of_completion"]));?></td>
                    </tr>
                    <? }?>
                </tbody>
             </table>
            <? }?>
           
            <? if($application_form->motivation_description !=''){ ?>
            <table class="table table-bordered tableformat" width="100%">
            <h3 class="grey">Section 3 - Letter of Motivation</h3>
                 <tr>
                  <td width="100%"><?=$application_form->motivation_description?></td>
                </tr>
           </table>
           <? } ?>
           
                  
          </div>
        </div>
      </div>
    </div>
  </section>
