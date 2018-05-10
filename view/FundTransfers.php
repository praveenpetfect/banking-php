<?php 
$errorMessage = (isset($_GET['msg']) && $_GET['msg'] != '') ? $_GET['msg'] : '&nbsp;';
$msgMessage = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '&nbsp;';
?>
<h2>Funds Transfer</h2>
<p>Funds transfer is a process of transfering funds from your account to other account in same Bank.<br/>Please make sure that you have enough funds available in your account to transfer. Also don't forgot to validate receiver's account number.</p>

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<script src="<?php echo WEB_ROOT; ?>admin/library/jquery.min.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<div id="errorCls" style="color:#FF0000 !important;font-size:14px;font-weight:bold;"><?php echo $errorMessage; ?></div>
<div style="color:#99FF00 !important;font-size:14px;font-weight:bold;"><?php echo $msgMessage; ?></div>

<form action="<?php echo WEB_ROOT; ?>view/process.php?action=transfer" method="post" >
    <table width="550" border="0" cellpadding="5" cellspacing="1" class="entryTable">
      <tr id="listTableHeader">
        <th  colspan="2" >Transfer Funds</th>
      </tr>
      <tr>
        <td width="200" height="30" class="label"><strong>Receiver's Bank Name</strong></td>
        <td height="30" class="content">		
		<span id="sprytf_rbname">
            <input name="rbname" type="text" size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Receiver's Bank Name is required.</span>
			<span class="textfieldMinCharsMsg">Receiver's Bank Name must specify at least 6 characters.</span>
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="200" height="30" class="label"><strong>Receiver's Name</strong></td>
        <td height="30" class="content">		
		<span id="sprytf_rname">
            <input name="rname" type="text" size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Receiver's Name is required.</span>
			<span class="textfieldMinCharsMsg">Receiver's Name must specify at least 6 characters.</span>
		</span>
		</td>
      </tr>
	  <tr>
        <td width="200" height="30" class="label"><strong>Receiver's Account Number</strong></td>
        <td height="30" class="content">
        <span id="sprytf_accno">
            <input name="accno" type="text" id="accno" size="20" maxlength="20" />
            <br/>
            <span class="textfieldRequiredMsg">Account Number is required.</span>
			<span class="textfieldMinCharsMsg">Account Number must specify at least 10 characters.</span>
			<span class="textfieldMaxCharsMsg">Account Number must specify at max 10 characters.</span>
			<span class="textfieldInvalidFormatMsg">Account Number must be Integer.</span>
		</span>
		</td>
      </tr>	  
	  
	  <tr>
        <td width="200" height="30" class="label"><strong>SWIFT/ABA Routing Number</strong></td>
        <td height="30" class="content">		
		<span id="sprytf_swift">
            <input name="swift" type="text" size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">SWIFT/ABA Routing Number is required.</span>
			<span class="textfieldMinCharsMsg">SWIFT/ABA Routing Number specify at least 8 characters.</span>
			<span class="textfieldMaxCharsMsg">SWIFT/ABA Routing Number must specify at max 12 characters.</span>
			<span class="textfieldInvalidFormatMsg">SWIFT/ABA Routing Number must be Integer.</span>
		</span>
		</td>
      </tr>

      <tr>
        <td width="200" height="30" class="label"><strong>Sender's Account Number</strong></td>
        <td height="30" class="content">
          <input name="saccno" type="text" readonly="true"  id="saccno" 
		  	value="<?php echo $_SESSION['hlbank_user']['acc_no'] ?>" size="20"/>
		</td>
      </tr>
      
	  <tr>
        <td width="200" height="30" class="label"><strong>Amount to Transfer </strong></td>
        <td height="30" class="content">
		<span id="sprytf_amt">
            <input name="amt" id="amt" type="text"  size="20" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Ammount is required.</span>
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="200" height="30" class="label"><strong>Fund Transfer Option</strong></td>
        <td height="30" class="content">
		<span id="spryselect_opt">
			<select name="toption" id="toption">
				<option value="">-- Please select your option --</option>
				<option value="DT">Domestic Transfer</option>
				<option value="LT">Local Transfer</option>
				<option value="IT">International Transfer</option>
			</select>
			<br/>
			<span class="selectRequiredMsg">Please select fund transfer option.</span>
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="200" height="30" class="label"><strong>Date of Transfer</strong></td>
        <td height="30" class="content">
		<span id="sprytf_dot">
            <input type="text" name="dot" id="dot" size="20" />
            <br/>
            <span class="textfieldRequiredMsg">Date of Transfer is required.</span>
			<span class="textfieldInvalidFormatMsg">Invalid date format.</span>
		</span>
		</td>
      </tr>
	  
	  <tr>
        <td width="200" height="30" class="label"><strong>Transfer Description</strong></td>
        <td height="30" class="content">
		<span id="sprytf_desc">
            <textarea name="desc" id="desc" cols="35" rows="2"></textarea>
            <br/>
            <span class="textareaRequiredMsg">Description is required.</span>
			<span class="textareaMinCharsMsg">Description must specify at least 10 characters.</span>
		</span>
		</td>
      </tr>
	  
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30"><input name="submitButton" type="submit" id="submitButton" value="Fund Transfers" /></td>
      </tr>
	</table>
</form>
  
<script type="text/javascript">
<!--
var sprytf_rbname = new Spry.Widget.ValidationTextField("sprytf_rbname", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_rname = new Spry.Widget.ValidationTextField("sprytf_rname", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_accno = new Spry.Widget.ValidationTextField("sprytf_accno", 'integer', {minChars:10, maxChars: 10, validateOn:["blur", "change"]});
var sprytf_swift = new Spry.Widget.ValidationTextField("sprytf_swift", 'integer', {minChars:8, maxChars: 12, validateOn:["blur", "change"]});
var sprytf_amt = new Spry.Widget.ValidationTextField("sprytf_amt", "none", {validateOn:["blur", "change"]});

var sprytf_opt = new Spry.Widget.ValidationSelect("spryselect_opt");

var sprytf_dot = new Spry.Widget.ValidationTextField("sprytf_dot", "date", {format:"mm-dd-yyyy", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_desc = new Spry.Widget.ValidationTextarea("sprytf_desc", {isRequired:true, validateOn:["blur", "change"]});
//-->
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#amt').keyup(function(e){
		$(this).val(format($(this).val()));
    });
	var format = function(num){
		var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
		if(str.indexOf(".") > 0) {
			parts = str.split(".");
			str = parts[0];
		}
		str = str.split("").reverse();
		for(var j = 0, len = str.length; j < len; j++) {
			if(str[j] != ",") {
				output.push(str[j]);
				if(i%3 == 0 && j < (len - 1)) {
					output.push(",");
				}
				i++;
			}
		}
		formatted = output.reverse().join("");
		return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};

});//ready
</script>