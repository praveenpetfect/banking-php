<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkAdmin();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	
	case 'detail' :
		$content    = 'detail.php';
		$pageTitle  = 'View Account Detail';
	break;
	
	case 'statement' :
		$content    = 'statement.php';
		$pageTitle  = 'View Account statement';
	break;
	
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'View Account details';
}

$script    = array('user.js','jquery.min.js');
require_once '../include/template.php';
?>
