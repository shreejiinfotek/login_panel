<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/additional-methods.min.js"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/common.js" type="text/javascript"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/app.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/colpick.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/bootstrap-datetimepicker.js" type="text/javascript"></script>




    

<?
if($gridTable)
{
?>
<script language="javascript">
  
$(document).ready(function() {

var bulkdelete_exist = $('#bulkDelete').val(); // = "Index"
if(bulkdelete_exist=="on")
{
	var column_sort=false;
}
else
{
	var column_sort=true;
}
	dataTable = $('#gridTable').dataTable( {
		<?  if (empty($soringCol)) { 
		$soringCol='';
	} ?>
	<?  if (empty($manage_view_path)) { 
		$manage_view_path='';
	} ?>
		<?=$soringCol;?>
		
		"processing": true,
		"serverSide": true,
		"pageLength": <?=$this->data['admin_site_settings']->default_page_size;?>,
		"ajax": {
            "url": "<?=$manage_view_path?>",
            "data": function ( d ) {
				d.course_name =$('#course_name').val();
				d.cast_name =$('#cast_name').val();
				d.gender =$('#gender').val();
				d.age_from =$('#age_from').val();
				d.age_to =$('#age_to').val();
              }},
		 "columnDefs": [
            {
                "render": function ( data, type, row ) {
                   
                },
                
            }],
		"aoColumnDefs": [{ "bSortable": column_sort, "aTargets": [0]}] ,
		"aLengthMenu": [[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]],
		"dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'excel',
                    'csv'
                ]
            }
        ],
		"language": {
					"processing": "<div></div><div></div><div></div><div></div><div></div>"
				},
		"initComplete": function( settings, json ) {
		if(json.data.length==0)
		{
			$("#Submit").hide();
		}
  		}
	} );
	
} );




function deleteFunction(id)
 {
	 delete_id="";
	 jQuery.ajax({
	 		url:"<?php echo site_url('admin/home/check_session/')?>",
			type: "POST",
			success:function(result){
			if(result==1)
			{
				$('#modelConfirm').modal('show');

					 delete_id="";
					 delete_id=id
				 <?  if (empty($path)) { 
						$path='';
					} ?> 
					$(document).ready(function() {
						var page_name='<?=$page?>';
						$("#del_ok").click(function(){
							$(function() {
									$('#modelConfirm').modal('hide');
								});
								$.ajax({
							url:"<?=$path?>"+delete_id,
							success:function(data)
							{
								if(data=='delete')
								{
									 $(function() {
												$('#modelConfirm').modal('hide');
											});
											 $(".callout-success").hide();
											$(".callout-danger").hide();
											
											var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been deleted successfully.</p></div>';																				
										
									
											$('#delete_allmsg_div').html(dhtml);
											$("#gridTable").dataTable().fnDraw();
										
								}
								if(data=='ref_id')
								{
									$(function() {
												$('#modelConfirm').modal('hide');
											});
											 $(".callout-success").hide();
											$(".callout-danger").hide();
											var dhtml = '<div class="callout callout-danger lead"><p>Sorry, You can\'t delete this <?=$page?> due to associated with other module.</p></div>';
											$('#delete_allmsg_div').html(dhtml);
								}
								
							}
							   
							});
					
						}); 
					});
					
			}
			else
			{
				window.location.href = "<?php echo site_url('admin/home/')?>";
			}
			
			
			},
	});
	return false;
 }
 var ids_string="";
 var ids_value_array="";
$(document).ready(function() {
	<?  if (empty($bulk_path)) { 
		$bulk_path='';
	} ?>   
	   
		$("#bulkDelete").on('click',function() { // bulk checked
			var status = this.checked;
			$(".deleteRow").each( function() {
				$(this).prop("checked",status);
			});
		});
		 
		$('#deleteTriger').on("click", function(event)
		{ 
			
			var page_name='<?=$page?>';
			jQuery.ajax({
	 		url:"<?php echo site_url('admin/home/check_session/')?>",
			type: "POST",
			success:function(result){
			if(result==1)
			{
				disabled_class =$('#deleteTriger').hasClass('button_disable');
				if(disabled_class==false)
				{
				
				$('#bulkmodelConfirm').modal('show');
				}
				ids_string="";
				ids_value_array="";
				if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
					var ids = [];
					$('.deleteRow').each(function(){
						if($(this).is(':checked')) { 
							ids.push($(this).val());
							
						}
					});
					ids_string = ids.toString();  // array to string conversion 
					
					$("#del_all_ok").click(function(){
	
						$.ajax({
							type: "POST",
							 url:"<?=$bulk_path?>",
							data: {data_ids:ids_string},
							success: function(result) {
								ids_value_array = ids_string.split(",");
								if(result == 'delete'){
									$(function() {
										$('#bulkmodelConfirm').modal('hide');
									});
									$(".callout-success").hide();
									$(".callout-danger").hide();
									if((ids_value_array.length)==1)
									{	
										var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been deleted successfully.</p></div>';
										
									}
									else
									{
										if(page_name=="Cover News")
										{
											var dhtml = '<div class="callout callout-success lead"><p><?=$page?> have been deleted successfully.</p></div>';
										}
										else
										{
											var dhtml = '<div class="callout callout-success lead"><p><?=$page?>s have been deleted successfully.</p></div>';
										}
									}
									$('#delete_allmsg_div').html(dhtml);
									$('.deleteRow').attr('checked', false);
									$('#bulkDelete').attr('checked', false);
									
									$('#deleteTriger').attr("disabled", true);
									$('#deleteTriger').removeClass( "button" );
									$('#deleteTriger').addClass( "button_disable");
								$("#gridTable").dataTable().fnDraw(); // redrawing datatable
								}
								if(result == 'ref_id'){
									$(function() {
										$('#bulkmodelConfirm').modal('hide');
									});
									$(".callout-success").hide();
									$(".callout-danger").hide();
									if((ids_value_array.length)==1)
									{	
										var dhtml = '<div class="callout callout-danger lead"> Sorry, Some <?=$page?> Can\'t deleted due to reference to other module. </div>';
										
									}
									else
									{
										
										if(page_name=="Category")
										{
											var dhtml = '<div class="callout callout-danger lead"> Sorry, Some Catalogue Categories Can\'t deleted due to reference to other module. </div>';
										}
										else if(page_name=="Sub Category")
										{
											var dhtml = '<div class="callout callout-danger lead"> Sorry, Some Catalogue Sub Categories Can\'t deleted due to reference to other module. </div>';
										}
										else
										{
											var dhtml = '<div class="callout callout-danger lead"> Sorry, Some <?=$page?>s Can\'t deleted due to reference to other module. </div>';
										}
									}
									
									$('#delete_allmsg_div').html(dhtml);
									$('.deleteRow').attr('checked', false);
									$('#bulkDelete').attr('checked', false);
									$('#deleteTriger').attr("disabled", true);
									$('#deleteTriger').removeClass( "button" );
									$('#deleteTriger').addClass( "button_disable");
								$("#gridTable").dataTable().fnDraw(); // redrawing datatable
								}
							},
							async:false
						});
					});
				}
			
			}
			else
			{
				window.location.href = "<?php echo site_url('admin/home/')?>";
			}
			
			},
	});
		
		// triggering delete one by one

		
			/*if(!confirm('Are you sure, you want to delete all this record?'))
			{
				return false;
			}*/
			
		}); 
		return false;
		
		$('#deleteTriger').attr("disabled", true);
		$('#deleteTriger').removeClass( "button" );
		$('#deleteTriger').addClass( "button_disable");
		$("#deleteTriger").attr("data-target", "");
		
		/*code for keypress in search area disable delete all button Start*/
		$( ".col-sm-6" ).keypress(function() {
												   
			$('#deleteTriger').attr("disabled", true);
			$('#bulkDelete').attr('checked', false);
			$('#deleteTriger').removeClass( "button" );
			$('#deleteTriger').addClass( "button_disable");
			$("#deleteTriger").attr("data-target", "");
		});
		/*code for keypress in search area disable delete all button End*/
	} );

function check_del_button()
{
	
	if($('.deleteRow:checked').length == $('.deleteRow').length)
	{
		$("#bulkDelete").prop('checked',true);
	}
	else
	{
		$("#bulkDelete").prop('checked',false);
	}
	
	if( $('.deleteRow:checked').length > 0 )
	{
			$('#deleteTriger').removeAttr("disabled");
			$('#deleteTriger').removeClass( "button_disable" );
			$('#deleteTriger').addClass( "button" );
			$("#deleteTriger").attr("data-target", "#bulkmodelConfirm");
	}
	else
	{
		$('#deleteTriger').attr("disabled", true);
		$('#deleteTriger').removeClass( "button" );
		$('#deleteTriger').addClass( "button_disable" );
		$('#bulkDelete').attr('checked', false);
		$("#deleteTriger").attr("data-target", "");
	}
}
function check_del_all()
{
	
	if($("#bulkDelete").is(':checked'))
	{
		
		$('#deleteTriger').removeAttr("disabled");
		$('#deleteTriger').removeClass( "button_disable" );
		$('#deleteTriger').addClass( "button" );
		$("#deleteTriger").attr("data-target", "#bulkmodelConfirm");
	}
	else
	{
		$('#deleteTriger').attr("disabled", true);
		$('#deleteTriger').removeClass( "button" );
		$('#deleteTriger').addClass( "button_disable" );
		$("#deleteTriger").attr("data-target", "");
	}
	var numOfVisibleRows = $('td:visible').length;

	if(numOfVisibleRows==1)
	{
		$('#deleteTriger').attr("disabled", true);
		$('#deleteTriger').removeClass( "button" );
		$('#deleteTriger').addClass( "button_disable" );
		$('#bulkDelete').attr('checked', false);
		$("#deleteTriger").attr("data-target", "");
	}



}
function update_is_active(val,id)
{
	StartLoading();
	jQuery.ajax({
	 		url:"<?php echo site_url('admin/home/check_session/')?>",
			type: "POST",
			success:function(result){
			if(result==1)
			{
				<?  if (empty($is_active_path)) { 
					$is_active_path='';
				} ?>
				var page_name='<?=$page?>';
				jQuery.ajax({
						url:"<?=$is_active_path?>"+val+"/"+id,
						type: "GET",
						success:function(result){
						$('#display_isactive'+id+'').html(result);
						$(".callout-success").hide();
						$(".callout-danger").hide();
						if(val==1)
						{
							if(page_name=="Category")
							{
								var dhtml = '<div class="callout callout-success lead"><p>Catalogue <?=$page?> has been activated successfully.</p></div>';
							}
							else
							{
								var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been activated successfully.</p></div>';
							}
							
							$('#delete_allmsg_div').html(dhtml);
						}
						else
						{
							if(page_name=="Category")
							{
								var dhtml = '<div class="callout callout-success lead"><p>Catalogue <?=$page?> has been deactivated successfully.</p></div>';
							}
							else
							{
								var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been deactivated successfully.</p></div>';
							}
							
							$('#delete_allmsg_div').html(dhtml);
						}
						StopLoading();
						},
				});
			}
			else
			{
				window.location.href = "<?php echo site_url('admin/home/')?>";
				StopLoading();
			}
			
			
			},
	});
	

}
//is varified attendence
function update_is_verified(val,id)
{
	StartLoading();
	jQuery.ajax({
	 		url:"<?php echo site_url('admin/home/check_session/')?>",
			type: "POST",
			success:function(result){
			if(result==1)
			{
				<?  if (empty($is_verified_path)) { 
					$is_verified_path='';
				} ?>
				var page_name='<?=$page?>';
				jQuery.ajax({
						url:"<?=$is_verified_path?>"+val+"/"+id,
						type: "GET",
						success:function(result){
						$('#display_isactive'+id+'').html(result);
						$(".callout-success").hide();
						$(".callout-danger").hide();
						if(val==1)
						{
							
							var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been verified successfully.</p></div>';
							
							
							$('#delete_allmsg_div').html(dhtml);
						}
						else
						{
							
								var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been unverified successfully.</p></div>';
							
							
							$('#delete_allmsg_div').html(dhtml);
						}
						StopLoading();
						},
				});
			}
			else
			{
				window.location.href = "<?php echo site_url('admin/home/')?>";
				StopLoading();
			}
			
			
			},
	});
	

}
//is default use
function update_is_approve(val,id)
{
	
				<?  if (empty($is_approve_path)) { 
					$is_approve_path='';
				} ?>
				jQuery.ajax({
						url:"<?=$is_approve_path?>"+val+"/"+id,
						type: "GET",
						success:function(result){
						$('#display_is_approve'+id+'').html(result);
						$(".callout-success").hide();
						$(".callout-danger").hide();
						if(val==1)
						{
							var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been approve successfully and admin panel credential sent to email.</p></div>';
							$('#delete_allmsg_div').html(dhtml);
							
						}
						else
						{
							var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been deactivated successfully.</p></div>';
							$('#delete_allmsg_div').html(dhtml);
						}
						
						},
				});
		

}
//is_publish use
function update_is_publish(val,id)
{
	jQuery.ajax({
	 		url:"<?php echo site_url('admin/home/check_session/')?>",
			type: "POST",
			success:function(result){
			if(result==1)
			{
				<?  if (empty($is_publish_path)) { 
					$is_publish_path='';
				} ?>
				jQuery.ajax({
						url:"<?=$is_publish_path?>"+val+"/"+id,
						type: "GET",
						success:function(result){
						$('#display_ispublish'+id+'').html(result);
						$(".callout-success").hide();
						$(".callout-danger").hide();
						if(val==1)
						{
							<?  if (empty($is_publish_mail_path)) { 
								$is_publish_mail_path='';
							} ?>
							jQuery.ajax({
									url : "<?=$is_publish_mail_path?>"+id,
									type: "GET",
									success:function(result){
									
									$('#delete_allmsg_div').append(result);},
									});
						}
						else
						{
							var dhtml = '<div class="callout callout-success lead"><p><?=$page?> has been draft successfully.</p></div>';
							$('#delete_allmsg_div').html(dhtml);
						}
						
						},
				});
			}
			else
			{
				window.location.href = "<?php echo site_url('admin/home/')?>";
			}
			
			
			},
	});
	

}
</script>
 

<?

}
?>
<!--code for single delte code start-->
<?
if($ckeditor)
{
?>
<script src="//cdn.ckeditor.com/4.5.2/full/ckeditor.js"></script>
<script src="<? echo HTTP_ASSETS_PATH_ADMIN;?>js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
     CKEDITOR.replace( 'description',{ filebrowserUploadUrl : '<?=base_url()?>upload'});
	 CKEDITOR.config.allowedContent = true;
	 CKEDITOR.config.protectedSource.push( /<span[\s\S]*?\/span>/g );
 $("form").submit( function() {
						 var messageLength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
        if( !messageLength ) {
			if($("#error_description").length!= 0) {
			
				 $("#error_description").show();
	   				return false;
					}
        }     });

</script>
<?
}
?>
<script>
  $(function() {
    $("#news_start_date").datepicker();
	$("#news_end_date").datepicker();
	$('#start_date').datepicker({
		minDate: 0,
		

      onSelect: function(selected) {
	   var currentid = this.id;
	   currentid  = currentid.replace('start_date','end_date');
	   $("#"+currentid).datepicker("option","minDate", selected)
	   }
	
	});
	  
	$('#end_date').datepicker({
		minDate: 0,
     	onSelect: function(selected) {
	   var currentid = this.id;
	   currentid  = currentid.replace('end_date','start_date');
	   $("#"+currentid).datepicker("option","maxDate", selected)
		}
	});
	
  });

   function check_session()
  {
	  var valid=true;
	  jQuery.ajax({
	 		url:"<?php echo site_url('admin/home/check_session/')?>",
			type: "POST",
			async:false,
			success:function(result){
			if(result!=1)
			{
				valid=false;
				
			}
			
			},
		});
	  if(valid==false){
		  window.location.href = "<?php echo site_url('admin/home/')?>";
		  
	  }
	  return valid;
  }

  </script>
 

 