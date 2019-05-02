<!-- DATA TABLES -->
<link href="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<?php echo button_access('add', uri_string()); ?>
			</div>
			<div class="box-body table-responsive">
				<?php if($this->session->flashdata() != NULL){ ?>
				<div class="col-md-12">
					<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('notif_msg') ?>
					</div>
				</div>
				<?php } ?>
				
				<div class="col-md-12">
					<table class="table table-bordered table-striped" id="tblayanan">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Layanan</th>
								<th>Unit</th>
								<th>Harga Normal</th>
								<th>Harga Express</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Nama Layanan</th>
								<th>Unit</th>
								<th>Harga Normal</th>
								<th>Harga Express</th>
								<th>Aksi</th>
							</tr>
						</tfoot>
					</table>
					<p class="help-block"><em><strong>Note:</strong> <br>Pada bagian ini anda bisa membuat Layanan dan Harga pada usaha Laundry anda.</em></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
	table = $('#tblayanan').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo $datatable_url; ?>",
		"order": [[1, 'asc']],
		"pageLength": 25,
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$('td:eq(0)', nRow).html(table.page.info().start + iDisplayIndex + 1);//numbering
		}
	});

	// $('[data-toggle="tooltip"]').tooltip();

	$('body').delegate('.delete', 'click', function(event) {
		c = confirm('Yakin ingin menghapus data ini?');
		if(!c){
			return false;
		}
	});
});
</script>