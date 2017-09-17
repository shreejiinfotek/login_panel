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
        <td height="80"><table width="100%" border="0">
            <tr style="height: 100px; background-color:#ff8000;">
              <td><img src="<?=$site_url.$websitelogo?>" alt="<?=$project_name?>" border="0"></td>
            </tr>
            <tr>
              <td bgcolor="#465455" style="text-align:right;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b><?=$project_name?> Forgot Password</b>&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:20px;"><table>
            <tr>
              <td><strong>Hello</strong> <?=$username?>,</td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td>Your login details at <?=$project_name?> is as follows: </td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
            <tr> <td><p>We received a request to reset the password associated with this e-mail address. If you made this request, please follow the instructions below.</p>
                      <p>Click on the link below to reset your password using our server: <a href="<?=$site_url?>reset_password/index/<?=$uid?>"><?=$site_url?>reset_password/index/<?=$uid?></a></p>
                      <p>If you did not request to have your password reset you can safely ignore this email. Rest assured your customer account is safe.</p>
                      <p>If clicking the link does not seem to work, you can copy and paste the link into your browser's address window, or retype it there. Once you have returned to <?=$project_name?>, we will give instructions for resetting your password.</p></td>
             
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
