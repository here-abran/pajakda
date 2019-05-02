<?php 
	if($state == 'edit'){
		$id_group = $group['id'];
		$group = $group['name'];
		$ability = 'disabled';
		$action = 'update';
	}else{
		$id_group = 0;
		$group = '';
		$ability = 'disabled';
		$action = 'insert';
	}
?>
<div class="row">
		<div class="col-lg-8">
			<form role="form" class="form-horizontal" action="<?php echo base_url_admin().'group/'.$action; ?>" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-4" for="name">Group</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="name" name="name" pattern="[\w\s]{1,255}" value="<?php echo $group; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Menu Akses</label>
					<div class="col-sm-8">
					<?php if(isset($menus)){ ?>
						<table class="table table-striped table-responsive table-hover">
							<thead>
								<tr>
									<th></th>
									<th>No</th>
									<th>Menu</th>
									<?php foreach ($access_name as $access) {?>
										<th><?php echo ucfirst($access) ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($menus as $i => $menu) {?>
									<tr>
										<td><input type="checkbox" class="verticalCheck childCheck pull-left" id="<?php echo $i ?>" title="Select All Right and Child"></td>
										<td><?php echo $no; $no++; ?>.</td>
										<td><?php echo $menu['name'] ?></td>
										<?php foreach ($access_name as $access) {?>
											<?php $sel = ''; if(isset($datas[$menu['id']])){ if($datas[$menu['id']][$access] == 1) $sel = 'checked'; } ?>
											<td><input type="checkbox" name="menus[<?php echo $menu['id'] ?>][<?php echo $access ?>]" value="1" <?php echo $sel ?>></td>
										<?php } ?>
									</tr>
									<?php if(($menu['name'] == 'Master Data' || $menu['name'] == 'Perencanaan' || $menu['name'] == 'Realisasi Anggaran' || $menu['name'] == 'Pengaturan') && isset($menu['children'])){ ?>
										<?php foreach ($menu['children'] as $j => $menu) {?>
											<tr>
												<td></td>
												<td></td>
												<td> &mdash; <?php echo $menu['name'] ?></td>
												<?php foreach ($access_name as $access) {?>
													<?php $sel = ''; if(isset($datas[$menu['id']])){ if($datas[$menu['id']][$access] == 1) $sel = 'checked'; } ?>
													<td><input class="child-<?php echo $i ?>" type="checkbox" name="menus[<?php echo $menu['id'] ?>][<?php echo $access ?>]" value="1" <?php echo $sel ?>></td>
												<?php } ?>
											</tr>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php if($id_group != 0){ ?>
							<input type="hidden" name="id" value="<?php echo $id_group; ?>">
						<?php } ?>
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="button" onclick="javascript:window.history.back()" class="btn btn-default">Batal</button>
					</div>
				</div>
			</form>
		</div>
	<?php } ?>
</div>

<script type="text/javascript">
	$(function(){
		$('.verticalCheck').click(function(){
			check = this.checked;
			$(this).parent().parent().find(':checkbox').prop('checked', check);
		})

		$('.childCheck').click(function(){
			check = this.checked;
			id 	  = $(this).attr('id');

			$(this).parent().parent().parent().find(':checkbox.child-'+id).prop('checked', check);
		})
	})
</script>