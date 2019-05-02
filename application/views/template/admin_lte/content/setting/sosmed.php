<div class="row">
	<?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
	<?php } ?>
	<div class="col-lg-8">
		<div class="panel panel-default social-media">
			<div class="panel-heading">Social Media</div>
			<div class="panel-body">
				<?php
					$sosmed = array('facebook','twitter', 'youtube', 'google-plus', 'instagram');
				?>
				<form class="form" role="form" action="<?php echo base_url_admin().'sosmed/update' ?>" method="POST">
					<?php foreach ($sosmed as $index => $value) {?>
						
						<div class="form-group input-group col-lg-8">
							<span class="input-group-addon btn-<?php echo $value ?>"><i class="fa fa-<?php echo $value ?>"></i></span>
							<input type="text" class="form-control" id="<?php echo $value ?>" name="<?php echo $value ?>" value="<?php echo isset($datas[$value])? $datas[$value] : '' ?>" placeholder="<?php echo ucfirst($value) ?>">
						</div>	
					<?php } ?>
					<button type="submit" class="btn btn-primary">Save Social Media</button>
				</form>
			</div>
		</div>
	</div>
</div>