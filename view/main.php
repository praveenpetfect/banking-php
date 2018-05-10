<strong style="color:#339900;font-size:16px;text-decoration:underline;">International Transaction Successful</strong>
<p>Please note we have initialte the international transaction successfully and it will tale 3, 4 working days to credit funds in receivers account.</p>
<p>An email has send to your accound with transaction details. We recomments you to kindly contant your fund receiver to validate after 3,4 working days.</p>

<strong style="color:#0000CC;font-size:16px;">Transaction Details</strong><br /><br />
<?php 
	$funds_data = $_SESSION['funds_data'];
	extract($funds_data);
	$acc_type = "";
	if($toption == "DT") { $acc_type = "Domestic Transfer";}
	else {$acc_type = "International Transfer";}
?>
<table width="550" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
	<tr>
    	<th width="260" scope="col">&nbsp;</th>
        <th scope="col">Transfer Funds Details</th>
	</tr>
	<tr>
    	<td width="260" height="30"><strong>Receviers Bank Name</strong></td>
        <td height="30"><?php echo $rbname; ?></td>
	</tr>
	<tr>
    	<td width="260" height="30"><strong>Receviers Name</strong></td>
        <td height="30"><?php echo $rname; ?></td>
	</tr>
	<tr>
    	<td width="260" height="30"><strong>Receviers Account Number</strong></td>
        <td height="30"><?php echo $acc_no; ?></td>
	</tr>
	<tr>
    	<td width="260" height="30"><strong>Fund Amount </strong></td>
        <td height="30"><?php echo $amt; ?></td>
	</tr>
	<tr>
    	<td width="260" height="30"><strong>Fund Transfer Type</strong></td>
        <td height="30"><?php echo $acc_type; ?></td>
	</tr>
	<tr>
    	<td width="260" height="30"><strong>Transaction Refrence No#</strong></td>
        <td height="30"><?php echo $_SESSION['funds_data']['tx_no']; ?></td>
	</tr>
</table>
