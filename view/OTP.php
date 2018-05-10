<?php 
$errorMessage = (isset($_GET['msg']) && $_GET['msg'] != '') ? $_GET['msg'] : '&nbsp;';
$msgMessage = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '&nbsp;';
?>
<h2>Transaction Authorization Code</h2>
<p>Funds transfer is a process of transfering funds from your account to other account in same Bank.<br/>Please make sure that you have enough funds available in your account to transfer. Also don't forgot to validate receiver's account number.</p>

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<span id="errorCls" style="color:#FF0000 !important;"><?php echo $errorMessage; ?></span>
<span style="color:#99FF00 !important;font-size:14px;"><?php echo $msgMessage; ?></span>

<p>The token code has been sent to your email : <span style="color:#0066CC;font-weight:bold;"><?php echo $_SESSION['hlbank_user']['email']; ?></span></p>
<p>You have <span id="defaultCountdown"></span> minutes remaining to insert valid OTP. System will automatically redirect to 'Fund Transfer' page to initiate fund transfer again.</p>

<form action="<?php echo WEB_ROOT; ?>view/process.php?action=token" method="post">
    <table width="550" border="0" cellpadding="5" cellspacing="1" class="entryTable">
       <tr id="listTableHeader">
        <th colspan="2">Transfer Funds</th>
      </tr>
      <tr>
        <td width="260" height="30" class="label"><strong>Transaction Authorization Code</strong></td>
        <td height="30" class="content">
		<span id="sprytf_token">
            <input name="token" id="token" type="text" class="frmInputs" size="15" maxlength="15" />
            <br/>
            <span class="textfieldRequiredMsg">Transaction Authorization Code is required.</span>
			<span class="textfieldInvalidFormatMsg">Transaction Authorization Code must be Integer.</span>
			<span class="textfieldMinCharsMsg">Transaction Authorization Code must specify at least 6 characters.</span>
			<span class="textfieldMaxCharsMsg">Transaction Authorization Code must specify at max 8 characters.</span>
		</span>
		</td>
      </tr>
	  
      <tr>
        <td height="30" colspan="2">
		<div align="center">
          <input name="submitButton" type="submit" class="frmButton" id="submitButton" value="Validate TAC" />
        </div></td>
      </tr>
	</table>
</form>
  
<script type="text/javascript">
<!--
var sprytf_token = new Spry.Widget.ValidationTextField("sprytf_token", 'integer', {minChars:6, maxChars: 8, validateOn:["blur", "change"]});
//-->
</script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.plugin.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.countdown.min.js"></script>
<script>
$(document).ready(function(){ 
	function timerdone(){
		var webRoot = '<?php echo WEB_ROOT; ?>'+'view/?v=Transfer';
		window.location.href = webRoot;
    }
    $('#defaultCountdown').countdown({
    	until: +60, 
        compact: true,
        onExpiry: timerdone,
        format: 'MS'
	});
})
</script>
<style>
#defaultCountdown {font-family:Verdana;font-size:18px;padding:0 5px ;color:#990000;border:1px solid #993300;background-color:#FFFFCC;}
</style>
