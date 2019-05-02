<!-- start header -->
<header>
	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url() ?>">
					<div class="logo">
						<img src="<?php echo base_url() ?>assets/img/logo-bkad-bantul-v2.png">
					</div>
					<!-- <span>M</span>oderna -->
				</a>
			</div>
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
				$menu_array = array(
					['title' => 'Home', 'url' => 'home'],
					['title' => 'Berita', 'url' => 'listArtikel'],
				);

				// menu info pajak Daerah
				if (isset($infos)) {
					$m_layanan_info = [];
					foreach ($infos as $value) {
						$temp = [];
						$temp['title'] = $value['widTitle'];
						$temp['url'] = $value['widUrl'];
						$m_layanan_info[] = $temp;
					}
					$menu_array[] = [
						'title' => 'Info Pajak Daerah',
						'url' => '#',
						'sub_menu' => $m_layanan_info
					];
				}

				//menu layanan online
				if (isset($onlines)) {
					$m_layanan_online = [];
					foreach ($onlines as $value) {
						$temp = [];
						$temp['title'] = $value['widTitle'];
						$temp['url'] = $value['widUrl'];
						$m_layanan_online[] = $temp;
					}
					$menu_array[] = [
						'title' => 'Layanan Online',
						'url' => '#',
						'sub_menu' => $m_layanan_online
					];
				}
			?>
			<div class="navbar-collapse collapse ">
				<ul class="nav navbar-nav">
					<?php foreach ($menu_array as $menu) {?>
						<?php 
						$active = ''; 
						if($menu['url'] == strtolower($title)) $active = 'active'; 
						if (isset($menu['sub_menu'])) {
							echo '<li class="dropdown">';
							echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu['title'] . ' <span class="caret"></span></a>';
							echo '<ul class="dropdown-menu">';
				            foreach ($menu['sub_menu'] as $sub_menu) {
								if($sub_menu['url'] == strtolower($title)) $active = 'active';
								echo '<li class="' . $active . '"><a href="/' .$sub_menu['url'] .'">' . $sub_menu['title'] . '</a></li>	';
				            }
				         	echo '</ul>';
							echo '</li>';
						}else{
							echo '<li class="' . $active . '"><a href="' . base_url().'index.php/'.$menu['url'] .'">' . $menu['title'] . '</a></li>	';
						}
					} ?>
					<!-- <li><a href="portfolio.html">Berita</a></li>
					<li><a href="blog.html">Blog</a></li> -->
					<!-- <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			          </ul>
			        </li> -->
				</ul>
			</div>
		</div>
	</div>
</header>
 <!-- end header -->