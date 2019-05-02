<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js"></script>
<div class="row">
	<?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
	<?php } ?>
	<div class="col-lg-8">
	<form role="form" class="form form-horizontal" action="<?php echo $url ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-sm-4" for="username">Username</label>
			<div class="col-sm-8 user-input has-feedback">
				<p class="form-control-static"><strong><?php echo isset($datas['username'])? $datas['username'] : ''; ?></strong></p>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="email">Email</label>
			<div class="col-sm-8">
				<input type="email" class="form-control" id="email" name="email" required="required" value="<?php echo isset($datas['email'])? $datas['email'] : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="name">Nama Lengkap</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="name" name="name" required="required" value="<?php echo isset($datas['name'])? $datas['name'] : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="password">Password</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="password" name="password" <?php if(!isset($datas)){ echo 'required="required"';} ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="repassword">Ulangi Password</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="repassword" <?php if(!isset($datas)){ echo 'required="required"';} ?>>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" onclick="javascript:window.history.back()">Batal</button>
			</div>
		</div>
	</form>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.form').submit(function(){
			if($('#password').val() != $('#repassword').val()){
				alert('Input Password and Repeat Password must be same!');
				return false;
			}
		})
	})
}
</script>