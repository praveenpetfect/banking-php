<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkAdmin();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
			
	case 'status' :
		modifyStatus();
		break;
		
	case 'deleteImage' :
		deleteImage();
		break;
    
	case 'transaction' :
		transaction();
		break;
	
	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}

function modifyStatus()
{
	$id		= (int)$_GET['accId'];	
    $nst	= $_GET['nst'];
    $status = $nst == 'Activate' ? 'ACTIVE' : 'INACTIVE';
	
	$sql	= "UPDATE tbl_accounts SET status = '$status' WHERE id = $id";  
	$result = dbQuery($sql);
	header('Location: index.php');			  
}

function transaction()
{
	$id		= $_POST['user_id'];	
    $acc_no	= $_POST['acc_no'];
    $type 	= $_POST['type'];
	$amt	= str_number($_POST['amt']);
	$cmt 	= $_POST['desc'];
	$dot 	= $_POST['dot'];
	
	$sql	= "SELECT balance FROM tbl_accounts WHERE user_id = $id AND acc_no = $acc_no AND status = 'ACTIVE'";  
	$result = dbQuery($sql);
	if (dbNumRows($result) == 1) {
		extract(dbFetchAssoc($result));
		if($type == "debit") {
			//check if amt is more then $balance
			if($balance < $amt) {
				header('Location: index.php?msg=' . urlencode('Account balance is less, fail to transfer fund.'));
				exit;
			}
		}
		$total = $type == "credit" ? ($balance + $amt) : ($balance - $amt);
		if($total <= 0) {
			//return here...
		}
		$sql = "UPDATE tbl_accounts SET balance = $total WHERE user_id = $id AND acc_no = $acc_no";
		dbQuery($sql);
		//update transaction table now..
		$tx_no = next_tx_no();
		//$desc = sprintf("%s $%u by %s on %s", $type, $amt, 'Admin', date('M-d-Y'));
		$desc = sprintf("Fund transfer of %u to Account %u Reference# %s", $amt, $acc_no, $tx_no);
		$sql = "INSERT INTO tbl_transaction (tx_no, tx_type, amount, date, description, to_accno, status, tdate, comments) 
				VALUES ('$tx_no', '$type', $amt, NOW(), '$desc', '$acc_no', 'SUCCESS', '$dot', '$cmt')";
		dbQuery($sql);
		//email details...
		header('Location: index.php');
	}
	else {
		header('Location: index.php?msg=' . urlencode('Account number not active. You can not proceed fund transfer with a inactive account.'));
		exit;
	}
}

?>