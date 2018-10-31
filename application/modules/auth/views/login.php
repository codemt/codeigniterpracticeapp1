<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MX - NMW | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style>
		.btn-primary {
			background-color: #58585a;
			border-color: #58585a;
		}
		.btn-primary:hover, .btn-primary:active, .btn-primary.hover, .btn-primary:focus {
			background-color: #3f3f40;
			border-color: #3f3f40;
		}
		.login-page{
			overflow: hidden;
		}
		.login-box, .register-box {
			margin: 10% auto 0;
		}
	</style>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="login-box-body">
			<?php echo form_open("auth/login");?>
				<div class="login-logo">
					<span class="logo"><img src="<?php echo base_url()?>images/logo.jpg" atl="MX" style="height:100px; width:auto;"/></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" id ="identity" name="identity" placeholder="Username" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" id ="password" name="password" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
				<!-- /.col -->
				<div class="col-xs-12 text-center">
					<div class="show_msg"></div>
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<div class="col-xs-12 text-center" style="padding-top:10px;">
					<a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
				</div>
				<!-- /.col -->
				</div>
			<?php echo form_close();?>

		</div>
		<!-- /.login-box-body -->
	</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</script>
</body>
</html>
