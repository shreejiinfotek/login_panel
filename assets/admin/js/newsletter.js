
	 function selectAll()
  	 {
		var chkList1 = document.getElementById("da-ex-datatable-numberpaging");
		var arrayOfCheckBoxes = chkList1.getElementsByTagName("input");
  		if(document.frm_newsletter.chkall.checked)
		{
			for(i=0;i<arrayOfCheckBoxes.length;i++)
			{
				arrayOfCheckBoxes[i].checked=true;
			}
		}
		else
		{
			for(i=0;i<arrayOfCheckBoxes.length;i++)
			{
				arrayOfCheckBoxes[i].checked=false;
			}
		}
		document.frmnews.to.value="";
		document.frmnews.hid_subcribtion_id.value="";
		for(i=1;i<arrayOfCheckBoxes.length;i++)
		{
			if(arrayOfCheckBoxes[i].checked==true)
			{
				var newsletter_id="";
				 	newsletter_id=arrayOfCheckBoxes[i].getAttribute("newsletter_id");
				
					document.frmnews.to.value+=arrayOfCheckBoxes[i].value+",";
				
					document.frmnews.hid_subcribtion_id.value+=newsletter_id+",";
			}
		}
	}
	function DeselectAll()
  	{
		var newsletter_id="";
  		var chkList1 = document.getElementById("da-ex-datatable-numberpaging");
		
		var arrayOfCheckBoxes = chkList1.getElementsByTagName("input");
	
  		if(document.frm_newsletter.chkall.checked)
		{
			for(i=0;i<arrayOfCheckBoxes.length;i++)
			{
				
				if(arrayOfCheckBoxes[i].checked==false)
				{
					document.frm_newsletter.chkall.checked=false;
				}
			}
		}
		if(document.frm_newsletter.chkall.checked==false)
		{
			
			var sel_all2=true;
			for(i=1;i<arrayOfCheckBoxes.length;i++)
			{
				if(arrayOfCheckBoxes[i].checked==false)
				{
					sel_all2=false;
				}
			}
			if(sel_all2==true)
			{
				document.frm_newsletter.chkall.checked=true;
			}
		}
		document.frmnews.to.value="";
		document.frmnews.hid_subcribtion_id.value="";
		for(i=1;i<arrayOfCheckBoxes.length;i++)
		{
			if(arrayOfCheckBoxes[i].checked==true)
			{
				newsletter_id=arrayOfCheckBoxes[i].getAttribute("newsletter_id");
				document.frmnews.to.value+=arrayOfCheckBoxes[i].value+",";
				document.frmnews.hid_subcribtion_id.value+=newsletter_id+",";
			}
		}
	}