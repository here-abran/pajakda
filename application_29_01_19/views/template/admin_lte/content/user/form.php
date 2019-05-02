<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js"></script>
<div class="row">
	<?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
	<?php } ?>
	<?php 
		if(!isset($datas)){
			$url = base_url_admin().'user/insert';
		}else{
			$url = base_url_admin().'user/update?id='.$id;
		}
	?>
	<div class="col-lg-8">
	<form role="form" class="form form-horizontal" action="<?php echo $url ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-sm-4" for="username">Username</label>
			<div class="col-sm-8 user-input has-feedback">
				<?php if($state == 'edit'){ ?>
				<p class="form-control-static"><strong><?php echo isset($datas['username'])? $datas['username'] : ''; ?></strong></p>
				<input type="hidden" id="username" name="username" value="<?php echo isset($datas['username'])? $datas['username'] : '' ?>">
				<?php }else{ ?>
				<input type="text" class="form-control" id="username" name="username" required="required" onchange="check_user(this)" value="">
				<?php } ?>
				<span class="form-control-feedback" aria-hidden="true"><img id="loader-img" style="display:none;" src="<?php echo base_url()."assets/img/ajax-loader.gif"; ?>"></span>
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
		<?php if($this->session->userdata('group_id') == 1){ ?>
		<div class="form-group">
			<label class="control-label col-sm-4" for="role">Group</label>
			<div class="col-sm-8">
				<select class="form-control" name="group_id">
					<?php foreach ($group as $i => $v) {?>
						<?php $sel = ''; if(isset($datas['group_id'])){ if($datas['group_id'] == $v['id']) $sel='selected="selected"';} ?>
						<option value="<?php echo $v['id'] ?>" <?php echo $sel ?>><?php echo $v['name'] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<?php } ?>
		<!--<div class="form-group">
			<label class="control-label col-sm-4" for="userfile">Foto</label>
			<div class="col-sm-8">
				<img src="<?php $foto = isset($datas['url'])? $this->securefile->get_image($datas['url']) : base_url('assets/upload/no-image.png'); echo $foto;?>" alt="photo-profile" class="img-rounded"  height="150" width="150">
				<input type="file" id="userfile" name="userfile">
				<p class="help-block"><i>*Tipe file yang diperbolehkan .gif .jpeg .jpg .png<br />*Ukuran file maksimal 150 x 150 px.</i></p>
			</div>
		</div>-->
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

	$(document).ajaxStart(function(){
    	$("#loader-img").show();
	});

	$(document).ajaxStop(function() {
		$("#loader-img").hide();
	});

	function check_user(e){
	if(e.value != ''){
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('admin/data_ref/cek_username'); ?>',
			data:{
				u: e.value
			},
			dataType: 'json',
			success: function(data){
				if (!$.isEmptyObject(data)) {
					$(".user-input").addClass('has-error');
					$(".form-control-feedback").addClass('glyphicon glyphicon-remove');
					document.getElementById('username').setCustomValidity('Username sudah dipakai.');
				}else{
					$(".user-input").removeClass('has-error');
					$(".user-input").addClass('has-success');
					$(".form-control-feedback").removeClass('glyphicon glyphicon-remove');
					$(".form-control-feedback").addClass('glyphicon glyphicon-ok');
					document.getElementById('username').setCustomValidity('');
				}
			}
		})
	}else{

	}
	return false;
}
</script>