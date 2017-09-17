// JavaScript Document
function verify_login()
		{
		//jQuery("#countryName").val($.trim(jQuery('#othercountry :selected').text()));
			var arrTmp=new Array();
			var i;
			_blk=true;
			
			arrTmp[0]=checkphone_number();
			arrTmp[1]=checkpassword();
			//arrTmp[9]=checkverify();
			
				
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
	
		function checkphone_number()
		{
			if(trim(document.LoginForm.user_mobile.value)=="")
			{
				document.getElementById('lblmobile').innerHTML="Please enter mobile number.<br />";
				return false;	
			}
			else
			{
				var	pattern = /^\d{10}$/;
				if(!pattern.test(document.LoginForm.user_mobile.value))
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
		function checkpassword()
		{
			if(trim(document.LoginForm.user_otp.value)=="")
			{
				document.getElementById('lblpassword').innerHTML="Please enter OTP.<br />";
				return false;	
			}
			else
			{
				document.getElementById('user_otp').innerHTML="";
				return true;
			}
		}

