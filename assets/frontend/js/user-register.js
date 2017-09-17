function trim(str) 
	{    
		if (str != null) 
		{        
			var i;        
			for (i=0; i<str.length; i++) 
			{           
				if (str.charAt(i)!=" ") 
				{               
					str=str.substring(i,str.length);                 
					break;            
				}        
			}            
			for (i=str.length-1; i>=0; i--)
			{            
				if (str.charAt(i)!=" ") 
				{                
					str=str.substring(0,i+1);                
					break;            
				}         
			}                 
			if (str.charAt(0)==" ") 
			{            
				return "";         
			} 
			else 
			{            
				return str;         
			}    
		}
	}
///

function verify()
		{
			var arrTmp=new Array();
			var i;
			_blk=true;
			
			arrTmp[0]=checkname();
			arrTmp[1]=checkemail();
			arrTmp[2]=checkphone_number();
			arrTmp[3]=checkpass();
			arrTmp[4]=checkPasswordRetype();
			arrTmp[5]=checkfilevalidate();
			arrTmp[6]=checkDOBdate();
			
			
			
			
			
			
				
			for(i=0;i<arrTmp.length;i++)
			{
				if(arrTmp[i]==false)
				{
					_blk=false;
				}
			}
			
			if(_blk==true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	
		function checkname()
		{
			//alert(document.registrationForm.fullname.value);
			if(trim(document.registrationForm.fullname.value)=="")
			{
				document.getElementById('lblfname').innerHTML="Please enter name.<br />";
				return false;	
			}
			else
			{
				document.getElementById('lblfname').innerHTML="";
				return true;
			}
		}
		
		
		
		function checkemail()
		{
			if(trim(document.registrationForm.user_email.value) != "")
			{	
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				var address = trim(document.registrationForm.user_email.value);
				if(reg.test(address) == false)
				{
					document.getElementById("lblemail").innerHTML="Please enter valid email address.<br />";
					return false;
				}
				else
				{
					document.getElementById("lblemail").innerHTML="";
					return true;
				}
			
			} else
			{
				document.getElementById("lblemail").innerHTML="";
					return true;
			}
		}
		function checkphone_number()
		{
			if(trim(document.registrationForm.user_mobile.value)=="")
			{
				document.getElementById('lblmobile').innerHTML="Please enter mobile number.<br />";
				return false;	
			}
			else
			{
				var	pattern = /^\d{10}$/;
				if(!pattern.test(document.registrationForm.user_mobile.value))
				{
					document.getElementById('lblmobile').innerHTML="Please enter valid mobile number.<br />";
					return false;
				}
				else
				{
					document.getElementById('lblmobile').innerHTML="";
					return true;
				}
			}
		}
		function checkpass()
		{	
			if(trim(document.registrationForm.user_password.value)=="")
			{
				document.getElementById('lblpassword').innerHTML="Please enter password.<br />";
				return false;	
			}
			else
			{
				document.getElementById('lblpassword').innerHTML="";
				return true;
			}
		}
		function checkPasswordRetype()
		{
			if(trim(document.registrationForm.user_retype_password.value) == "")
			{	 
				document.getElementById("lblrepassword").innerHTML="Please reenter password.<br />";
				return false;
			}
			else
			{
				if(trim(document.registrationForm.user_retype_password.value)!=trim(document.registrationForm.user_password.value))
				{
					document.getElementById("lblrepassword").innerHTML="Password and Retype Password must be same.<br />";
					return false;
				}
				else
				{
					document.getElementById("lblrepassword").innerHTML="";
					return true;
				}
			}
		}
		
		function checkfilevalidate() {
		var filename=document.getElementById('user_profile').value;
		var extension=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();
		if(filename=="")
		{
			document.getElementById("lblfile").innerHTML="";
			return true;
		} 
		else 
		if(extension=='jpg' || extension=='gif' || extension=='png' || extension=='jpeg') {
			 document.getElementById("lblfile").innerHTML="";
			return true;
		} else {
			
			document.getElementById("lblfile").innerHTML="Please upload valid file(jpg,png,jpeg,gif).<br />";
			return false;
		}
	}
	
	function checkDOBdate()
		{
			//alert(document.registrationForm.fullname.value);
			if(trim(document.registrationForm.dob.value)=="")
			{
				document.getElementById('lbldob').innerHTML="<br />Please enter date of birth.<br />";
				return false;	
			}
			else
			{
				document.getElementById('lbldob').innerHTML="";
				return true;
			}
		}
		
		
		
		
		
function duplicate_mobile(mobile)
{
	hid_base_url=document.getElementById('hid_base_url').value;

				$.ajax({
					type: "POST",
					url: hid_base_url+"register/duplicat_mobile_validation",
					data: {mobile:mobile},
					success: function(result) {
						
						
						if(result==1)
						{
							$("#lblmobile" ).empty();
							$("#lblmobile").append('Mobile number already registered.<br />');
							document.getElementById("user_mobile").focus();
							$("#Submit").attr("disabled", "disabled");
						}
						else
						{
							$("#lblmobile" ).empty();
							$("#Submit").removeAttr("disabled");
						}
					},
					async:false
				});
}