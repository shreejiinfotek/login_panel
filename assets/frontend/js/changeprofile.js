	function changeprofileverify()
	{ 
	
		var arrTmp=new Array();
		arrTmp[0]=checkname();
		arrTmp[1]=checkemail();
		
		
		var i;
		_blk=true;
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
		
		if(document.frmreg.student_name.value == "")
		{	 
			document.getElementById("lblname").innerHTML="Please enter name";
			return false;
		}
		else
		{
			document.getElementById("lblname").innerHTML="";
			return true;
		}
	}
	function checkemail()
			{
				if(trim(document.frmreg.student_email.value) != "")
				{	
					var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
					var address = trim(document.frmreg.student_email.value);
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
	