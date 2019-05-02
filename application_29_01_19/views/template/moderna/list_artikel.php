<section id="content">
	<div class="container">
		<div class="row">
			<?php

				$div_class = 'col-lg-8';
				$div_class_another = 'col-lg-4';

			?>
			<h2>Berita</h2>
			<div class="<?php echo $div_class ?>">
				<?php
				foreach ($results as $key => $vberita) {
				?>
					<div class="berita">
						<h4 class="judul"><?= $vberita->berita_judul ?></h4>
						<div class="berita-info">
							<i class="fa fa-calendar"></i> <?php echo format_tanggal_indonesia(date('Y-m-d', strtotime($vberita->create_date))) ?>
						</div>
						<div class="image">
							<?php 
								$an_image = $vberita->berita_image;
								if($an_image != '') $an_image = $this->securefile->get_image($vberita->berita_image);
								else $an_image = base_url().'assets/img/no-image.jpg';
							?>
							<img src="<?php echo $an_image; ?>" alt="">
						</div>

						<div class="content">
							<?php echo substr($vberita->berita_detail, 0, 250).'...'; ?>
						</div>
						<a href="<?= $vberita->berita_url ?>" class="btn btn-theme">Read More</a>
					</div>
				<?php
				}

				echo $links;
				?>
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