<!-- DATA TABLES -->
<link href="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php if($this->session->flashdata() != NULL){ ?>
	<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif_msg') ?>
	</div>
<?php } ?>
<div class="row">
	<div class="col-sm-12">
		<!-- <a class="btn btn-primary" href="<?php //echo site_url('admin/rkp/add');?>" role="button" aria-label="Tambah data" data-toggle="tooltip" data-placement="bottom" title="Tambah data"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>-->
		<?php echo button_access('add', uri_string(), ''); ?>
	</div>
	<div class="col-sm-12">&nbsp;</div>
	<div class="col-sm-12">
		<table class="table table-striped table-hover" id="tbuser">
			<thead>
				<th>No</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Action</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	table = $('#tbuser').DataTable({
		// "responsive": true,
		"processing": true,
		"serverSide": true,
		"ajax": "<?= base_url('index.php/user/datatable'); ?>",
		"order": [[1, 'asc']],
		// "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
		"pageLength": 25,
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$('td:eq(0)', nRow).html(table.page.info().start + iDisplayIndex + 1); // numbering
		}
	});
	//$('[data-toggle="tooltip"]').tooltip();
});
$(function(){
	$('body').delegate('.delete', 'click', function(event) {
		c = confirm('Delete this user?');
		if(!c){
			return false;
		}
	});
})
</script>