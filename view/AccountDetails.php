<h2>User Account Details</h2>
<p>If you feel that you have a weaker strengh password, then please change it. We recommend to change your password in every 45 days to make it secure.</p>

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<form action="<?php echo WEB_ROOT; ?>view/process.php?action=transfer" method="post">
    <table width="550" border="0" cellpadding="5" cellspacing="1" class="entryTable">
      <tr id="listTableHeader">
        <th colspan="2">User Account Details</th>
      </tr>
      <tr>
        <td width="180" height="30" class="label"><strong>User Fullname </strong></td>
        <td height="30" class="content">		
		<span id="sprytf_rbname">
            <input name="rbname" type="text" class="frmInputs" id="accno" size="30" maxlength="30" disabled="disabled"
				value="<?php echo $_SESSION['hlbank_user_name'];  ?>" />
            <br/>
            <span class="textfieldRequiredMsg">Receiver's Bank Name is required.</span>
			<span class="textfieldMinCharsMsg">Receiver's Bank Name must specify at least 6 characters.</span>		
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="180" height="30" class="label"><strong>Email ID </strong></td>
        <td height="30" class="content">		
		<span id="sprytf_rname">
            <input name="rname" type="text" class="frmInputs" id="accno" size="30" maxlength="30" 
				value="<?php echo $_SESSION['hlbank_user']['email']; ?>" disabled="disabled"/>
            <br/>
            <span class="textfieldRequiredMsg">Receiver's Name is required.</span>
			<span class="textfieldMinCharsMsg">Receiver's Name must specify at least 6 characters.</span>		</span>		</td>
      </tr>
	  
	  <tr>
        <td width="180" height="30" class="label"><strong>Phone Number</strong></td>
        <td height="30" class="content">		
            <input name="rname" type="text" class="frmInputs" id="accno" size="20" maxlength="30" 
				value="<?php echo $_SESSION['hlbank_user']['phone']; ?>" disabled="disabled"/>
        </td>
      </tr>
	  
	  <tr>
        <td width="180" height="30" class="label"><strong>Address</strong></td>
        <td height="30" class="content">
        <span id="sprytf_accno">
            <textarea name="address" id="textarea1" cols="35" rows="2" disabled="disabled"><?php echo $_SESSION['hlbank_user']['address']; ?></textarea>
            <br/>
            <span class="textfieldRequiredMsg">Account Number is required.</span>
			<span class="textfieldMinCharsMsg">Account Number must specify at least 8 characters.</span>
			<span class="textfieldMaxCharsMsg">Account Number must specify at max 12 characters.</span>
			<span class="textfieldInvalidFormatMsg">Account Number must be Integer.</span>		</span>		</td>
      </tr>	  
	  
	  <tr>
        <td width="180" height="30" class="label"><strong>City, State </strong></td>
        <td height="30" class="content">		
		<span id="sprytf_swift">
            <input name="swift" type="text" class="frmInputs" id="accno" size="30" maxlength="30" 
				value="<?php echo $_SESSION['hlbank_user']['city']. ', '.$_SESSION['hlbank_user']['state'] ?>" disabled="disabled" />
            <br/>
            <span class="textfieldRequiredMsg">SWIFT Routing Number is required.</span>
			<span class="textfieldMinCharsMsg">SWIFT Routing Number specify at least 8 characters.</span>
			<span class="textfieldMaxCharsMsg">SWIFT Routing Number must specify at max 12 characters.</span>
		</span>
		</td>
      </tr>

	  <tr>
        <td width="180" height="30" class="label"><strong>Zip Code </strong></td>
        <td height="30" class="content">		
		<span id="sprytf_swift">
            <input name="swift" type="text" class="frmInputs" id="accno" size="20" maxlength="30" 
				value="<?php echo $_SESSION['hlbank_user']['zipcode']; ?>" disabled="disabled" />
            <br/>
            <span class="textfieldRequiredMsg">SWIFT Routing Number is required.</span>
			<span class="textfieldMinCharsMsg">SWIFT Routing Number specify at least 8 characters.</span>
			<span class="textfieldMaxCharsMsg">SWIFT Routing Number must specify at max 12 characters.</span>
		</span>
		</td>
      </tr>
	  
      <tr>
        <td width="180" height="30" class="label"><strong>Account Number</strong></td>
        <td height="30" class="content">
          <input type="text" class="frmInputs" size="30" value="<?php echo $_SESSION['hlbank_user']['acc_no'] ?>" disabled="disabled"/></td>
      </tr>
	  
	  <?php 
	  $user_id = $_SESSION['hlbank_user']['user_id'];
	  $acc_no = $_SESSION['hlbank_user']['acc_no'];
	  
	  $balance_sql = "SELECT balance FROM tbl_accounts WHERE user_id = $user_id AND acc_no = $acc_no";
	  $result = dbQuery($balance_sql);
	  $row = dbFetchAssoc($result);
	  ?>
	  <tr>
        <td width="180" height="30" class="label"><strong>Account Balance</strong></td>
        <td height="30" class="content">
          <input type="text" class="frmInputs" size="10" value="<?php echo number_format($row['balance']); ?>" disabled="disabled"/>&nbsp;
		</td>
      </tr>
	  
	  <tr>
        <td width="180" height="30" class="label"><strong>Account PIN Code </strong></td>
        <td height="30" class="content">
          <input type="text" class="frmInputs" size="10" value="<?php echo $_SESSION['hlbank_user']['pin'] ?>" disabled="disabled"/></td>
      </tr>
	  
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30">
		<!--
		<input name="submitButton" type="submit" class="frmButton" id="submitButton" value="Fund Transfers" />
		-->		</td>
      </tr>
    </table>
  </form>
  
<script type="text/javascript">
<!--
var sprytf_rbname = new Spry.Widget.ValidationTextField("sprytf_rbname", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_rname = new Spry.Widget.ValidationTextField("sprytf_rname", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_accno = new Spry.Widget.ValidationTextField("sprytf_accno", 'integer', {minChars:8, maxChars: 12, validateOn:["blur", "change"]});
var sprytf_swift = new Spry.Widget.ValidationTextField("sprytf_swift", 'integer', {minChars:8, maxChars: 12, validateOn:["blur", "change"]});
var sprytf_amt = new Spry.Widget.ValidationTextField("sprytf_amt", 'integer', {validateOn:["blur", "change"]});
//-->
</script>