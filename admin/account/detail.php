<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['accId']) && $_GET['accId'] > 0) {
	$accId = $_GET['accId'];
} else {
	header('Location: index.php');
}

$sql = "SELECT u.id, u.fname, u.lname, u.bdate, u.is_active, u.email, u.phone, u.pics,
		a.acc_no, a.type, a.balance,
		ad.address, ad.city, ad.state, ad.zipcode
        FROM tbl_users u, tbl_accounts a, tbl_address ad
		WHERE u.id = a.user_id AND ad.user_id = u.id
		AND a.id = $accId";
		
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
$row = mysql_fetch_assoc($result);
extract($row);
$atype = "";
if($type == "CA"){$atype = "Checking Account";}
else if($type == "SA") {$atype = "Saving Account";}
else if($type == "FDA") {$atype = "Fixed deposit Account";}
?>
<p align="center" id="mainHead">User Details</p>
<form action="process.php?action=transaction" method="post" id="frmTransaction">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Account Holder Name</td>
   <td class="content"> <?php echo strtoupper( $fname. ' '. $lname); ?>&nbsp;<br/><br/>
   Email:&nbsp;<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
   &nbsp;[&nbsp;<a href="<?php echo WEB_ROOT; ?>admin/user/?view=email&userId=<?php echo $id; ?>">Edit Email</a>&nbsp;]<br/><br/>
   	Phone:&nbsp;<?php echo $phone; ?></td>
   <td rowspan="3" class="content">
   <?php
   $upics = (isset($pics) && $pics != "") ? "thumbnails/".$pics : "anonymous-user.jpg"; 
   ?>
   	<img src="<?php echo WEB_ROOT; ?>images/<?php echo $upics; ?>" style="float:right;" width="180" height="180" />
   </td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Address</td>
   <td class="content"><?php echo $address; ?><br/> 
   	<?php echo $city; ?><br/>
	<?php echo $zipcode; ?>&nbsp;<?php echo $state; ?>   </td>
   </tr>
  
  <tr> 
   <td width="150" class="label">Account Number</td>
   <td class="content"><strong><?php echo $acc_no; ?></strong>&nbsp;&nbsp;(<?php echo $atype; ?>)
   	<input type="hidden" name="user_id" value="<?php echo $id; ?>" />
	<input type="hidden" name="acc_no" value="<?php echo $acc_no; ?>" />
   </td>
   </tr>
  
  <tr> 
   <td width="150" class="label">Current Balance</td>
   <td colspan="2" class="content">Balance:&nbsp;&nbsp;<?php echo $balance; ?></td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Transaction History</td>
   <td colspan="2" class="content">
   	<a href="<?php echo WEB_ROOT; ?>admin/account/?view=statement&accNo=<?php echo $acc_no; ?>">View Transaction History</a>
	</td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Transaction Type</td>
   <td colspan="2" class="content">
   <select name="type" id="type">
   	<option value="#"> -- select transaction type --</option>
	<option value="credit">Credit Fund</option>
	<option value="debit">Debit Fund</option>
   </select>
   </td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Amount</td>
   <td colspan="2" class="content"><input type="text" name="amt" id="amt" size="10" /> </td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Date of Transfer</td>
   <td colspan="2" class="content"><input type="text" name="dot" id="dot" size="20" />&nbsp; (Format: mm/dd/yyyy)</td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Transfer Description</td>
   <td colspan="2" class="content"><textarea name="desc" id="desc" cols="35" rows="2"></textarea></td>
  </tr>
  
 </table>
 <p align="center"> 
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Back " onClick="window.history.back();" >
  &nbsp;&nbsp;
  <input name="btnTxType" type="button" id="btnTxType" value=" Proceed Transaction ">
 </p>
</form>
<script language="javascript">
$(document).ready(function(){
	
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
	
	var isDate = function(txtDate) {
		var currVal = txtDate;
		if(currVal == '') return false;	
		var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
		var dtArray = currVal.match(rxDatePattern); // is format OK?
		if (dtArray == null) return false;
		//Checks for mm/dd/yyyy format.
		dtMonth = dtArray[1];
		dtDay= dtArray[3];
		dtYear = dtArray[5];        
	
		if (dtMonth < 1 || dtMonth > 12) return false;
		else if (dtDay < 1 || dtDay> 31) return false;
		else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31) 
			return false;
		else if (dtMonth == 2) 
		{
			var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
			if (dtDay> 29 || (dtDay ==29 && !isleap)) return false;
		}
		return true;
	};
	
	$('#amt').keyup(function(e){
		$(this).val(format($(this).val()));
	});
	
	$('#btnTxType').click(function() {
		var ttype = $("#type").val();
		if(ttype == '#') {
			alert('Select Transaction Type');
			$("#type").focus();
			return false;
		}
		var amt = $("#amt").val();
		if(amt == '') {
			alert('Please insert transaction amount.');
			$("#amt").focus();
			return;
		}
		/*
		if($.isNaN(amt)) {
			alert('Invalid amount. Please insert amount as integer.');
			$("#amt").focus();
			return;
		}
		*/
		
		var dot = $("#dot").val();
		if(dot == '') {
			alert('Please insert Date of Transaction.');
			$("#dot").focus();
			return;
		}
		if(!isDate(dot)) {
			alert('Invalid Date.');
			$("#dot").focus();
			return;
		}
		var desc = $("#desc").val();
		if(desc == '') {
			alert('Please insert transaction description.');
			$("#desc").focus();
			return;
		}
		$('#frmTransaction').submit();
	});

});//ready

</script>