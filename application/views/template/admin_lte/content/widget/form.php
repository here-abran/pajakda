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
						<input type="text" placeholder="Judul" name="widTitle" class="form-control" required="required" value="<?php echo isset($datas['widTitle']) ? $datas['widTitle'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Tipe</label>
						<select name="widType" class="form-control" required="required">
							<?php foreach ($list_widgetType as $index => $value) {?>
								<?php $sel = ''; if(isset($datas['widType'])){ if($datas['widType'] == $index) $sel = 'selected="selected"'; } ?>
								<option value="<?php echo $index ?>" <?php echo $sel; ?> ><?php echo $value ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Icon Tipe</label>
						<select name="widIconType" class="form-control" required="required">
							<?php foreach ($list_widgetIconType as $index => $value) {?>
								<?php $sel = ''; if(isset($datas['widIconType'])){ if($datas['widIconType'] == $index) $sel = 'selected="selected"'; } ?>
								<option value="<?php echo $index ?>" <?php echo $sel; ?> ><?php echo $value ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Icon Value</label>
						<input type="text" placeholder="Icon Value" name="widIconValue" class="form-control" required="required" value="<?php echo isset($datas['widIconValue']) ? $datas['widIconValue'] : 'fa-desktop'; ?>">
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<input type="text" placeholder="Deskripsi" name="widDesc" class="form-control" required="required" value="<?php echo isset($datas['widDesc']) ? $datas['widDesc'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>URL</label>
						<input type="text" placeholder="URL" name="widUrl" class="form-control" required="required" value="<?php echo isset($datas['widUrl']) ? $datas['widUrl'] : '#'; ?>">
					</div>
					<div class="form-group">
						<label>Order</label>
						<select name="widOrder" class="form-control" required="required">
							<?php for ($i=1; $i < 20; $i++) { ?>
								<?php $sel = ''; if(isset($datas['widOrder'])){ if($datas['widOrder'] == $i) $sel = 'selected="selected"'; } ?>
								<option value="<?php echo $i ?>" <?php echo $sel; ?> ><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<?php if($state == 'edit'){ ?>
						<input type="hidden" name="widId" class="form-control" required="required" value="<?php echo $datas['widId'] ?>">
					<?php } ?>
					<input type="submit" value="Simpan" class="btn btn-primary">
					<a class="btn btn-default" onclick="javascript:window.history.back()">Kembali</a>
				</div>
			</form>
		</div><!-- /.box -->
	</div>
</div>