<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title ?></h3>
			</div><!-- /.box-header -->
			<form method="post" action="<?php echo $url ?>">
				<div class="box-body">
					<div class="form-group">
						<label>Nama Pelanggan</label>
						<input type="text" placeholder="Nama Pelanggan" name="nama_customer" class="form-control" required="required" value="<?php echo isset($datas['nama_customer']) ? $datas['nama_customer'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" placeholder="Alamat" name="alamat" class="form-control" required="required" value="<?php echo isset($datas['alamat']) ? $datas['alamat'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input type="text" placeholder="No HP" name="no_hp" class="form-control" required="required" value="<?php echo isset($datas['no_hp']) ? $datas['no_hp'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" placeholder="Email" name="email" class="form-control" required="required" value="<?php echo isset($datas['email']) ? $datas['email'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Catatan</label>
						<input type="text" placeholder="Catatan" name="catatan" class="form-control" required="required" value="<?php echo isset($datas['catatan']) ? $datas['catatan'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Status</label>
						<?php $arr_status = array(1 => 'Aktif', 2 => 'Non Aktif'); ?>
						<select name="status" class="form-control" required="required">
							<?php foreach ($arr_status as $index => $value) {?>
								<?php $sel = ''; if(isset($datas['status'])){ if($datas['status'] == $index) $sel = 'selected="selected"'; } ?>
								<option value="<?php echo $index ?>" <?php echo $sel; ?> ><?php echo $value ?></option>
							<?php } ?>
						</select>
					</div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<?php if(isset($id)){ ?>
						<input type="hidden" name="id" class="form-control" required="required" value="<?php echo $id ?>">
					<?php } ?>
					<input type="submit" value="Simpan" class="btn btn-primary">
					<a class="btn btn-default" onclick="javascript:window.history.back()">Kembali</a>
				</div>
			</form>
		</div><!-- /.box -->
	</div>
</div>