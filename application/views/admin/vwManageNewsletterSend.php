<section class="content-header">
  <div class="headertitle">
    <h1>
      Send Newsletter
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
          <div class="FieldsMarked"> Fields Marked with (<span class="required">*</span>) are Mandatory </div>
        </div>
        <div class="box-body">
          <form  class="da-form"  novalidate="novalidate"  action="" name="frm_newsletter"  method="get">
            <div style="height:300px;overflow:auto">
              <? if(!empty($newsletter_subscription))
							{?>
              <table id="da-ex-datatable-numberpaging"  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="10%"  class="TextCenter"> <input type="checkbox" name="chkall" id="chkall" onclick="selectAll()"  <? if(isset($_POST["chkall"])){echo "checked";}?> value="1" />
                    </th>
                    <th width="90%">Email Address</th>
                   
                  </tr>
                </thead>
                <tbody>
                <?
				 $j=1;
							
				foreach($newsletter_subscription as $key)
 				  {
				  ?>
                  <tr class="gradeU">
                    <td class="TextCenter"><input type="checkbox" newsletter_id="<?=$key->news_letter_subscription_id?>" name="user_j<?=($j);?>" value="<?=$key->email?>" onclick="DeselectAll()"  /></td>
                    <td ><?=$key->email?></td>
                    
                  </tr>
                  <?  $j++;
						}
   				  ?>
                </tbody>
              </table>
              	<?
              	}
			  	else
			  	{?>
              		<center>
                		No data available in table
              		</center>
              	<? } ?>
            </div>
          </form>
          <br/>
          <br/>
          <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/newsletter_send/send_mail" name="frmnews" id="da-ex-validate1">
            <div class="box-body">
              <div class="form-group da-form-row">
                <label for="news_latter_id" class="col-sm-3 control-label"><span class="required">*</span>Newsletter Subject</label>
                <div class="col-sm-4">
                  <select required class="form-control"    name="news_latter_id"  id="news_latter_id" data-msg-required="Please select subject.">
                    <option value="">--Select Subject--</option>
                    <?
						  	foreach($newsletter as $val)
							{
								?>
                    <option value="<?=$val->news_latter_id?>">
                    <?=$val->subject?>
                    </option>
                    <?php
							}
						  ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="to" class="col-sm-3 control-label"><span class="required">*</span>Send To</label>
                <div class="col-sm-4">
                  <textarea required name="to" class="form-control" id="to" data-msg-required="Please send to email."></textarea>
                  <input type="hidden" name="hid_subcribtion_id" id="hid_subcribtion_id" >
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" >
              <button type="submit" name="Submit" value="Send" id="Submit" class="btn btn-info pull-right">Send</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/newsletter.js" type="text/javascript"></script>
