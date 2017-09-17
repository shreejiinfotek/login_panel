<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width: 900px; margin:auto; border: 1px solid #CECECE;">
  <div style="font-family:'Brandon',Helvetica,Arial!important;font-size:16px;color:#30373b;background-color:#fff; margin: 25px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr height="80" valign="top" >
        <td  height="80"><table width="100%" border="0">
            <tr style="height: 100px; background-color:#ff8000;">
              <td><img src="<?=$site_url.$websitelogo?>" alt="<?=$project_name?>" border="0"></td>
            </tr>
            <tr>
              <td bgcolor="#465455" style="text-align:right;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b> <?=$project_name?> Application Received</b>&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><table width="100%" style="padding: 0px 10px 0px 10px;">
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;width:30%"><b>Name :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;width:70%"><?=$full_name?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Tr Employee Id :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$tr_employee_id?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Employee Email :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$employee_email?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2" align="left" ><table border="0" width="100%" >
            <tr>
              <td  class="text11" valign="top" style="padding:5px 10px 0px 12px;width:100%;"
><table cellpadding="5" cellspacing="5" class="table table-bordered tableformat"  border="1" width="100%"  style="border-collapse:collapse;border-color:#d7d7d7;border: 1px solid #d7d7d7;">
                  <tr height="22">
                    <td colspan="4" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:15px;color:#292929;text-decoration:none;text-align:justify;line-height:25px;background-color:#eeeeef;height:30px;padding-left:5px;"><b>External Qualification</b></td>
                  </tr>
                  <tr height="22">
                    <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:20px;width:25%;"><b> Certification(s) </b></td>
                    <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:20px;width:25%;"><b> Level </b></td>
                    <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:20px;width:25%;"><b> Result </b></td>
                    <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:20px;width:25%;"><b> Date of Completion </b></td>
                  </tr>
                  <?=$qualification?>
                </table></td>
            </tr>
          </table></td>
      </tr>
      
      <tr>
        <td><table width="100%"  style="padding: 0px 10px 0px 10px;">
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;width:30%"><b>Letter of Motivation :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;width:70%"><?=$motivation_description?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            
          </table></td>
      </tr>
      
      <tr>
        <td bgcolor="#465455" style="height: 25px;" >&nbsp;</td>
      </tr>
      <tr>
        <td  height="20"></td>
      </tr>
      <tr>
        <td style="text-align:center;"><?=$copyright?></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
