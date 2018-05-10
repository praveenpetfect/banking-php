<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkAdmin();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'add' :
		addUser();
		break;
		
	case 'status' :
		statusUser();
		break;
	
	case 'email' :
		modifyEmail();
		break;
			
	case 'delete' :
		deleteUser();
		break;    

	default :
	    // if action is not defined or unknown
		// move to main user page
		header('Location: index.php');
}


function addUser()
{
    $userName = $_POST['txtUserName'];
	$password = $_POST['txtPassword'];
	$admin = $_POST['txtSuperAdmin'];
	/*
	// the password must be at least 6 characters long and is 
	// a mix of alphabet & numbers
	if(strlen($password) < 6 || !preg_match('/[a-z]/i', $password) ||
	!preg_match('/[0-9]/', $password)) {
	  //bad password
	}
	*/	
	// check if the username is taken
	$sql = "SELECT name
	        FROM tbl_users
			WHERE name = '$userName'";
	$result = dbQuery($sql);
	
	if (dbNumRows($result) == 1) {
		header('Location: index.php?view=add&error=' . urlencode('Username already taken. Choose another one'));	
	} else {			
		$sql   = "INSERT INTO tbl_users (name, pwd, bdate, is_admin)
		          VALUES ('$userName', '$password', NOW(), '$admin')";
	
		dbQuery($sql);
		header('Location: index.php');	
	}
}

/*
	Modify a user
*/
function statusUser()
{
	$userId = (int)$_GET['userId'];	
	$nst 	= $_GET['nst'];
	
	$status = $nst == 'Activate' ? 'TRUE' : 'FALSE';
	$sql   = "UPDATE tbl_users 
	          SET is_active = '$status'
			  WHERE id = $userId";

	dbQuery($sql);
	header('Location: index.php');	

}


/*
	Modify a user
*/
function modifyEmail()
{
	$userId 	= (int)$_POST['hidUserId'];	
	$new_email 	= $_POST['new_email'];
	
	$sql   = "UPDATE tbl_users 
	          SET email = '$new_email'
			  WHERE id = $userId";

	dbQuery($sql);
	header('Location: index.php?view=email&error=' . urlencode('Email ID successfully modified.'));

}



/*
	Remove a user
*/
function deleteUser()
{
	if (isset($_GET['userId']) && (int)$_GET['userId'] > 0) {
		$userId = (int)$_GET['userId'];
	} else {
		header('Location: index.php');
	}
		
	$sql = "DELETE FROM tbl_users WHERE id = $userId";
	dbQuery($sql);
	
	$sql = "DELETE FROM tbl_accounts WHERE user_id = $userId";
	dbQuery($sql);
	
	$sql = "DELETE FROM tbl_address WHERE user_id = $userId";
	dbQuery($sql);
	
	header('Location: index.php');
}
?>