<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="recent">
					<h4>Link Terkait</h4>
					<a href="#"><img class="img-responsive" src="images/sport.jpg" alt="" /></a>                
						<div class="info-meta">
							<ul>
								<?php foreach ($link as $li) {?>
									<li><h5><a href="<?php echo $li['link_alamat'] ?>" target="_blank"><?php echo $li['link_judul'] ?></a></h5></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<h4>Sosial Media</h4>
					<div class="social-media-link">
						<a href="#" class="fa fa-facebook"></a>
						<a href="#" class="fa fa-twitter"></a>
						<a href="#" class="fa fa-google-plus"></a>
						<a href="#" class="fa fa-instagram"></a>
					</div>
			</div>
			<div class="col-lg-6">
				<div class="widget">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.075681552516!2d110.32523231449528!3d-7.887150994317837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTMnMTMuNyJTIDExMMKwMTknMzguNyJF!5e0!3m2!1sid!2sid!4v1507475515474" width="600" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Lokasi</h5>
					<address>
						<strong>Badan Keuangan dan Aset Daerah (BKAD) Kabupaten Bantul</strong><br>
						Jl.R.Wolter Monginsidi, Bantul, Daerah Istimewa Yogyakarta
					</address>
					<p>
						<i class="icon-phone"></i> (0274) 367509; 367260<br>
						<i class="icon-envelope-alt"></i> bkad@bantulkab.go.id
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- <div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>&copy; Moderna Theme. All right reserved.</p>
						<div class="credits">
							<a href="https://bootstrapmade.com/">Free Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div> -->
</footer>