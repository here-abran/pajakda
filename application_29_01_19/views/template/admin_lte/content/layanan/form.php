<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title ?></h3>
			</div><!-- /.box-header -->
			<form method="post" action="<?php echo $url ?>">
				<div class="box-body">
					<div class="form-group">
						<label>Nama  Layanan</label>
						<input type="text" placeholder="Nama Layanan" name="nama_layanan" class="form-control" required="required" value="<?php echo isset($datas['nama_layanan']) ? $datas['nama_layanan'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Unit</label>
						<select class="form-control" name="unit">
							<option value="PCS">PCS</option>
							<option value="KG">KG</option>
							<option value="KG">SET</option>
							<option value="METER">METER</option>
						</select>
						<p class="help-blocks"><em>Pilih Jenis Unit Layanan</em></p>
					</div>                      
					<div class="form-group">
						<label>Harga Normal</label>
						<input type="text" placeholder="Harga Normal" id="harga_normal" name="harga_normal" class="form-control" required="required" value="<?php echo isset($datas['harga_normal']) ? $datas['harga_normal'] : ''; ?>">
						<p class="help-blocks"><em>Masukkan harga tanpa Rp</em></p>
					</div>
					<div class="form-group">
						<label>Harga Express</label>
						<input type="text" placeholder="Harga Express" id="harga_express" name="harga_express" class="form-control" required="required" value="<?php echo isset($datas['harga_express']) ? $datas['harga_express'] : ''; ?>">
						<p class="help-blocks"><em>Masukkan harga tanpa Rp</em></p>
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