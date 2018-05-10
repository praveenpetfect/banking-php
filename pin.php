<?php
require_once './library/config.php';
require_once './library/functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['accpin'])) {
	$result = doPinValidation();
	
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
      <h2 align="center"><strong>Login Step 2:</strong> Log in to Access your Account</h2>
      <p align="center">Enter Your Account PIN to proceed</p>
	  <div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
       <table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
        <tr id="entryTableHeader"> 
         <td><div align="center">:: Customer Login ::</div></td>
        </tr>
        <tr> 
         <td class="contentArea"> 
		 
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr> 
            <td colspan="3">&nbsp;</td>
           </tr>
          
           <tr> 
            <td width="100" align="right">PIN Number</td>
            <td width="10" align="center">:</td>
            <td>
			<span id="spry_pin"> 
              <input name="accpin" type="password" id="accpin" size="20" maxlength="6" /><br />
              <span class="textfieldRequiredMsg">Account Pin is required.</span>
			  <span class="textfieldMinCharsMsg">Account Pin must specify at least 4 characters.</span>
			  <span class="textfieldMaxCharsMsg">Account Pin must specify at max 6 characters.</span>
			</span>
			</td>
           </tr>
           <tr> 
            <td colspan="2">&nbsp;</td>
            <td><input name="submitButton" type="submit"  id="submitButton" value="Validate PIN " /></td>
           </tr>
          </table></td>
        </tr>
       </table>
       <p>&nbsp;</p>
      </form></td>
    </tr>
	<tr>
		<td class="contentArea" style="border-top:#999999 thin dashed;">
		<p style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px; margin-bottom:40px; text-align:center;">
		</td>

		</p>
	</tr>
   </table>
   
   </td>
 </tr>
</table>
<p>&nbsp;</p>
</body>
<script type="text/javascript">
<!--
//
var spry_pin = new Spry.Widget.ValidationTextField("spry_pin", 'integer', {minChars:4, maxChars: 6, validateOn:["blur", "change"]});
//-->
</script>
</html>
