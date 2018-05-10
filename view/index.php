<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['hlbank_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['v']) && $_GET['v'] != '') ? $_GET['v'] : '';

switch ($view) {
	case 'Account' :
		$content 	= 'AccountDetails.php';		
		$pageTitle 	= 'View Account Details';
		break;
	
	case 'Summary' :
		$content 	= 'summary.php';		
		$pageTitle 	= 'Account Sumamry';
		break;	

	case 'ChangePwd' :
		$content 	= 'changepwd.php';		
		$pageTitle 	= 'Change Password ';
		break;

	case 'ChangePin' :
		$content 	= 'changepin.php';		
		$pageTitle 	= 'Change account Pin Number';
		break;

	case 'Transfer' :
		$content 	= 'FundTransfers.php';		
		$pageTitle 	= 'Fund Transfers';
		break;
	
	case 'Statement' :
		$content 	= 'statement.php';		
		$pageTitle 	= 'Account Statement';
		break;
		
	case 'Token' :
		$content 	= 'OTP.php';		
		$pageTitle 	= 'Transaction Authorization Code';
		break;		

	case 'IntFund' :
		$content 	= 'main.php';
		$pageTitle 	= 'International Transaction';
		break;
		
	default :
		$content 	= 'summary.php';		
		$pageTitle 	= 'Account Summary';
}

$script    = array('category.js');

require_once '../include/template.php';
?>
