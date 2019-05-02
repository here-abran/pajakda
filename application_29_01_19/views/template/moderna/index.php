<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->session->userdata('title').' '.$title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="BPBD Bantul" />
	<!-- css -->
	<link href="<?php echo base_url('template/moderna'); ?>/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('template/moderna'); ?>/css/fancybox/jquery.fancybox.css" rel="stylesheet">
	<!-- <link href="<?php //echo base_url('template/moderna'); ?>/css/jcarousel.css" rel="stylesheet" /> -->
	<link href="<?php echo base_url('template/moderna'); ?>/css/flexslider.css" rel="stylesheet" />
	<link href="<?php echo base_url('template/moderna'); ?>/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url('template/moderna'); ?>/skins/default.css" rel="stylesheet" />
	<link href="<?php echo base_url('template/moderna'); ?>/skins/custom.css" rel="stylesheet" />
	<style type="text/css">
		/*.navbar-header{
			float: right;
		}*/
		.navbar-brand{
			margin-top:5px;
			float:right;
		}
		.navbar-brand img{
			width: 50%;
		}
		header .navbar-collapse ul.navbar-nav{
			float:left;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<?php $this->load->view('template/moderna/header'); ?>
		<?php $this->load->view($content); ?>
		<?php $this->load->view('template/moderna/footer'); ?>
	</div>
	<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
	<!-- javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url('template/moderna'); ?>/js/jquery.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/jquery.easing.1.3.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/jquery.fancybox.pack.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/jquery.fancybox-media.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/google-code-prettify/prettify.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/portfolio/jquery.quicksand.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/portfolio/setting.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/jquery.flexslider.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/animate.js"></script>
	<script src="<?php echo base_url('template/moderna'); ?>/js/custom.js"></script>

	<?php
		if(isset($js_file)){
			$this->load->view('template/moderna/js/'.$js_file);
		}
	?>
</body>
</html>