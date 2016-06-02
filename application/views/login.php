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
<script src='<?php echo base_url(); ?>assets/js/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/jquery-ui.js'></script>
<!--<script src="<?php echo base_url(); ?>assets/js/index.js"></script>-->
</body>
<script>
$("#username, #password").keyup(function(event){
	$('#mtsg').html('Staff Canteen Administration');
});
 $("#login-button").click(function(event){
	event.preventDefault();
	var password = $("#password").val();
	var login = $("#username").val();
	
	if(password != '' && '' != login) {
		
		$('form').fadeOut(500);
		$('.wrapper').addClass('form-success');
		$.post( "verifylogin", { username: login, password: password }).done(function( data ) {
			//alert( "Data Loaded: " + data );
			if(data != 'false') {
				setTimeout(function(){
					$(location).attr('href', '<?php echo base_url(); ?>index.php/dashboard');
					return false;
				}, 2000);
			} else {
				$('form').fadeIn(500);
				$('.wrapper').removeClass('form-success');
			}
		  });
		
	} else {
		if(login == '') {
			$('#mtsg').html('Login manquant...');
			$('#mtsg').addClass('error');
			$('#username').addClass('error');
		}
		if(password == '') {
			$('#mtsg').html('Mot de passe manquant...');
			$('#mtsg').addClass('error');
			$('#password').addClass('error');
		}
	}
	
});
</script>
</html>