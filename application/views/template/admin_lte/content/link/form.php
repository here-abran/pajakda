<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title ?></h3>
			</div><!-- /.box-header -->
			<form method="post" action="<?php echo $url ?>">
				<div class="box-body">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" placeholder="Judul URL" name="link_judul" class="form-control" required="required" value="<?php echo isset($datas['link_judul']) ? $datas['link_judul'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>URL</label>
						<input type="text" placeholder="Link URL" name="link_alamat" class="form-control" required="required" value="<?php echo isset($datas['link_alamat']) ? $datas['link_alamat'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Order</label>
						<input type="text" placeholder="Link Order" name="link_order" class="form-control" required="required" value="<?php echo isset($datas['link_order']) ? $datas['link_order'] : ''; ?>">
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