<strong>Welcome, <?php echo $_SESSION['hlbank_user_name'];  ?></strong>
<p>You have logged in from IP: <?php echo $_SERVER['REMOTE_ADDR']; ?><br />You log in at: <?php echo date("h:i A d M Y"); ?></p>
	<div class="TabbedPanels" id="AccountSummaryPanel">
		<ul class="TabbedPanelsTabGroup">
			<li class="TabbedPanelsTab" tabindex="0">Fund Transfer</li>
			<li class="TabbedPanelsTab" tabindex="0">Account Statements</li>
			<li class="TabbedPanelsTab" tabindex="0">Account Details</li>
		</ul>
		<div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">
				<?php include('FundTransfers.php'); ?>
			</div>
			<div class="TabbedPanelsContent">
				<?php include('statement.php'); ?>
			</div>
			<div class="TabbedPanelsContent">
				<?php include('AccountDetails.php'); ?>
			</div>
		</div>
	</div>
</div>
	
<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 0});
</script>