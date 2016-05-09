<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title><?php echo ''; ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  </head>
  <body>
    <div class="wrapper">
	<div class="container">
		<img src="<?php echo base_url(); ?>/assets/images/perenco2.png" class="ri" style="height: 120px;" />
		<h1 id="mtsg">Staff Canteen Administration</h1>
		<form class="form">
			<input type="text" placeholder="Username">
			<input type="password" placeholder="Password">
			<button type="submit" id="login-button">Login</button>
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
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url(); ?>/assets/js/index.js"></script>
  </body>
</html>