<!-- DATA TABLES -->
<link href="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="row">
	<?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
	<?php } ?>
	<div class="col-sm-12">
		<?php echo button_access('add', uri_string()); ?>
	</div>
	<div class="col-sm-12">&nbsp;</div>
	<div class="col-sm-12">
		<table class="table table-striped table-hover" id="tbgroup">
			<thead>
				<tr>
					<th class="dt-head-center">No.</th>
					<th class="dt-head-center">Group</th>
					<th class="dt-head-center">Aksi</th>
				</tr>
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
	table = $('#tbgroup').DataTable({
		// "responsive": true,
		"processing": true,
		"serverSide": true,
		"ajax": "<?= base_url('index.php/group/datatable'); ?>",
		"order": [[1, 'asc']],
		// "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
		"pageLength": 25,
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$('td:eq(0)', nRow).html(table.page.info().start + iDisplayIndex + 1); // numbering
		}
	});
});
$(function(){
	$('body').delegate('.delete', 'click', function(event) {
		c = confirm('Delete this group?');
		if(!c){
			return false;
		}
	});
})
</script>