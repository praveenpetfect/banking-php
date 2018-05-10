<h2>Change Account Pin</h2>
<p>If you feel that you have a weaker strengh password, then please change it. We recommend to change your password in every 45 days to make it secure.</p>

<strong>Account Pin Change guidelines</strong>
<p>sadas dasdsa asda s</p>

<link href="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/confirmvalidation/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/confirmvalidation/SpryValidationConfirm.js" type="text/javascript"></script>

<form action="<?php echo WEB_ROOT; ?>view/process.php?action=changepin" method="post">
    <table width="500" border="0" cellpadding="5" cellspacing="1" class="entryTable">
      <tr id="listTableHeader">
        <th colspan="2">Change PIN Number;</th>
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
        <td width="160" height="30" class="label"><strong>New Account Pin</strong></td>
        <td height="30" class="content">
		<span id="sprytf_pin">
            <input name="pin" type="text" class="frmInputs" id="accno"  size="20" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Account Pin is required.</span>
			<span class="textfieldMinCharsMsg">Account Pin must specify at least 4 characters.</span>
			<span class="textfieldMaxCharsMsg">Account Pin must specify at max 6 characters.</span>
			<span class="textfieldInvalidFormatMsg">Account Pin must be Integer.</span>
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="160" height="30" class="label"><strong>Confirm Account Pin</strong></td>
        <td height="30" class="content">
		<span id="sprytf_cpin">
            <input name="cpin" type="text" class="frmInputs" id="accno" size="20" maxlength="30" />
            <br/>
           	<span class="confirmRequiredMsg">Confirm Password is required.</span>
			<span class="textfieldRequiredMsg">Account Pin is required.</span>
			<span class="confirmInvalidMsg">Confirm Password values don't match</span>
		</span>
		</td>
      </tr>
      
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30"><input name="submitButton" type="submit" class="frmButton" id="submitButton" value="Change Account PIN" /></td>
      </tr>
	</table>
</form>
  
<script type="text/javascript">
<!--
var spry_pin = new Spry.Widget.ValidationTextField("sprytf_pin", 'integer', {minChars:4, maxChars: 6, validateOn:["blur", "change"]});
//Confirm Password
var spry_cpin = new Spry.Widget.ValidationConfirm("sprytf_cpin", "sprytf_pin", {minChars:4, maxChars: 6, validateOn:["blur", "change"]});
//-->
</script>