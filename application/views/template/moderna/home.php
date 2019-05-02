<section id="featured">
	<!-- start slider -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- Slider -->
				<div id="main-slider" class="flexslider">
					<ul class="slides">
						<?php foreach ($beritas as $berita) {?>
							<li>
								<img src="<?php echo $this->securefile->get_image($berita['berita_image']) ?>" alt="" class="centered-and-cropped" alt="" style="width: 1130px; height: 397px;"/>
								<div class="flex-caption">
									<h3><?php echo $berita['berita_judul'] ?></h3>
									<p><?php echo $berita['berita_preview'] ?></p>
									<a href="<?php echo $berita['berita_url'] ?>" class="btn btn-theme">Baca</a>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
				<!-- end slider -->
			</div>
		</div>
	</div>
</section>
<?php
	$onlines = array();
	$infos = array();
	foreach ($widget as $index => $value) {
		if($value['widType'] == 'online'){
			$onlines[] = $value;
		}elseif($value['widType'] == 'info'){
			$infos[] = $value;
		}
	}

?>
<div class="container" style="margin-top:40px">
	<div class="row">
		<div class="col-md-8">
			<div class="big-cta">
				<div class="cta-text">
					<h2>Layanan <span>Online</span></h2>
				</div>
			</div>
			<div class="row">
				<?php foreach ($onlines as $index => $data) {?>
				<a href="<?php echo $data['widUrl'] ?>" class="box-layanan">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="margin-bottom: 20px;">
						<div class="box">
							<div class="box-gray aligncenter">
								<h4><?php echo $data['widTitle'] ?></h4>
								<div class="icon">
									<i class="fa <?php echo $data['widIconValue'] ?> fa-3x"></i>
								</div>
								<p><?php echo $data['widDesc'] ?></p>
							</div>
							<div class="box-bottom">
								<b style="color: white;">Mulai</b>
							</div>
						</div>
					</div>
				</a>
				<?php } ?>
			</div>

			<div class="big-cta" style="display: none">
				<div class="cta-text">
				 	<h2>Info <span>Pajak Daerah</span></h2>
				</div>
			</div>
			<div class="row" style="display: none">
				<?php foreach ($infos as $index => $data) {?>
				<a href="<?php echo $data['widUrl'] ?>" class="box-layanan">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="margin-bottom: 20px;">
						<div class="box">
							<div class="box-gray aligncenter">
								<h4><?php echo $data['widTitle'] ?></h4>
								<div class="icon">
									<i class="fa <?php echo $data['widIconValue'] ?> fa-3x"></i>
								</div>
								<p><?php echo $data['widDesc'] ?></p>
							</div>
							<div class="box-bottom">
								<b style="color: white;">Info Selengkapnya</b>
							</div>
						</div>
					</div>
				</a>
				<?php } ?>
			</div>
			
		</div>
		<div class="col-md-4">
			<h3>Jadwal Layanan Keliling</h3>
			<div class="event">
				<ul id="list-event" class="event-list">
				</ul>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
a.box-layanan{
	color: inherit;
}
a.box-layanan:hover{
	text-decoration: none;
}
.centered-and-cropped { object-fit: cover }
.box-gray{
	min-height: 212px;
}

@media (min-width:1200px) { 
	.box-gray{
		min-height: 237px;
	}
}
</style>
</section>

