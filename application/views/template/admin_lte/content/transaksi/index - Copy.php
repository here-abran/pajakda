<!-- DATA TABLES -->
<link href="<?php echo base_url('template/admin_lte/'); ?>/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php if($this->session->flashdata() != NULL){ ?>
<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<?php echo $this->session->flashdata('notif_msg') ?>
</div>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laundry Management System</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<!--Morris Chart-->
	<link href="../../assets/css/morris.css" rel="stylesheet" type="text/css">
	<!--jvectormaps -->
	<link href="../../assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
	<!-- Datepicker -->
	<link href="../../assets/css/datepicker3.css" rel="stylesheet" type="text/css">
	<!--Date range picker -->
	<link href="../../assets/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
	<!--dataTables-->
	<link href="../../assets/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

	<style>
	.error{
		display: none;
		margin-left: 10px;
	}

	.error_show{
		color: red;
		margin-left: 10px;
	}
	</style>

	<!-- Memanggil file .js untuk proses autocomplete -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript" src="../../assets/js/jquery.autocomplete.js"></script>
	<!-- Memanggil file .js untuk Validasi Form -->
	<script type="text/javascript" src="../../assets/js/jquery.validate.js"></script>
	<!-- Memanggil file .css untuk style saat data dicari dalam filed -->
	<link href="../../assets/css/jquery.autocomplete.css" rel="stylesheet">

	<!--Javasript Auto Complete untuk mencari nama layanan-->
	<script type="text/javascript">
	<!--var site = "http://go-laundry.com/demo/admin";-->
	var site = "#";
	$(function(){
		$('.autocomplete').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site+'/autocomplete/search',
                        minLength:2,
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function (suggestion) {
                            $('#id_layanan').val(''+suggestion.id_layanan); // membuat id 'v_nim' untuk ditampilkan
                        }
                    });
	});
	</script>

	<!--Javasript Auto Complete untuk mencari nama pelanggan/customer-->
	<script type="text/javascript">
	<!--var site = "http://go-laundry.com/demo/admin";-->
	var site = "#";
	$(function(){
		$('#nama_pelanggan').autocomplete({
                            // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                            serviceUrl: site+'/autocomplete/cari',
                            minLength:2,
                            // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                            onSelect: function (suggestion) {
                                $('#id_pelanggan').val(''+suggestion.id_pelanggan); // membuat id 'v_nim' untuk ditampilkan
                            }
                        });
	});
	</script>

	<!--Javasript untuk menyimpan nama layanan di dalam keranjang/cart Codeigniter tanpa reload halaman-->
	<script>
	<!--var site = "http://go-laundry.com/demo/admin";-->
	var site = "#";
	$(document).ready(function() {
		$("#submit").click(function(){
			var id_layanan = $("#id_layanan").val();
			var nama_layanan = $("#nama_layanan").val();
			var harga = $("#harga").val();
			var qty = $("#qty").val();
			$.ajax({
				type: "POST",
				url: site+'/transaksi/add_to_cart',
				data: 'id_layanan='+id_layanan+'&harga='+harga+'&qty='+qty,
				success: function(msg){
					document.getElementById('nama_layanan').value='';
					document.getElementById('qty').value='';
					$('#transaksi').load('transaksi #transaksi', function() {
					}); 
				}
			});  
		});
	});
	</script>

	<!--Javasript untuk menghapus layanan yang ada di dalam keranjang/cart Codeigniter tanpa reload halaman-->
	<script>
	function ConfirmDelete(str) {
		var id = str;
		$.ajax({
			type: "GET",
			url: "transaksi/delete/"+id
		}).done(function( data ) {
			$('#transaksi').load('transaksi #transaksi', function() {
			});
		});
	}
	</script>

	<!--Javasript untuk menambah pelanggan baru dengan Popup tanpa reload halaman-->
	<script>
	$(document).ready(function() {
		$('#simpan').click(function() {
			var nama    = $("#nama").val();
			var alamat  = $("#alamat").val();
			var hp      = $("#hp").val();
			var email   = $("#email").val();
			var status  = $("#status").val();
			var catatan = $("#catatan").val();
			document.getElementById('nama').required;
			$.ajax({
				type: "POST",
				url: "pelanggan/popup",
				data: $('form.daftar').serialize(),
				success: function(msg){
                        //$("#myModal").modal('hide');
                    }
                });
		});
	});
	</script>

	<!--Javasript untuk memilih Diskon-->
	<script>
	$(document).ready(function() {
		var select = document.getElementById('diskon'),
		onChange = function(event) {


			var persentase = this.options[this.selectedIndex].value == '%';
			var rupiah = this.options[this.selectedIndex].value == 'rp';

			document.getElementById('persentase').style.display = persentase ? 'block' : 'none';
			document.getElementById('rupiah').style.display = rupiah ? 'block' : 'none';
		};

                // attach event handler
                if (window.addEventListener) {
                	select.addEventListener('change', onChange, false);
                } else {
                    // of course, IE < 9 needs special treatment
                    select.attachEvent('onchange', function() {
                    	onChange.apply(select, arguments);
                    });
                }
            });
	</script>

	<script>
	$(document).ready(function() {
		var select = document.getElementById('metode_pembayaran'),
		onChange = function(event) {
			var shown = this.options[this.selectedIndex].value == 'nanti';
                    //var shown2 = this.options[this.selectedIndex].value == 'deposit';

                    document.getElementById('payment').style.display = shown ? 'none' : 'block';
                    //document.getElementById('payment').style.display = shown2 ? 'none' : 'block';
                };

                // attach event handler
                if (window.addEventListener) {
                	select.addEventListener('change', onChange, false);
                } else {
                    // of course, IE < 9 needs special treatment
                    select.attachEvent('onchange', function() {
                    	onChange.apply(select, arguments);
                    });
                }
            });
	</script>

	<!--Javasript untuk proses simpan transaksi ke dalam Database-->
	<script>
	$(document).ready(function() {
		$('#simp').click(function() {
			var id_pelanggan    = $("#id_pelanggan").val();
			var tgl_selesai     = $("#tgl_selesai").val();
			$.ajax({
				type: "POST",
				url: "transaksi/checkout",
				data: 'id_pelanggan='+id_pelanggan+'&tgl_selesai='+tgl_selesai
			}).done(function( data ) {
				alert('Berhasil');
			});
		});
	});
	</script>

	<script>
	$(function() {
		var date = new Date();
		var currentMonth = date.getMonth();
		var currentDate = date.getDate();
		var currentYear = date.getFullYear();
		$("#tgl_selesai").datepicker({
			startDate:new Date(),
			dateFormat: 'dd/mm/yy',
		});
	});
	</script>

	<script>
	$(document).ready(function() {
		$('#persentase_diskon').keyup(function(){
			if ($(this).val() > 100){
				alert("Maksimal 100");
				$(this).val('100');
			}
		});
	});
	</script>

	<!-- Main content -->
	<section class="content" style="padding-left:0px; padding-right:0px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<div class="col-lg-12 col-xs-12"><br>
							<form>
								<input type="hidden" id="id_layanan" name="id_layanan">
								<table>
									<tbody><tr>
										<td><input type="search" class="autocomplete nama form-control" id="nama_layanan" name="nama_layanan" style="margin-top:5px; margin-right:5px;" placeholder="Cari Layanan.." required="" autocomplete="off"></td>
										<td>
											<select name="harga" id="harga" class="form-control" style="margin-top:5px; margin-left:5px">
												<option value="normal">Normal</option>
												<option value="express">Express</option>
											</select>
										</td>
										<td><input type="text" class="form-control" name="qty" id="qty" style="margin-top:5px; margin-left:10px;" placeholder="Quantity" required="required"></td>
										<td><input type="button" id="submit" value="Pilih" name="submit" class="btn btn-primary" style="margin-top:5px; margin-left:15px;"></td>
									</tr>
								</tbody></table>
							</form>
						</div>
						<div id="transaksi">
							<div class="box-body table-responsive col-xs-8">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="20">No</th>
											<th>Nama Layanan</th>
											<th>Qty</th>
											<th>Unit</th>
											<th>Harga</th>
											<th>Pilihan Layanan</th>
											<th>Sub Total</th>
											<th width="10">Hapus</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>

								<div class="form-group">
									<table class="table table-bordered table-striped">
										<tbody><tr>
											<td><label>Jumlah item</label></td>
											<td style="text-align:center">:</td>
											<td style="font-size:20px; text-align:center"><span><strong>0</strong></span></td>
										</tr>
										<tr>
											<td> <label>Total</label></td>
											<td style="text-align:center">:</td>
											<td style="font-size:25px; text-align:center"><span><strong>Rp. 0</strong></span></td>
										</tr>
									</tbody></table>
								</div>
							</div>
						</div><!-- /#transaksi -->
						<div class="col-lg-4 col-xs-12">
							<!--<form id="checkout" method="POST" action="http://go-laundry.com/demo/admin/transaksi/checkout">-->
							<form id="checkout" method="POST" action="#">
								<div class="form-group">
									<label>Tanggal Selesai</label>
									<input type="text" class="form-control" id="tgl_selesai" name="tgl_selesai" required="">
									<p class="help-block"><em>mm-dd-yyyy</em></p>
								</div>
								<div class="form-group">
									<label>Pelanggan</label><br>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
										<i class="fa fa-users"></i> Tambah Baru?
									</button>
								</div>
								<div class="form-group">
									<label>Pilih Pelanggan</label>
									<input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Cari.." required="" autocomplete="off">
									<input type="hidden" id="id_pelanggan" name="id_pelanggan">
								</div>

								<div class="form-group">
									<label>Diskon</label> <!--Memilih metode pembayaran untuk laundry-->
									<select name="diskon" id="diskon" class="form-control" style="margin-top:5px;">
										<option id="nodiskon" value="nodiskon">Tanpa Diskon</option>
										<option id="persentase1" value="%">%</option>
										<option id="rupiah1" value="rp">Rp</option>
									</select>
								</div>
								<div class="form-group" id="persentase" style="display:none">
									<label>Masukkan % diskon</label>
									<div class="input-group">
										<div class="input-group-addon">%</div>
										<input type="text" class="form-control" id="persentase_diskon" name="persentase_diskon" placeholder="Amount">
									</div>
								</div>
								<div class="form-group" id="rupiah" style="display:none">
									<label>Masukkan Rupiah diskon</label>
									<div class="input-group">
										<div class="input-group-addon">Rp.</div>
										<input type="text" class="form-control" id="amount1" name="rupiah_diskon" placeholder="Amount">
										<div class="input-group-addon">,-</div>
									</div>
								</div>
								<div class="form-group">
									<label>Metode Pembayaran</label> <!--Memilih metode pembayaran untuk laundry-->
									<select name="metode_pembayaran" id="metode_pembayaran" class="form-control" style="margin-top:5px;">
										<option value="tunai">Tunai</option>
										<!--option id="deposit" value="deposit">Deposit</option-->
										<option id="nanti" value="nanti">Bayar Nanti</option>
									</select>
								</div>
								<div class="form-group" id="payment">
									<label>Bayar</label>
									<div class="input-group">
										<div class="input-group-addon">Rp.</div>
										<input type="text" class="form-control" id="amount2" name="bayar" placeholder="Amount" required="">
										<div class="input-group-addon">,-</div>
									</div>
									<p class="help-block"><em>Pastikan anda memasukkan jumlah uang yang cukup</em></p>
								</div>
								<div class="form-group">
									<label>Catatan</label>
									<textarea name="catatan" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<button type="simpan2" class="btn btn-primary" id="simpan2">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /.box -->

			</div>
			<!-- /.col-->
		</div>
		<!-- ./row -->
	</section>
	<!-- /.content -->

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

	<!-- Modal -->
	<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Tambah Pelanggan Baru</h4>
					<div class="modal-body">
						<form class="daftar">
							<div class="form-group">
								<label>Nama<span style="color:red"><sup>*</sup></span></label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required="">
							</div>
							<div class="form-group">
								<label>Alamat<span style="color:red"><sup>*</sup></span></label>
								<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required="">
							</div>
							<div class="form-group">
								<label>HP<span style="color:red"><sup>*</sup></span></label>
								<input type="number" class="form-control" id="hp" name="hp" placeholder="HP" required="">
								<p class="help-block"><strong>Perhatian!</strong> Harap masukan nomor hp yang masih aktif</p>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control" id="status">
									<option value="Aktif">Aktif</option>
									<option value="Tidak Aktif">Tidak Aktif</option>
								</select>
							</div>
							<div class="form-group">
								<label>Catatan</label>
								<input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan">
							</div>
							<div class="modal-footer">
								<button type="button" id="batal" name="batal" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" id="simpan" name="simpan" class="btn btn-primary" value="Simpan">                                                        
								<p class="help-block pull-left"><span style="color:red"><sup>*</sup></span> Wajib Diisi</p><br>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>