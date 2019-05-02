<div class="row">
	<?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
	<?php } ?>
	<div class="panel-group col-lg-4" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#pages">
					<h4 class="panel-title">Pages</h4>
				</a>
			</div>
			<div id="pages" class="panel-collapse collapse in">
				<div class="panel-body">
					<form action="<?php echo base_url_admin().'menus/insert' ?>" method="POST">
						<div class="form-group">
							<?php foreach ($pages as $i => $page) {?>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="page-<?php echo $page['id'] ?>-<?php echo $page['title'] ?>"> <?php echo $page['title'] ?>
									</label>
								</div>
							<?php } ?>
						</div>
						<input type="hidden" name="last_no" value="<?php echo count($navmenu) ?>">
						<input type="submit" class="btn btn-default pull-right" value="Add to Menu">
					</form>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#gallery">
					<h4 class="panel-title">Gallery</h4>
				</a>
			</div>
			<div id="gallery" class="panel-collapse collapse">
				<div class="panel-body">
					<form action="<?php echo base_url_admin().'menus/insert' ?>" method="POST">
						<div class="form-group">
							<?php foreach ($gallery as $i => $page) {?>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="gallery-<?php echo $page['id'] ?>-<?php echo $page['title'] ?>"> <?php echo $page['title'] ?>
									</label>
								</div>
							<?php } ?>
						</div>
						<input type="hidden" name="last_no" value="<?php echo count($navmenu) ?>">
						<input type="submit" class="btn btn-default pull-right" value="Add to Menu">
					</form>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#link">
					<h4 class="panel-title">Link</h4>
				</a>
			</div>
			<div id="link" class="panel-collapse collapse">
				<div class="panel-body">
					<form action="<?php echo base_url_admin().'menus/insert' ?>" method="POST">
						<div class="form-group">
							<label>Text</label>
							<input type="text" name="title" class="form-control">
						</div>
						<div class="form-group">
							<label>Url</label>
							<input type="text" name="value" class="form-control">
						</div>
						<input type="hidden" name="type" class="form-control" value="url">
						<input type="hidden" name="last_no" value="<?php echo count($navmenu) ?>">
						<input type="submit" class="btn btn-default pull-right" value="Add to Menu">
					</form>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#categories">
					<h4 class="panel-title">Categories</h4>
				</a>
			</div>
			<div id="categories" class="panel-collapse collapse">
				<div class="panel-body">
					<form action="<?php echo base_url_admin().'menus/insert' ?>" method="POST">
						<div class="form-group">
							<?php foreach ($categories as $i => $cat) {?>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="category-<?php echo $cat['id'] ?>-<?php echo $cat['name'] ?>"> <?php echo $cat['name'] ?>
									</label>
								</div>
							<?php } ?>
						</div>
						<input type="hidden" name="last_no" value="<?php echo count($navmenu) ?>">
						<input type="submit" class="btn btn-default pull-right" value="Add to Menu">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<form action="<?php echo base_url_admin().'menus/update' ?>" method="POST" role="form">
			<div class="panel panel-default">
				<div class="panel-heading">Menu Structure</div>
				<div class="panel-body">
					<?php foreach ($navmenu as $index => $nav) {?>
						<div class="row show-grid">
							<div class="col-md-8">
								<input name="order[<?php echo $nav['id'] ?>]" class="order" maxlength='2' value="<?php echo $nav['order'] ?>">&nbsp;&nbsp;&nbsp;
								<?php echo ucwords($nav['title']) ?>
								<a href="<?php echo base_url_admin().'menus/delete?id='.$nav['id'] ?>" class="btn btn-danger pull-right delete" style="padding:2px 5px"><i class="glyphicon glyphicon-remove"></i></a>
							</div>
						</div>	
					<?php } ?>
					<input type="submit" class="btn btn-primary" value="Save Menus">
				</div>
			</div>
		</form>
	</div>
</div>
<style type="text/css">
	input.order{
		width:25px;
		text-align: center;
	}
</style>
<script type="text/javascript">
	$(function(){
		$('.delete').click(function(){
			c = confirm('Delete this menus?');
			if(!c){
				return false;
			}
		})
	})
</script>