function chkJoinTheMovement(){
    var formclear = true;
   
    var email_address = trim(document.getElementById("News_Email").value);
    if(email_address=="" || email_address=="Email" || email_address=="Please enter your valid email"){
        document.getElementById("News_Email").className = "input_error form-control ";
        document.getElementById("News_Email").value = "Please enter your email";
        formclear = false;
    }
    else if(validateEmail(email_address)==null){
        document.getElementById("News_Email").className = "input_error form-control";
        document.getElementById("News_Email").value = "Please enter your email";
    		formclear = false;
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
      
	  var base_url=document.getElementById("site_url").value;
	  

		var sendUrl = base_url+"home/sendnewslatter?email="+email_address;
	
       xmlhttp.open("GET",sendUrl);
        xmlhttp.send(null);
        xmlhttp.onreadystatechange=function(){
		
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
				  
				  
				  if(xmlhttp.responseText=="success")
				 	{
						$("#modelConfirm").modal();
						document.getElementById("News_Email").value= "";
				    
					}
					 else
				   	{
            		     $("#modelExist").modal();
						 
					}
              }
        }
        return false;
    }
    return false;
}
function duplicate_email(email)
{
	if(email!="Email" && email!=""){
		
	 var base_url = trim(document.getElementById("site_url").value);

				$.ajax({
					
					type: "POST",
					url: base_url+"home/duplicate_email_validation",
					data: {email:email},
					success: function(result) {
						
						if(result==1)
						{
							
						$("#btn-submit").attr("disabled", "disabled");
						
						 document.getElementById("lbl_user_email").innerHTML = "";
						 document.getElementById("lbl_user_email").innerHTML = "Email address already registered";
						 
						
							
						}
						else
						{
							$("#btn-submit").removeAttr("disabled");
							document.getElementById("lbl_user_email").innerHTML = "";
							
						}
					},
					async:true
				});
	}
}	