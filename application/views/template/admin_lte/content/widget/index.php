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
					<table class="table table-bordered table-striped" id="tbWidget">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Tipe</th>
								<th>Icon Tipe</th>
								<th>Icon Value</th>
								<th>Deskripsi</th>
								<th>URL</th>
								<th>Order</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		/*function addCommas(nStr){
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2;
		}*/

		table = $('#tbWidget').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo $datatable_url; ?>",
			"order": [[0, 'asc']],
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