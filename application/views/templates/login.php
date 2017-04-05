<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sticky-footer-navbar.css'); ?>">
</head>
<body style="margin-top:30px;">

	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">

				<h1 class="text-center login-title">Login</h1>

				<?php 
				echo $this->session->flashdata('action_status'); 
				echo validation_errors();
				?>

				<div class="account-wall">

					<img class="profile-img" src="<?php echo base_url('assets/img/login.png');?>" alt="">

					<?php 
					$array_form_login = array(
						'class' => 'form-signin'
						);

					echo form_open('auth/login', $array_form_login); 
					?>

					<input name="identity" type="email" class="form-control" placeholder="Email" required="required" autofocus="autofocus">

					<input name="password" type="password" class="form-control" placeholder="Password" required="required">

					<button class="btn btn-lg btn-primary btn-block" type="submit">
						Sign in</button>

						<label class="checkbox pull-left">
							<input name="remember-me" type="checkbox" value="remember-me">
							Remember me
						</label>

						<a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>

						<?php echo form_close(); ?>

					</div>

					<a href="#" class="text-center new-account">Create an account </a>

				</div>
			</div>
		</div>
	</div>
	<!-- footer -->
	<footer class="footer">
		<div class="container">
			<p class="text-muted">JMC IT Consultan - Online Test (Wisnu Rihandana)</p>
		</div>
	</footer>
</body>
</html>	