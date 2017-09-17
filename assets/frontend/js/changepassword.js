
	function verify()
	{ 
		var arrTmp=new Array();
		arrTmp[0]=checkoldpass();
		arrTmp[1]=checknewpass();
		arrTmp[2]=checkconpass();
	
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
	
	function checkoldpass()
	{
		
		if(trim(document.frmcpass.txtoldpass.value) == "")
		{	 
			document.getElementById("lbloldpass").innerHTML="Please enter old password.";
			return false;
		}
		else
		{
			if(document.frmcpass.txtold.value != document.frmcpass.txtoldpass.value)
			{
				document.getElementById("lbloldpass").innerHTML="Old password is not correct.";
				return false;
			}
			else
			{
				document.getElementById("lbloldpass").innerHTML="";
				return true;
			}
		}
	}
	function checknewpass()
	{
		
		if(trim(document.frmcpass.txtnewpass.value) == "")
		{	 
			document.getElementById("lblnewpass").innerHTML="Please enter new password.";
			return false;
		}
		else
		{
			document.getElementById("lblnewpass").innerHTML="";
			return true;
		}
	}
	function checkconpass()
	{
		
		if(trim(document.frmcpass.txtconpass.value) == "")
		{	 
			document.getElementById("lblconpass").innerHTML="Please enter confirm password.";
			return false;
		}
		else
		{
			if(document.frmcpass.txtnewpass.value != document.frmcpass.txtconpass.value)
			{
				document.getElementById("lblconpass").innerHTML="Password & confirm password must be same.";
				return false;
			}
			else
			{
				document.getElementById("lblconpass").innerHTML="";
				return true;
			}
		}
	}