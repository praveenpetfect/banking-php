<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$sql = "SELECT u.id, u.fname, u.lname, u.bdate, u.is_active, u.email, u.phone, a.acc_no
        FROM tbl_users u, tbl_accounts a
		WHERE u.id = a.user_id
		ORDER BY id DESC LIMIT 20";
$result = dbQuery($sql);

?> 

<p align="center" id="mainHead">User Details List</p>
<p style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px; margin-bottom:40px;">
View account details, credit, debit funds from the acount or activate, de-activate them.</p>

<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>User Name</td>
   <td>Account No.</td>
   <td>Email / Phone</td>
   <td width="120">Register Date</td>
   <td width="80">User status</td>
   <td width="70">Delete</td>
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
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $fname .' '.$lname; ?></td>
   <td><?php echo $acc_no; ?></td>
   <td><a href="<?php echo WEB_ROOT; ?>admin/user/?view=email&userId=<?php echo $id; ?>"><?php echo $email; ?></a>&nbsp;/&nbsp;<?php echo $phone; ?></td>
   <td width="120" align="center"><?php echo $bdate; ?></td>
   <td width="80" align="center"><a href="javascript:changeUserStatus(<?php echo $id; ?>, '<?php echo $is_active; ?>');"><?php echo $is_active == 'FALSE'? 'Inactive' : 'Active'; ?></td>
   <td width="70" align="center"><a href="javascript:deleteUser(<?php echo $id; ?>);">Delete</a></td>
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
</form>