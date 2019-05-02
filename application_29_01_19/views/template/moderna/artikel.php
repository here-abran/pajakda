<section id="content">
	<div class="container">
		<div class="row">
			<?php
				if (count($berita) == 0) {
					$berita = array();
					$berita['berita_judul'] = 'Maaf, Berita tidak ditemukan';
					$berita['berita_image'] = base_url().'assets/img/404.jpg';
					$berita['berita_detail'] = '<p></p>';
					$berita['name']	= '';
					$berita['create_date']	= '';
					$berita['berita_full']	= 0;
				}else{
					if($berita['berita_image'] != '') $berita['berita_image'] = $this->securefile->get_image($berita['berita_image']);
					$create_date = strtotime($berita['create_date']);
					$month_indo = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
					$date = date('d', $create_date);
					$month = $month_indo[date('n', $create_date)];
					$year = date('Y', $create_date);

					$berita['create_date'] = $date.' '.$month.' '.$year;
				}

				$div_class = 'col-lg-8';
				$div_class_another = 'col-lg-4';

				if($berita['berita_full'] == 1){
					$div_class = 'col-lg-11';
					$div_class_another = '';
				}
			?>
			<div class="<?php echo $div_class ?>">
				<article>
					<div class="post-image">
						<div class="post-heading">
							<h3><a href="#"><?php echo $berita['berita_judul'] ?></a></h3>
						</div>
						<?php if($berita['berita_image'] != ''){ ?>
							<img src="<?php echo $berita['berita_image']; ?>" alt="" />
						<?php } ?>
					</div>
					<?php echo $berita['berita_detail'] ?>
					<div class="bottom-article">
						<ul class="meta-post">
							<li><i class="icon-calendar"></i><a href="#"> <?php echo $berita['create_date'] ?></a></li>
							<li><i class="icon-user"></i><a href="#"> <?php echo $berita['name'] ?></a></li>
						</ul>
					</div>
				</article>
			</div>
			<?php if($div_class_another != ''){ ?>
				<div class="<?php echo $div_class_another ?>">
					<aside class="right-sidebar">
						<div class="widget">
							<h5 class="widgetheading">Artikel Terbaru</h5>
							<ul class="recent">
								<?php foreach ($another_berita as $an) {?>
									<?php 
										$an_image = $an['berita_image'];
										if($an_image != '') $an_image = $this->securefile->get_image($an['berita_image']);
										else $an_image = base_url().'assets/img/no-image.jpg';
									?>
									<li class="clearfix">
										<img src="<?php echo $an_image; ?>" class="pull-left centered-and-cropped" alt="" style="width: 75px; height: 75px;" />
										<h6><a href="<?php echo $an['berita_url'] ?>"><?php echo $an['berita_judul'] ?></a></h6>
										<p><?php echo substr($an['berita_preview'], 0, 100).'...'; ?></p>
									</li>	
								<?php } ?>
							</ul>
						</div>
					</aside>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<style type="text/css">
	.centered-and-cropped { object-fit: cover }
</style>