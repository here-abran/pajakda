
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title ?></h3>
			</div><!-- /.box-header -->
			<form method="post" action="<?php echo $url ?>" enctype="multipart/form-data">
				<div class="box-body">
					<div class="form-group">
						<label>Judul Berita</label>
						<input type="text" id="berita_judul" placeholder="Judul berita" name="berita_judul" class="form-control" required="required" value="<?php echo isset($datas['berita_judul']) ? $datas['berita_judul'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Url Berita</label>
						<input type="text" id="berita_url" placeholder="Url Berita, isikan jika ingin menyambungkan ke link luar" name="berita_url" class="form-control" value="<?php echo isset($datas['berita_url']) ? $datas['berita_url'] : ''; ?>">
					</div>
					<div class="form-group">
						<label>Image</label>
						<input type="file" id="berita_image" name="berita_image" class="form-control">
					</div>
					<div class="form-group">
						<?php 
						$checked = '';
						if (isset($datas['featured'])) {
							if($datas['featured'] == 1) $checked = 'checked = "checked"';
						} ?>
						<label>
							<input type="checkbox" id="featured" name="featured" value="1" <?php echo $checked ?> >  Featured / Tampilkan dalam Slider</input>
						</label>
					</div>
					<div class="form-group">
						<?php 
						$checked = '';
						if (isset($datas['berita_full'])) {
							if($datas['berita_full'] == 1) $checked = 'checked = "checked"';
						} ?>
						<label>
							<input type="checkbox" id="berita_full" name="berita_full" value="1" <?php echo $checked ?> >  Full Page / Tanpa List Berita Lain</input>
						</label>
					</div>
					<div class="form-group">
						<label>Preview Berita (max 50 char)</label>
					</div>
					<div class="form-group">
						<textarea name="berita_preview" id="berita_preview" class="texteditor" maxlength="50"><?php echo isset($datas['berita_preview']) ? $datas['berita_preview'] : ''; ?></textarea>
					</div>
					<div class="form-group">
						<label>Isi Berita</label>
					</div>
					<div class="form-group">
						<textarea name="berita_detail" id="berita_detail" class="texteditor"><?php echo isset($datas['berita_detail']) ? $datas['berita_detail'] : ''; ?></textarea>
					</div>
					
				</div><!-- /.box-body -->

				<div class="box-footer">
					<?php if(isset($id)){ ?>
						<input type="hidden" name="berita_id" class="form-control" required="required" value="<?php echo $id ?>">
					<?php } ?>
					<input type="submit" id="simpan" value="Simpan" class="btn btn-primary">
					<a class="btn btn-default" onclick="javascript:window.history.back()">Kembali</a>
				</div>
			</form>
		</div><!-- /.box -->
	</div>
</div>
<!-- panggil jquery -->
<!-- 	 -->
<!-- panggil ckeditor.js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
<!-- setup selector -->
<script type="text/javascript">
	$('textarea.texteditor').ckeditor();
</script>