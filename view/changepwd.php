<h2>Change Password</h2>
<p>If you feel that you have a weaker strengh password, then please change it. We recommend to change your password in every 45 days to make it secure.</p>

<strong>Password Change guidelines</strong>


<link href="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/confirmvalidation/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/confirmvalidation/SpryValidationConfirm.js" type="text/javascript"></script>

<p>&nbsp;</p>
  <form action="<?php echo WEB_ROOT; ?>view/process.php?action=changepwd" method="post">
    <table width="500" border="0" cellpadding="5" cellspacing="1" class="entryTable">
      <tr id="listTableHeader">
        <th colspan="2">Change Password</th>
      </tr>
      <tr>
        <td width="160" height="30" class="label"><strong>User Name</strong></td>
        <td height="30" class="content">		
			<input type="text" class="frmInputs" size="40" value="<?php echo $_SESSION['hlbank_user_name'];  ?>" disabled="disabled" />
			<input type="hidden" name="id" value="<?php echo $_SESSION['hlbank_user']['user_id'];?>" />
		</td>
      </tr>
      <tr>
        <td width="160" height="30" class="label"><strong>Account Number</strong></td>
        <td height="30" class="content">
          <input type="text" class="frmInputs" size="40" value="<?php echo $_SESSION['hlbank_user']['acc_no'] ?>" disabled="disabled"/></td>
      </tr>
      <tr>
        <td width="160" height="30" class="label"><strong>New Password</strong></td>
        <td height="30" class="content">
		<span id="sprypwd"> 
              <input name="password" type="password" class="frmInputs" id="pass" size="30" /><br />
              <span class="passwordRequiredMsg">Password is required.</span>
			  <span class="passwordMinCharsMsg">You must specify at least 6 characters.</span>
			  <span class="passwordMaxCharsMsg">You must specify at max 10 characters.</span>
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="160" height="30" class="label"><strong>Confirm New Password</strong></td>
        <td height="30" class="content">
		<span id="sprycpwd"> 
              <input name="cpassword" type="password" class="frmInputs" id="pass" size="30" /><br />
              <span class="confirmRequiredMsg">Confirm Password is required.</span>
			  <span class="confirmInvalidMsg">Confirm Password values don't match</span>
			</span>
		</td>
      </tr>
      
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30"><input name="submitButton" type="submit" class="frmButton" id="submitButton" value="Change Password" /></td>
      </tr>
    </table>
  </form>
  
<script type="text/javascript">
<!--
//Password
var sprypass1 = new Spry.Widget.ValidationPassword("sprypwd", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});
//Confirm Password
var spryconf1 = new Spry.Widget.ValidationConfirm("sprycpwd", "sprypwd", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});
//-->
</script>