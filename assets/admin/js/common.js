
valid_file_message="Please upload valid file. gif / jpeg / jpg / png.";
valid_file_accept='.gif|.GIF|.jpg|.png|.JPG|.PNG|.JPEG|.jpeg';

valid_file_video_message="Please upload valid file. mp4 / mkv / 3gp.";
valid_file_video_accept='.mp4|.mkv|.3gp';
valid_file_course_pdf_message="Please upload valid file. pdf.";
valid_file_accept_course_pdf='.pdf|.PDF';
valid_file_import_message="Please upload valid file. xls / xlsx.";
valid_file_accept_import='sheet|ms-excel';

var returnimg = [];

function readfile(pthis)
{	
	$("#Submit").attr('disabled', 'disabled');
	returnimg[id] =false;
	var $this =$(pthis);
		var F = $this[0].files;
		var param =$this.attr("imgwidthheight");
		var id =$this.attr("id");
		if(F && F[0]) 
			for(var i=0; i<F.length; i++)
			{
				var reader = new FileReader();
				var image  = new Image();
				var file = F[i];
			
				reader.readAsDataURL(file);  
				reader.onload = function(_file) {
					image.src    = _file.target.result;              // url.createObjectURL(file);
					image.onload = function() {
						var w = this.width,
							h = this.height,
							t = file.type,                           // ext only: // file.type.split('/')[1],
							n = file.name,
							s = parseFloat((file.size/1024)).toFixed(2) +'KB';
						//	$('#uploadPreview').append('<img src="'+ this.src +'" width="100"> '+w+'x'+h+' '+s+' '+t+' '+n+'<br>');
							w=parseInt(w);
							h=parseInt(h);
							//alert("Fun "+w+" "+h+" "+(w<600));
							param_w = parseInt(param.split("X")[0]);
							param_h = parseInt(param.split("X")[1]);
							 $('#Submit').removeAttr("disabled")
							if(w==param_w && h==param_h)
							{
								returnimg[id] =true;
								return true;
							}
							else
							{
							returnimg[id] =false;
								return false;
							}
						}; // img.onload over
					image.onerror= function() 
					{
						//alert('Invalid file type: '+ file.type);
					};     //reader.onerror over
			};//reader.onload
		}//for loop over
}
function findnewfileuploader()
{
	
 $("[imgwidthheight]:not([filevalid])").each(function(){
														   $(this).attr("filevalid","1");
														  	param = $(this).attr("imgwidthheight");
														   param_w = parseInt(param.split("X")[0]);
															param_h = parseInt(param.split("X")[1]);
														    $(this).attr("data-msg-imgwidthheight","Please upload correct image(" + param_w +"px W * "+ param_h + "px H)");
														   $(this).change(function(){
																	readfile(this);			   
																				   });
														  
														  });
}
$(document).ready(function()
{
	findnewfileuploader();
	setInterval(findnewfileuploader,1000);
	$.validator.addMethod("imgwidthheight", function (value, element, param) 
	{
		var id = $(element).attr("id");
		
		
		return typeof(returnimg[id])=="undefined" || returnimg[id]==null || returnimg[id];
			
			
	}, "Please ");
  });


	$(document).ready(function(e) {
							   
	// Validation
			$(".da-home-form").validate({
				rules: {
					txtconfirmpassword: {
						required: true, 
						minlength: 5, 
						equalTo: '#txtnewpassword'
					},
					txtoldpassword: {
						required: true, 
						minlength: 5, 
						equalTo: '#hdoldpassword'
					},
					banner_image: {
						accept:valid_file_accept
					},
					age_to: {
						greaterThan: '#age_from'
					},
					inner_images: {
						accept:valid_file_accept
					},
					main_image_path:{
						accept:valid_file_accept
					},
					cover_news_image:{
						accept:valid_file_accept
					},
					courses_image:{
						accept:valid_file_accept
					},
					profile_picture_path: {
						accept:valid_file_accept
					},
					social_media_image:{
						accept:valid_file_accept	
					},
					logo_center:{
						accept:valid_file_accept	
					},
					website_logo:{
						accept:valid_file_accept	
					},
					our_program_image:{
						accept:valid_file_accept	
					},
					news_event_image:{
						accept:valid_file_accept	
					},
					testimonial_image:{
						accept:valid_file_accept	
					},
					pdf_path:{
						accept:valid_file_accept_course_pdf
					},
					import_path:{
						accept:valid_file_accept_import
					}

									
				}
				, 
				 messages: {
		banner_image: {
			accept:valid_file_message
		},
		inner_images: {
			accept:valid_file_message
		},
		main_image_path:{
			accept:valid_file_message
		},
		profile_path: {
			accept:valid_file_message
		},
		cover_news_image:{
			accept:valid_file_message
		},
		courses_image:{
			accept:valid_file_message
		},
		profile_picture_path:{
			accept:valid_file_message
		},
		social_media_image:{
			accept:valid_file_message
		},
		logo_center:{
			accept:valid_file_message
		},
		website_logo:{
			accept:valid_file_message
		},
		our_program_image:{
			accept:valid_file_message
		},
		news_event_image:{
			accept:valid_file_message
		},
		testimonial_image:{
			accept:valid_file_message
		},
		partnership_image:{
			accept:valid_file_message
		},
		school_image:{
			accept:valid_file_message
		},
		school_banner:{
			accept:valid_file_message
		},
		our_program_banner:{
			accept:valid_file_message
		},
		school_videofile:{
			accept:valid_file_video_message
		},
		right_section_image:{
			accept:valid_file_message
		},
		pdf_path:{
			accept:valid_file_course_pdf_message
		},
		import_path:{
			accept:valid_file_import_message
		},
		txtoldpassword: {
            equalTo: "Please enter correct old password."
        }, txtconfirmpassword: {
            equalTo: "Password and confirm password should be same."
        }
		
    }
			});
			
		
	});


function galleryType(thisval)
{	
	jQuery(".Video").hide();
	jQuery(".VideoFile").hide();
	jQuery(".Caption").hide();
	jQuery(".Image").hide();
	if(thisval=="1")
	{
		jQuery(".Image").show();
		jQuery(".Caption").show();
		
	}
	else if(thisval=="2")
	{	 
		jQuery(".Video").show();
	}
	else if(thisval=="3")
	{
		
		jQuery(".VideoFile").show();
	}
}
function mediaType(thisval)
{	
	jQuery(".Video1").hide();
	jQuery(".VideoFile1").hide();
	jQuery(".Image1").hide();
	if(thisval=="1")
	{
		jQuery(".Image1").show();	
	}
	else if(thisval=="2")
	{	 
		jQuery(".Video1").show();
	}
	else if(thisval=="3")
	{
		jQuery(".VideoFile1").show();
	}
}
function numericOnly(elementRef)
{
	var keyCodeEntered = (event.which) ? event.which : (window.event.keyCode) ? window.event.keyCode : -1;
	
	var number = elementRef.value.split('.');

	if (number.length == 2 && number[1].length > 1)
	{
		return false;
	}
	 if ( (keyCodeEntered >= 48) && (keyCodeEntered <= 57) )
	 {
		return true;
	 }
	 
	 // '.' decimal point...
	 else if ( keyCodeEntered == 46 )
	 {
		  // Allow only 1 decimal point ('.')...
		  if( (elementRef.value) && (elementRef.value.indexOf('.') >= 0) )
		  {
		  	return false;
		  }
		  else
		  {
		   return true;
		  }
	 }

	 return false;
}

function validate() {
$("#mobileValidation").hide();
var mobile = document.getElementById("store_telephone").value;
var pattern = /^[\s()+]*([0-9][\s()+]*){6,20}$/;
if (pattern.test(mobile)) {
	 $("#Submit").removeAttr('disabled');
return true;
}
else
{
	if(mobile!="")
	{
		$("#Submit").attr('disabled','disabled');
		$("#mobileValidation").show();
		return false;
	}
} 
}

var activeShowingLoadingPanel =0;
function StartLoading() {
	if(activeShowingLoadingPanel==0){
    $("#loadingPanel").show();
	}
	activeShowingLoadingPanel++;
}

function StopLoading() {
		activeShowingLoadingPanel--;
		if(activeShowingLoadingPanel==0){
		    $("#loadingPanel").hide();
		}
}


 

