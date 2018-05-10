<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$errorMessage = (isset($_GET['msg']) && $_GET['msg'] != '') ? $_GET['msg'] : '&nbsp;';

$sql = "SELECT u.id, u.fname, u.lname, a.acc_no, a.balance, a.status, a.bdate, a.type, a.id AS acc_id
        FROM tbl_users u, tbl_accounts a
		WHERE u.id = a.user_id
		ORDER BY id DESC LIMIT 20";
$result = dbQuery($sql);

?> 
<p align="center" id="mainHead">Account Details List</p>
<p style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px; margin-bottom:10px;">
View account details, credit, debit funds from the acount or activate, de-activate them.</p>
<div id="errorCls" style="color:#FF0000 !important;font-size:14px;font-weight:bold;"><?php echo $errorMessage; ?></div>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>User Name</td>
   <td>Account No.</td>
   <td>Balance</td>
   <td width="120">Account Type</td>
   <td width="80">Account status</td>
   <td width="70">Statement</td>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	$i += 1;
	
	$atype = "";
	if($type == "CA"){$atype = "Checking Account";}
	else if($type == "SA") {$atype = "Saving Account";}
	else if($type == "FDA") {$atype = "Fixed deposit Account";}
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $fname .' '.$lname; ?></td>
   <td><div align="center"><a href="<?php echo WEB_ROOT; ?>admin/account/?view=detail&accId=<?php echo $acc_id; ?>"><?php echo $acc_no; ?></a></div></td>
   <td><div align="center">&nbsp;<?php echo $balance; ?></div></td>
   <td width="120" align="center"><?php echo $atype; ?></td>
   <td width="80" align="center">
   	<a href="javascript:changeAccStatus(<?php echo $acc_id; ?>, '<?php echo $status; ?>');">
   	<?php echo $status == 'INACTIVE'? 'Inactive' : 'Active'; ?>
	</td>
   <td width="70" align="center"><a href="javascript:viewAccountStatement(<?php echo $id; ?>, <?php echo $acc_no; ?>);">Statement</a></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
