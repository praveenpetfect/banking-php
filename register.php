<?php
require_once './library/config.php';
require_once './library/functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
	$result = doRegister();
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

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/confirmvalidation/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/confirmvalidation/SpryValidationConfirm.js" type="text/javascript"></script>

</head>

<body style="background-color:#ECECEC;margin-top:50px;">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
 <tr style="background-color:#FFFFFF"> 
  <td><img src="<?php echo WEB_ROOT; ?>images/OnlineBanking-logo.png"/></td>
 </tr>
 <tr> 
  <td valign="top"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="20">
    <tr> 
     <td class="contentArea">
		<form action="aregister.php" method="post" enctype="multipart/form-data" id="acclogin">
      	<h2 align="center"><strong>Register Account: </strong></h2>
      	<p align="center">Please register your account with us to take the benefits of our Online Banking facelities.</p>
	  	<div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
	  
       <table width="550" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#336699" class="entryTable">
        
        <tr> 
         <td class="contentArea"> 
		 
		 <table width="550" border="0" cellspacing="0" cellpadding="5" class="entryTable">
          <tr id="entryTableHeader">
            <th colspan="2">Personal Information</th>
          </tr>
          <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>First Name</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_firstname">
            <input name="firstname" type="text" class="frmInputs" id="accno" size="40" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Firstname is required.</span>
			<span class="textfieldMinCharsMsg">Firstname must specify at least 6 characters.</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Last Name</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_lastname">
            <input name="lastname" type="text" class="frmInputs" id="accno" size="40" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Lastname is required.</span>
			<span class="textfieldMinCharsMsg">Lastname must specify at least 6 characters.</span>
			</span>
			</td>
		  </tr>
		  
          <tr>
            <td height="30" class="label"><label for="pass"><strong>Password</strong></label></td>
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
            <td height="30" class="label"><label for="pass"><strong>Confirm Password</strong></label></td>
            <td height="30" class="content">
			<span id="sprycpwd"> 
              <input name="cpassword" type="password" class="frmInputs" id="pass" size="30" /><br />
              <span class="confirmRequiredMsg">Confirm Password is required.</span>
			  <span class="confirmInvalidMsg">Confirm Password values don't match</span>
			</span>
			</td>
          </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Email  ID</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_email">
            <input name="email" type="text" class="frmInputs" id="accno" size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Email ID is required.</span>
			<span class="textfieldInvalidFormatMsg">Please enter a valid email (user@domain.com).</span>
			</span>
			</td>
		  </tr>
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Phone Number</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_phone">
            <input name="phone" type="text" class="frmInputs" id="accno" size="20" maxlength="30" /><small> ie (XXX) XXX-XXXX</small>
            <br/>
            <span class="textfieldRequiredMsg">Phone Number is required.</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Date of Birth</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_dob">
            <input name="dob" type="text" class="frmInputs" id="accno"  size="20" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Date of Birth is required.</span>
			<span class="textfieldInvalidFormatMsg">Please enter a valid date (mm-dd-yyyy).</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Profile Pics</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_lastname">
            <input name="pic" type="file" class="frmInputs"  size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Lastname is required.</span>			
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Gender</strong></label></td>
            <td height="30" class="content">
			<span id="spryselect_gender">
			  <select name="gender" id="gender">
					<option value="">Please select your gender</option>
					<option value="Male">Male</option>
					<option value="Felame">Female</option>
			  </select>
			 <br/>
			 <span class="selectRequiredMsg">Please select your gender.</span>
			</span>
			</td>
		  </tr>
		  
		  
		  
		  <!-- Address Info -->
		  <tr id="entryTableHeader">
            <th scope="col" colspan="2">Address Information</th>
          </tr>
          
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Address</strong></label></td>
            <td height="30" class="content">
			<span id="spryta_address">
				<textarea name="address" id="textarea1" cols="35" rows="2"></textarea>
  			<br/>
            <span class="textareaRequiredMsg">Address is required.</span>
			<span class="textareaMinCharsMsg">Address must specify at least 10 characters.</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>City Name</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_city">
            <input name="city" type="text" class="frmInputs" id="accno" size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">City Name is required.</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>State</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_state">
            <input name="state" type="text" class="frmInputs" id="accno"  size="30" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">State name is required.</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Zip Code</strong></label></td>
            <td height="30" class="content">
			<span id="sprytf_zip">
            <input name="zipcode" type="text" class="frmInputs" id="accno" size="15" maxlength="30" />
            <br/>
            <span class="textfieldRequiredMsg">Zip Code is required.</span>
			</span>
			</td>
		  </tr>
		  
		  
		  <!-- Account Information Info -->
		  <tr id="entryTableHeader">
            <th colspan="2">Bank Account Information</th>
          </tr>
          
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Account Type</strong></label></td>
            <td height="30" class="content">
			<span id="spryselect_acctype">
			  <select name="acctype" id="acctype">
					<option value="">Please select Account Type</option>
					<!--<option value="CA">Checking Account</option>-->
					<option value="SA">Saving Account</option>
					<option value="FDA">Fixed deposit Account</option>
			  </select>
			 <br/>
			 <span class="selectRequiredMsg">Please select Account Type.</span>
			</span>
			</td>
		  </tr>
		  
		  <tr>
            <td width="120" height="30" class="label"><label for="accno"><strong>Account Pin </strong></label></td>
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
            <td width="120" height="30" class="label"><label for="accno"><strong>Verify Pin Number</strong></label></td>
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
            <td width="120" height="30" class="label">&nbsp;</td>
            <td height="30" class="content">
			If your are already register with us, please <a href="<?php echo WEB_ROOT; ?>login.php">Login Now</a>.
			</td>
          </tr>
          <tr>
            <td width="120" height="30">&nbsp;</td>
            <td height="30">
			<input name="submitButton" type="submit" class="frmButton" id="submitButton" value="Register Account!" />
		</td>
          </tr>
        </table>
		 
		  </td>
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
<script type="text/javascript">
<!--
//Firstname
var sprytf_firstname = new Spry.Widget.ValidationTextField("sprytf_firstname", 'none', {validateOn:["blur", "change"]});
//Lastname
var sprytf_lastname = new Spry.Widget.ValidationTextField("sprytf_lastname", 'none', {validateOn:["blur", "change"]});
//Password
var sprypass1 = new Spry.Widget.ValidationPassword("sprypwd", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});
//Confirm Password
var spryconf1 = new Spry.Widget.ValidationConfirm("sprycpwd", "sprypwd", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});
//Email ID
var spryemail = new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
//Phone Number
var spryphone = new Spry.Widget.ValidationTextField("sprytf_phone", 'phone_number', {useCharacterMasking: true, validateOn:["blur", "change"]});
//Date of Birth
var sprydob = new Spry.Widget.ValidationTextField("sprytf_dob", 'date', {format:"mm-dd-yyyy", useCharacterMasking: true, validateOn:["blur", "change"]});
//Gender
var sprygender = new Spry.Widget.ValidationSelect("spryselect_gender");


//address
var spry_ad = new Spry.Widget.ValidationTextarea("spryta_address", {isRequired:true});
//city
var sprytf_city = new Spry.Widget.ValidationTextField("sprytf_city", 'none', {validateOn:["blur", "change"]});
//State
var sprytf_state = new Spry.Widget.ValidationTextField("sprytf_state", 'none', {validateOn:["blur", "change"]});
//ZipCode
var sprytf_zip = new Spry.Widget.ValidationTextField("sprytf_zip", 'integer', {validateOn:["blur", "change"]});

//Account Type
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect_acctype");
//Account Number
var spry_accno = new Spry.Widget.ValidationTextField("sprytf_accno", 'integer', {minChars:8, maxChars: 12, validateOn:["blur", "change"]});

var spry_pin = new Spry.Widget.ValidationTextField("sprytf_pin", 'integer', {minChars:4, maxChars: 6, validateOn:["blur", "change"]});
//Confirm Password
var spry_cpin = new Spry.Widget.ValidationConfirm("sprytf_cpin", "sprytf_pin", {minChars:4, maxChars: 6, validateOn:["blur", "change"]});

//-->
</script>
</html>