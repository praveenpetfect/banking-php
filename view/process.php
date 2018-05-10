<?php
require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../library/mail.php';

$_SESSION['hlbank_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'changepwd' :
		changePwd();
		break;
		
	case 'changepin' :
		changePin();
		break;   

	case 'transfer' :
		initiateTransferFunds();
		break;
	
	case 'token' :
		transferFunds();
		break;	
		
	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}

function changePwd()
{
    $pwd 	= $_POST['password'];
	$id		= $_POST['id'];
	
	$sql	= "UPDATE tbl_users SET pwd = PASSWORD('$pwd') WHERE id = $id";
	$result = dbQuery($sql);
	
	$subject = "Password change";
	$to = $_SESSION['hlbank_user']['email'];
	$mail_data = array('to' => $to, 'sub' => $subject, 'msg' => 'change_pwd', 'pwd' => $pwd);
	send_email($mail_data);
	
	header("Location: ../index.php");
	exit();	
}

function changePin()
{
    $pin 	= (int)$_POST['pin'];
	$id		= $_POST['id'];
	
	$sql	= "UPDATE tbl_accounts SET pin = $pin WHERE user_id = $id";
	$result = dbQuery($sql);
	
	$subject = "PIN Change";
	$to = $_SESSION['hlbank_user']['email'];
	$mail_data = array('to' => $to, 'sub' => $subject, 'msg' => 'change_pin', 'pin' => $pin);
	send_email($mail_data);
	
	header("Location: ../index.php");
	exit();
}

function initiateTransferFunds()
{
 	$acc_no 	= (int)$_POST['accno'];
	$sacc_no 	= (int)$_POST['saccno'];
	$rbname 	= $_POST['rbname'];
	$rname	 	= $_POST['rname'];
	$swift	 	= (int)$_POST['swift'];
	$amt	 	= $_POST['amt'];
	$comments	= $_POST['desc'];
	$date_of 	= $_POST['dot'];
	$toption 	= $_POST['toption'];
	
	$funds_data = array(
		'acc_no' 	=> $acc_no, 
		'sacc_no' 	=> $sacc_no,
		'rbname' 	=> $rbname, 
		'rname' 	=> $rname, 
		'swift' 	=> $swift, 
		'amt' 		=> str_number($amt),
		'comments' 	=> $comments,
		'date_of' 	=> $date_of,
		'toption' 	=> $toption
	);
	
	//check for account status...
	$user_id = $_SESSION['hlbank_user']['user_id'];	 
	$sql	= "SELECT * FROM tbl_accounts WHERE acc_no = $sacc_no AND user_id = $user_id";
	$results 	= dbQuery($sql);
	if(dbNumRows($results) > 0) {
		extract(dbFetchAssoc($results));
		if($status == 'INACTIVE') {
			$msg = 'This account is either not active for fund Transfer/Suspended or Dormant. Pls contact Customer Care for details.';
			header('Location: index.php?v=Transfer&msg=' . urlencode($msg));
			exit();
		}
	}
	
	//now setting the temp array into session so we can use it later...
	$_SESSION['funds_data'] = $funds_data;
	//generate and send token
	$token = rand(100000, 100000);
	$token = strlen($token) != 6 ? substr($token, 0, 6) : $token;
	$_SESSION['otp_token'] = $token;

	//email it now.	
	$subject = "Transaction Authorization Code";
	$to = $_SESSION['hlbank_user']['email'];
	$mail_data = array('to' => $to, 'sub' => $subject, 'msg' => 'otp', 'token' => $token);
	send_email($mail_data);
	header('Location: index.php?v=Token');
	exit();
}

function transferFunds() 
{
	$token = (int)$_POST['token'];
	$s_token = (int)$_SESSION['otp_token'];
	
	if($s_token == $token) {
		extract($_SESSION['funds_data']);
	}
	else {
		header('Location: index.php?v=Transfer&msg=' . urlencode('Transaction Authorization Code in not valid.'));
		exit();
	}
	
	//next transaction number
	$tx_no = next_tx_no();
	
	//check if lets a Local transfer
	if($toption != "LT") {
		//debit from sender,
		//update transaction table,
		//send email and show details to user.
		$s_sql		= "SELECT acc_no, user_id, balance FROM tbl_accounts WHERE acc_no = $sacc_no";
		$s_result 	= dbQuery($s_sql);
		$s_acc 		= dbFetchAssoc($s_result);
		//check if senders balance is not enough
		$s_bal 		= $s_acc['balance']; 
		$s_uid 		= $s_acc['user_id']; 
		$s_accno 	= $s_acc['acc_no'];
		$d_total 	= ($s_bal - $amt);
		if($s_bal < $amt) {
			header('Location: index.php?v=Transfer&msg=' . urlencode('You do not have enough balance to proceed with this transfer.'));
			exit();	
		}
		//update sender's account balance
		$sql_sacc = "UPDATE tbl_accounts SET balance = $d_total WHERE user_id = $s_uid AND acc_no = $s_accno";
		dbQuery($sql_sacc);
		
		$desc = sprintf("Fund transfer of %u to Account %u Reference# %s", $amt, $acc_no, $tx_no);
		$sql = "INSERT INTO tbl_transaction (tx_no, tx_type, amount, date, description, to_accno, status, tdate, comments) 
				VALUES ('$tx_no', 'debit', $amt, NOW(), '$desc', '$sacc_no', 'SUCCESS', '$date_of', '$comments')";
		dbQuery($sql);
		
		//email details...
	//	funds_transfer_mail($amt, $sacc_no);
		$_SESSION['funds_data']['tx_no'] = $tx_no;
		header('Location: index.php?v=IntFund');
		exit();
	}
	
	//1) check receivers account is valid, or not.
	$sql	= "SELECT acc_no, user_id, balance FROM tbl_accounts WHERE acc_no = $acc_no AND status = 'ACTIVE'";
	$result = dbQuery($sql);
	if (dbNumRows($result) == 1) {
		$r_acc = dbFetchAssoc($result); // receivers account record
		
		//2) Now check if senders balance is available or not..
		$s_sql	= "SELECT acc_no, user_id, balance FROM tbl_accounts WHERE acc_no = $sacc_no";
		$s_result = dbQuery($s_sql);
		$s_acc = dbFetchAssoc($s_result);
		//check if senders balance is not enough
		$s_bal 	= $s_acc['balance']; 
		if($s_bal < $amt) {
			header('Location: index.php?v=Transfer&msg=' . urlencode('You do not have enough balance to proceed with this transfer.'));
			exit();
		}
		//3) credit in reveice's account and add transaction entry.
		$r_bal 	= $r_acc['balance'];
		$r_uid 	= $r_acc['user_id'];
		$r_accno = $r_acc['acc_no'];
		$total = ($r_bal + $amt);
		$sql_racc = "UPDATE tbl_accounts SET balance = $total WHERE user_id = $r_uid AND acc_no = $r_accno";
		dbQuery($sql_racc);
		
		$desc = sprintf("Fund transfer of %u from Account %u Reference# %s", $amt, $sacc_no, $tx_no);
		$sql = "INSERT INTO tbl_transaction (tx_no, tx_type, amount, date, description, to_accno, status, tdate, comments) 
				VALUES ('$tx_no', 'credit', $amt, NOW(), '$desc', '$r_accno', 'SUCCESS', '$date_of', '$comments')";
		dbQuery($sql);
		
		//4) debit from sender's account add transaction entry
		$s_uid 	= $s_acc['user_id']; 
		$s_accno = $s_acc['acc_no'];
		$d_total = ($s_bal - $amt);
		$sql_sacc = "UPDATE tbl_accounts SET balance = $d_total WHERE user_id = $s_uid AND acc_no = $s_accno";
		dbQuery($sql_sacc);
		
		//debit from sender's account and insert a log, send email
		$desc = sprintf("Fund transfer of %u to Account %u Reference# %s", $amt, $r_accno, $tx_no);
		$sender_sql = "INSERT INTO tbl_transaction (tx_no, tx_type, amount, date, description, to_accno, status, tdate, comments) 
				VALUES ('$tx_no', 'debit', $amt, NOW(), '$desc', '$s_accno', 'SUCCESS', '$date_of', '$comments')";
		dbQuery($sender_sql);
		
		funds_transfer_mail($amt, $sacc_no);
		
		//email details...
		header('Location: index.php?v=Transfer&success=' . urlencode('Fund transfer successful.'));	
		exit();
	}
	else {
		$msg = 'Receivers account number does not exist or not active. Please contact to custmer care.';
		header('Location: index.php?v=Transfer&msg=' . urlencode($msg));
		exit();	
	}
}

function funds_transfer_mail($amt, $sacc_no) {

	$subject = "Funds Transfer";
	$to = $_SESSION['hlbank_user']['email'];
	
	$msg_body = sprintf("Dear Customer,<br/><br/>
		This is to inform you that an amount of $ %u  has been debited from your Account No. %s on account of 
		Funds Transfer on %s using NIMMA Bank.<br/><br/>In case you need any further clarification for the same, 
		please do get in touch with your Home Branch.<br/><br/>
		Regards,<br/>Hong Leong Bank", 
		$amt, $sacc_no, date('M-d-Y')
	);
	
	$mail_data = array('to' => $to, 'sub' => $subject, 'msg' => 'transfer', 'body' => $msg_body);
	send_email($mail_data);
}

?>