// JavaScript Document
function checkAddUserForm()
{
	with (window.document.frmAddUser) {
		if (isEmpty(txtUserName, 'Enter user name')) {
			return;
		} else if (isEmpty(txtPassword, 'Enter password')) {
			return;
		} else {
			submit();
		}
	}
}

function addUser()
{
	window.location.href = 'index.php?view=add';
}

function changePassword(userId)
{
	window.location.href = 'index.php?view=modify&userId=' + userId;
}

function deleteUser(userId)
{
	if (confirm('Delete this user?')) {
		window.location.href = 'processUser.php?action=delete&userId=' + userId;
	}
}

function changeUserStatus(userId, status)
{
	var st = status == 'FALSE' ? 'Activate' : 'Inactive'
	if (confirm('Do you want to ' + st+' this user?')) {
		window.location.href = 'processUser.php?action=status&userId=' + userId + '&nst=' + st;
	}
}

function changeAccStatus(accId, status)
{
	var st = status == 'INACTIVE' ? 'Activate' : 'Inactive'
	if (confirm('Do you want to ' + st+' this Account?')) {
		window.location.href = 'process.php?action=status&accId=' + accId + '&nst=' + st;
	}
}

function viewAccountStatement(userId, accNo)
{
	if (confirm('Do you want to view ' + accNo +' Account Statement?')) {
		window.location.href = 'index.php?view=statement&accNo=' + accNo;
	}
}


