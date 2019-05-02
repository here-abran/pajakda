<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
	<?php $menus = $this->session->userdata('menus');?>
	<li class="header">MENU UTAMA</li>
	<?php foreach ($menus as $i => $menu) { ?>
		<li class="treeview">
			<a href="<?php echo base_url_admin().$menu['url'] ?>">
				<i class="<?php echo $menu['icon'] ?>"></i>
				<span><?php echo $menu['name'] ?></span>
				<?php if(isset($menu['children'])){ echo '<i class="fa fa-angle-left pull-right"></i>'; } ?>
			</a>
			<?php if(isset($menu['children'])){ ?>
				<ul class="treeview-menu">
					<?php foreach ($menu['children'] as $j => $child) { ?>
						<li><a href="<?php echo base_url_admin().$child['url'] ?>"><i class="<?php echo $child['icon'] ?>"></i> <?php echo $child['name'] ?></a></li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
		
	<?php } ?>
</ul>

<!--
<li class="treeview">
	<a href="#" data-toggle="modal" data-target="#about">
		<i class="fa fa-copyright"></i> <span>COPYRIGHT</span>
	</a>
</li>

<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Tentang Karunia Laundry</h4>
      </div>
      <div class="modal-body">
      Karunia Laundry <br>
	  Aplikasi Manajemen Laundry Berbasis Web <br>
      Version 0.0.1 <br>
      
      <div class="modal-footer">
      Copyright © 2016 - Isatech Indonesia. All Right Reserved <br><br>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
-->

<script type="text/javascript">
$(document).ready(function(){
	<?php if($this->session->userdata('first_login') == 1){ ?>
	$(".sidebar-menu").css("display", "none");
	<?php } ?>
	$('.sidebar-menu li').each(function() {
	    var href = $(this).find('a').attr('href');
	    var uri = window.location;
	    if (String(uri).indexOf(String(href)) >= 0) {
			$(this).closest('li').addClass('active');
			$(this).closest('li').closest('ul').closest('li').addClass('active');
    	}
 	});
})
  
</script>