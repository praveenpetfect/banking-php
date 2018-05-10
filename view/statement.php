<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$user = $_SESSION['hlbank_user'];
$acc_no = $user['acc_no'];
if (!isset($acc_no) && $acc_no <= 0) {
	header('Location: index.php');
}

$sql = "SELECT * FROM tbl_transaction WHERE to_accno = $acc_no 
		ORDER BY id DESC LIMIT 20";
$result = dbQuery($sql);

?> 
<strong>Account Statement</strong>
<p>View list of all credit/ debit / fund transfer transaction summary by this user.</p>

<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th width="80" scope="col">Transaction Date</th>
   <th width="80">Refrence No#</th>
   <th width="250">Description</th>
   <th width="60">Debit</th>
   <th width="60">Credit</th>
  </tr>
<?php

if(dbAffectedRows($result) > 0) { //if
$i = 0;
while($row = dbFetchAssoc($result)) {
	extract($row);
	if ($i%2) {$class = 'row1';} 
	else {$class = 'row2';}
	$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $date; ?></td>
   <td><div align="center"><?php echo $tx_no; ?></div></td>
   <td width="250" align="center"><?php echo $description; ?></td>
   <td width="50" align="center"><?php echo $tx_type == "debit" ? "&nbsp;" . number_format($amount, 2) : ""; ?></td>
   <td width="50" align="center"><?php echo $tx_type == "credit" ? "&nbsp;" . number_format($amount, 2) : ""; ?></td>
  </tr> 
<?php
} // end while
}//if
else {
?>
  <tr> 
   <td colspan="6" align="right">You have no transaction history yet, seems that you haven't done any transaction yet.</td>
  </tr>
<?php 
}//else
	$user_id = $_SESSION['hlbank_user']['user_id'];
	$acc_no = $_SESSION['hlbank_user']['acc_no'];
	  
	$balance_sql = "SELECT balance FROM tbl_accounts WHERE user_id = $user_id AND acc_no = $acc_no";
	$result = dbQuery($balance_sql);
	$row = dbFetchAssoc($result);
?>
</table>
<p>&nbsp;</p>
<strong style="font-size:15px;">Available Credit Balance: &nbsp;  &nbsp; <?php echo number_format($row['balance'], 2); ?></strong>