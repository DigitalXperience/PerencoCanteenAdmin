<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title><?php echo ''; ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  </head>
  <body>
    <div class="wrapper">
		<div class="container">
			<img src="<?php echo base_url(); ?>assets/images/perenco2.png" class="ri" style="height: 120px;" />
			<h1 id="mtsg">Staff Canteen</h1>
			<form class="form" method="POST" action="<?php echo base_url(); ?>index.php/account/getPinFirstUse">
				<input type="text" id="pin" name="pin" value="Pin actuel : <?php echo $newpin; ?>" disabled=disabled>
				<input type="password" id="newpin" name="newpin" placeholder="Sera envoyé par mail" disabled=disabled>
				<button type="submit" id="login-button">Générer nouveau pin</button>
				<input type="hidden" value="<?php echo $this->session->userdata('logged_in')['userid']; ?>" name="iduser" id="iduser" />
			</form>
		</div>
		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<script src='<?php echo base_url(); ?>assets/js/jquery.min.js'></script>
	<script src='<?php echo base_url(); ?>assets/js/jquery-ui.js'></script>
	<!--<script src="<?php echo base_url(); ?>assets/js/index.js"></script>-->
</body>
<script>

</script>
</html>