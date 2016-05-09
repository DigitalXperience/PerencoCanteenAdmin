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
			<input type="text" id="username" placeholder="Username">
			<input type="password" id="password" placeholder="Password">
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
<script src='<?php echo base_url(); ?>/assets/js/jquery.min.js'></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!--<script src="<?php echo base_url(); ?>/assets/js/index.js"></script>-->
</body>
<script>
$("#username, #password").keyup(function(event){
	$('#mtsg').html('Staff Canteen Administration');
});
 $("#login-button").click(function(event){
	event.preventDefault();
	var login = 'junior';
	var password = 'ndjaya';
	
	if($("#password").val() == password && login == $("#username").val()) {
		$('form').fadeOut(500);
		$('.wrapper').addClass('form-success');
		setTimeout(function(){
			$(location).attr('href', '<?php echo base_url(); ?>/dashboard')
			return false;
		}, 2000);
	} else {
		if(login != $("#username").val()) {
			$('#mtsg').html('Login Incorrect...');
			$('#mtsg').addClass('error');
			$('#username').addClass('error');
		}
		if(password != $("#password").val()) {
			$('#mtsg').html('Mot de passe Incorrect...');
			$('#mtsg').addClass('error');
			$('#password').addClass('error');
		}
	}
	
});
</script>
</html>