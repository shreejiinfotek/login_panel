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
            <tr>
              <td><img src="<?=$site_url?>assets/frontend/images/logo.png" alt="<?=$project_name?>" border="0"></td>
            </tr>
            <tr>
              <td bgcolor="#e92c55" style="text-align:right;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b><?=$project_name?> Admin Panel Password</b>&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:20px;"><table>
            <tr>
              <td><strong>Dear</strong> <?=$username?>,</td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><p><a href="<?=$site_url?>admin" style="color:#1e7ec8" target="_blank">Click</a> here to login and then enter your e-mail address and password.</p>
                <p>Use the following values when artist panel to log in:</p>
                <p><strong>E-mail</strong>: <?=$user_email?><br>
                  <strong>Password</strong>: <?=$password?></p></td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><p>When you log in to your account, you will be able to do the following:</p>
                <ul>
                  
                  
                  
                  <li>Make changes to your account information</li>
                  <li>Change your password</li>
                 
                </ul>
                <p>If you have any questions about your account or any other matter, please feel free to contact us at <a href="mailto:<?=$site_email?>" style="color:#1e7ec8" target="_blank"><?=$site_email?></a>.</p></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td bgcolor="#e92c55" style="height: 25px;" >&nbsp;</td>
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
