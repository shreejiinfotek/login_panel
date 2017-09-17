// JavaScript Document

function chkContactUs(frmInstant){
    var formclear = true;
    var firstname = trim(document.getElementById("EnquiryName").value);
    if(firstname=="" || firstname=="Please enter your name"){
        document.getElementById("EnquiryName").className = "input_error text-box";
        document.getElementById("EnquiryName").value = "Please enter your name";
        errinstant=true;
        formclear = false;
    }
    var email_address = trim(document.getElementById("EnquiryEmail").value);
    if(email_address=="" || email_address=="Please enter your email"){
        document.getElementById("EnquiryEmail").className = "input_error text-box";
        document.getElementById("EnquiryEmail").value = "Please enter your email";
        formclear = false;
    }
    else if(validateEmail(email_address)==null){
        document.getElementById("EnquiryEmail").className = "input_error text-box";
        document.getElementById("EnquiryEmail").value = "Please enter your valid email";
    		formclear = false;
    }
	var phone_number = trim(document.getElementById("EnquiryPhoneNumber").value);
	var	pattern = /^[\s()+]*([0-9][\s()+]*){6,20}$/;
	if(phone_number=="" || phone_number=="Please enter phone number"){
        document.getElementById("EnquiryPhoneNumber").className = "input_error text-box";
        document.getElementById("EnquiryPhoneNumber").value = "Please enter your phone number";
        errinstant=true;
        formclear = false;
    }
	else if(!pattern.test(phone_number) && phone_number!="Please enter your phone number")
	{
		document.getElementById("EnquiryPhoneNumber").className = "input_error text-box";
        document.getElementById("EnquiryPhoneNumber").value = "Please enter your valid phone number";
        formclear = false;
	}
    var message = trim(document.getElementById("EnquiryMessage").value);
    if(message=="" || message=="Please enter your message"){
	    document.getElementById("EnquiryMessage").className = "input_error text-area";
        document.getElementById("EnquiryMessage").value = "Please enter your message";
        formclear = false;
    }
	var random_one = trim(document.getElementById("contact_random_num_first").value);
	var random_two = trim(document.getElementById("contact_random_num_second").value);
	var total_count = trim(document.getElementById("contact_total").value);
	var compare_total=parseInt(random_one)+parseInt(random_two);
	if(total_count =="")
    {
		document.getElementById("contact_total").className = "input_error smallinput-2";
        document.getElementById('contact_sum_total').innerHTML="<br />You can't leave captcha code empty";
        formclear = false;
    }
	else if(total_count!=compare_total)
	{
		document.getElementById("contact_total").className = "input_error smallinput-2";
        document.getElementById('contact_sum_total').innerHTML="<br />Please enter correct captcha code";
        formclear = false;
       
	}
	else
	{
		document.getElementById('contact_sum_total').innerHTML="";
		document.getElementById("contact_total").className = "smallinput-2";
	}
	
    if(formclear==false){
        return false;
    }
    else{
		
        var xmlhttp;
        if (window.XMLHttpRequest){
     			xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
        }
        else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
        }
		

        $(".contact-process").delay(10).fadeTo("slow",0.7);
	
        $("#GetContact").delay(10).fadeTo("slow",0.1);
		var base_url=document.getElementById("base_url").value;
        var sendUrl = base_url+"contact_us/sendmessage?Quotation_fullname="+firstname+"&Quotation_phone="+encodeURIComponent(phone_number)+"&Quotation_email="+email_address+"&Quotation_message="+message;
		//alert(sendUrl);
       xmlhttp.open("GET",sendUrl);
        xmlhttp.send(null);
        xmlhttp.onreadystatechange=function(){
		//alert(xmlhttp.responseText);
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
                  if(xmlhttp.responseText=="success"){
                     $(function() {
                           //$('.quote-contact-form').fadeOut('normal');
                           $('#contact-msgquot').delay(100).fadeIn('normal', function() {
											
                             $(this).delay(1000).fadeOut();
							 
                             $(".contact-process").delay(10).fadeOut("normal");
						 
                             $("#GetContact").delay(1000).fadeTo("slow",1);
							 
                         
                           });
                     });
                   
		    //grecaptcha.reset();
                ResetContact();
				
				setTimeout(contact_randomnum(), 1000);
					 
                  }
              }
        }
        return false;
    }
    return false;
}
function ResetContact()
{
	 				document.getElementById("EnquiryName").value = "";
                    document.getElementById("EnquiryEmail").value = "";
					document.getElementById("EnquiryPhoneNumber").value = "";
					
                    document.getElementById("EnquiryMessage").value = "";
					document.getElementById("contact_total").value = "";
					 
		    
                     $("#EnquiryName").attr('class',"text-box");
                     $("#EnquiryEmail").attr('class',"text-box");
					 $("#EnquiryPhoneNumber").attr('class',"text-box");
                     $("#EnquiryMessage").attr('class',"text-area");
					 
}