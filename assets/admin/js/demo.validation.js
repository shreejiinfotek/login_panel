/*
 * Dandelion Admin v2.0 - Form Validation JS
 *
 * This file is part of Dandelion Admin, an Admin template build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * March 25, 2012
 * Last Update:
 * December 07, 2012
 *
 */

(function($) {
	$(document).ready(function(e) {
		if($.fn.select2) {
			$("#da-ex-val-chzn").select2();
		}
		
		if($.fn.spinner) {
			$("#da-ex-val-spin").spinner();
		}
		
		if($.fn.validate) {
			$("#da-ex-validate1").validate({
				rules: {
						email: {
						required: true, 
						email: true
					}, 
				/*	Cost:{
						
						required: true,
						digits: true,
						range: [1, 9999999]
						}
,	*/Connection:{
						
						required: true,
						digits: true,
						range: [1, 9999999]
						}
,		
					display_order: {
						digits: true
					}, 
					category_image: {
						required: true, 
						accept:['.gif|.jpg|.png|.GIL|.JPG|.PNG|.JPEG|.jpeg']
					},
					category_image_not_required: {
						accept:['.gif|.jpg|.png|.GIL|.JPG|.PNG|.JPEG|.jpeg']
					}
					,
						AdvertisementURL: {
						url: true
					},
					IndustryCSV: {
						required: true, 
						  extension: "csv"
					
					},
					
								txtnewpass: {
						required: true, 
						minlength: 5
					}, 
					txtconpass: {
						required: true, 
						minlength: 5, 
						equalTo: '#txtnewpass'
					},
					txtoldpass: {
						required: true, 
						minlength: 5, 
						equalTo: '#txtold'
					}
					
				}, 
				 messages: {
       
        txtoldpass: {
            equalTo: "Please enter correct old password"
        }, txtconpass: {
            equalTo: "Password and confirm password should be smae"
        }
		
    },
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'You missed 1 field. It has been highlighted'
						: 'You missed ' + errors + ' fields. They have been highlighted';
						$("#da-ex-val1-error").html(message).show();
					} else {
						$("#da-ex-val1-error").hide();
					}
				}
			});
			
			$("#da-ex-validate2").validate({
				rules: {
					minl1: {
						required: true, 
						minlength: 5
					}, 
					maxl1: {
						required: true, 
						maxlength: 5
					}, 
					rangel1: {
						required: true, 
						rangelength: [5, 10]
					}, 
					min1: {
						required: true, 
						digits: true, 
						min: 5
					}, 
					max1: {
						required: true, 
						digits: true, 
						max: 5
					}, 
					range1: {
						required: true, 
						digits: true, 
						range: [5, 10]
					},
					DegreeCSV: {
						required: true, 
					  extension: "csv"
					}
				}, 
				invalidHandler: function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
						? 'You missed 1 field. It has been highlighted'
						: 'You missed ' + errors + ' fields. They have been highlighted';
						$("#da-ex-val2-error").html(message).show();
					} else {
						$("#da-ex-val2-error").hide();
					}
				}
			});
			
			$("#da-ex-validate3").validate({
				ignore: '.ignore', 
				rules: {
					gender: {
						required: true
					}, 
					sport: {
						required: true
					}, 
					file1: {
						required: true, 
						accept: ['.jpeg']
					}, 
					dd1: {
						required: true
					}, 
					chosen1: {
						required: true
					}, 
					spin1: {
						required: true, 
						min: 5, 
						max: 10
					}
				}
			});
			
			$("#da-ex-validate4").validate({
				rules: {
					email: {
						required: true, 
						email: true
					}, 
					pass2: {
						required: true, 
						minlength: 5
					}, 
					cpass2: {
						required: true, 
						minlength: 5, 
						equalTo: '#pass2'
					}, 
					address: {
						required: "#souvenirs:checked"
					}
				}
			});
		}
	});
}) (jQuery);