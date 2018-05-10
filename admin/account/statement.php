<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['accNo']) && $_GET['accNo'] > 0) {
	$acc_no = $_GET['accNo'];
} else {
	header('Location: index.php');
}

$sql = "SELECT * FROM tbl_transaction WHERE to_accno = $acc_no ORDER BY id DESC LIMIT 20";
$result = dbQuery($sql);

?> 
<p align="center" id="mainHead">Account Statement</p>
<p style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px; margin-bottom:40px;">
View list of all credit/ debit / fund transfer transaction summary by this user.</p>

<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th width="80" scope="col">Transaction Date</th>
   <th width="80">Refrence No#</th>
   <th width="250">Description</th>
   <th width="60">Debit</th>
   <th width="60">Credit</th>
   <th width="80">Status</th>
  </tr>
<?php
if(dbNumRows($result) > 0) {
while($row = dbFetchAssoc($result)) {
	extract($row);
	if ($i%2) {$class = 'row1';}
	else {$class = 'row2';}
	$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $date; ?></td>
   <td><div align="center"><?php echo $tx_no; ?></div></td>
   <td width="250"><?php echo $description; ?></td>
   <td width="50" align="center"><?php echo $tx_type == "debit" ? "&nbsp;" . number_format($amount, 2) : ""; ?></td>
   <td width="50" align="center"><?php echo $tx_type == "credit" ? "&nbsp;" . number_format($amount, 2) : ""; ?></td>
   <td width="80" align="center"><?php echo $status; ?></td>
  </tr>
<?php
}// end while
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"></td>
  </tr>
<?php 
}//
else {
?> 
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right">No Transaction / Fund transfer done.</td>
  </tr>
<?php 
}//else
?>
 </table>
 <p>&nbsp;</p>
