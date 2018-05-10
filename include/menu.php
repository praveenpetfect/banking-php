<div id="photo">
	<?php
	$my_pic = $_SESSION['hlbank_user']['pics'];
   	$upics = (isset($my_pic) && $my_pic != "") ? $my_pic : "anonymous-user.jpg"; 
   	?>
	<img src="<?php echo WEB_ROOT; ?>images/thumbnails/<?php echo $upics; ?>" alt="Photo" width="180" height="180" />
</div>
<p>&nbsp;</p>

<div id="ddblueblockmenu">
<div class="menutitle">Account Details</div>
<ul>
	<li><a href="<?php echo WEB_ROOT; ?>view/?v=Summary">Account Summary</a></li>
	<li><a href="<?php echo WEB_ROOT; ?>view/?v=Account">Account Details</a></li>
	<li><a href="<?php echo WEB_ROOT; ?>view/?v=Statement">Account Statement</a></li>
	<li><a href="<?php echo WEB_ROOT; ?>view/?v=Transfer">Fund Transfers</a></li>
</ul>
<p>&nbsp;</p>
<div class="menutitle">Security Settings</div>
<ul>
	<li><a href="<?php echo WEB_ROOT; ?>view/?v=ChangePwd">Change Password</a></li>
	<li><a href="<?php echo WEB_ROOT; ?>view/?v=ChangePin">Change PIN</a></li>
	<li><a href="<?php echo WEB_ROOT; ?>?logout">Sign Out</a></li>
</ul>
</div>
<p style="height:100px;">&nbsp;</p>