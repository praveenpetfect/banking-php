<?php
require_once './library/config.php';
require_once './library/functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['accno']) && isset($_POST['pass'])) {
	$result = doLogin();
	
	if ($result != '') {
		$errorMessage = $result;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_title; ?></title>

<link href="<?php echo WEB_ROOT;?>css/admin.css" rel="stylesheet" type="text/css">
<link href="<?php echo WEB_ROOT;?>css/styles.css" rel="stylesheet" type="text/css">

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>

</head>

<body style="background-color:#ECECEC;margin-top:50px;">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
 <tr style="background-color:#FFFFFF"> 
  <td><img src="<?php echo WEB_ROOT; ?>images/OnlineBanking-logo.png" /></td>
 </tr>
 <tr> 
  <td valign="top"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="20">
    <tr> 
     <td class="contentArea">
		<form action="#" method="post" enctype="multipart/form-data" id="acclogin">
      <h2 align="center"><strong>Login Step 1:</strong> Log in to Access your Account</h2>
      <p align="center">Enter Your Account Login Details to proceed</p>
	  <div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
       <table width="450" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
        <tr id="entryTableHeader"> 
         <td><div align="center">:: Customer Login ::</div></td>
        </tr>
        <tr> 
         <td class="contentArea"> 
		 
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr> 
            <td colspan="3">&nbsp;</td>
           </tr>
           <tr class="text"> 
            <td width="100" align="right">Account No</td>
            <td width="10" >:</td>
            <td>
			<span id="sprytextfield1" style="text-align:left;">
            <input name="accno" type="text" id="accno" tabindex="10" size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Account Number is required.</span>
			<span class="textfieldInvalidFormatMsg">Invalid Account Number.</span>
			</span>
			</td>
           </tr>
           <tr> 
            <td width="100" align="right">Password</td>
            <td width="10" align="center">:</td>
            <td>
			<span id="sprypassword1" style="text-align:left;"> 
              <input name="pass" type="password" id="pass" tabindex="20" size="30" /><br />
              <span class="passwordRequiredMsg">Password is required.</span>
			  <span class="passwordMinCharsMsg">You must specify at least 6 characters.</span>
			  <span class="passwordMaxCharsMsg">You must specify at max 10 characters.</span>
			</span>
			</td>
           </tr>
		   
		  
           <tr> 
            <td colspan="2">&nbsp;</td>
            <td><input name="submitButton" type="submit" id="submitButton" value="Login Now ! " /></td>
           </tr>
		   
		   <tr>
             <td colspan="3">
			 If your account is not register with us, please <a href="<?php echo WEB_ROOT; ?>register.php">Register it Now</a>.
			 </td>
          </tr>
		  
          </table></td>
        </tr>
       </table>
       <p>&nbsp;</p>
      </form></td>
    </tr>
	
   </table>
   
   </td>
 </tr>
</table>
<p>&nbsp;</p>
</body>
<script>
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});
//-->
</script>
</html>
