<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $this->session->userdata('title').' '.$title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('template/admin_lte'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('template/admin_lte'); ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('template/admin_lte'); ?>/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
          <a href="#"><b>Sistem</b> SSPD</a>
        </div>
      <div class="login-box-body">
		<div class="login-logo">
		  </div><!-- /.login-logo -->
        <!-- <p class="login-box-msg"></p> -->
        <form action="<?php echo base_url_admin(); ?>login/signin" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" autofocus required="required"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required="required"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <?php if($this->session->userdata('login_attempt') > 1){ ?>
			<div class="form-group text-center">
				<img id="captcha" src="<?php echo base_url().'index.php/login/gen_captcha' ?>" alt="CAPTCHA Image" />
				<input type="text" name="captcha_code" maxlength="6" style="" placeholder="Captcha"/>
			</div>
		<?php } ?>
          <div class="row"><!-- /.col -->
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
	  <div>&nbsp;</div>
	  <?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
		<?php } ?>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('template/admin_lte'); ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('template/admin_lte'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('template/admin_lte'); ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>