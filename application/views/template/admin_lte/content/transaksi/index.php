<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="col-lg-12 col-xs-12"><br>
					<form>
						<input type="hidden" id="id_layanan" name="id_layanan">
						<table>
							<tbody>
								<tr>
									<td>
										<input type="search" class="autocomplete nama form-control" id="nama_layanan" name="nama_layanan" style="margin-right:5px;" placeholder="Cari Layanan.." required="" autocomplete="off">
									</td>
									<td>
										<select name="harga" id="harga" class="form-control" style="margin-left:5px">
											<option value="normal">Normal</option>
											<option value="express">Express</option>
										</select>
									</td>
									<td>
										<input type="text" class="form-control" name="qty" id="qty" style="margin-left:10px;" placeholder="Quantity" required="required">
									</td>
									<td>
										<input type="button" id="submit" value="Pilih" name="submit" class="btn btn-primary" style="margin-top:0px;margin-left:15px;">
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div id="transaksi">
					
				</div><!-- /#transaksi -->
				<div class="col-lg-4 col-xs-12">
					<!--<form id="checkout" method="POST" action="http://go-laundry.com/demo/admin/transaksi/checkout">-->
					<form id="checkout" method="POST" action="<?php echo base_url_admin() ?>transaksi/finish">
						<div class="form-group">
							<label>Tanggal Selesai</label>
							<input type="text" class="form-control" id="tgl_selesai" name="tgl_selesai" required="" value="<?php echo date('d/m/Y') ?>">
							<p class="help-block"><em>dd-mm-yyyy</em></p>
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
							<input type="hidden" id="id_pelanggan" name="id_customer">
						</div>

						<div class="form-group" style="display:none">
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
							<select name="jenis_bayar" id="metode_pembayaran" class="form-control" style="margin-top:5px;">
								<option id="nanti" value="nanti">Bayar Nanti</option>
								<option value="tunai">Tunai</option>
								<!--option id="deposit" value="deposit">Deposit</option-->
							</select>
						</div>
						<div class="form-group" id="payment">
							<label>Bayar</label>
							<div class="input-group">
								<div class="input-group-addon">Rp.</div>
								<input type="text" class="form-control" id="amount2" name="bayar" placeholder="Amount" value="0">
								<div class="input-group-addon">,-</div>
							</div>
							<p class="help-block"><em>Pastikan anda memasukkan jumlah uang yang cukup</em></p>
						</div>
						<div class="form-group">
							<label>Catatan</label>
							<textarea name="catatan" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col-->
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('template/admin_lte/'); ?>/plugins/devbridge-autocomplete/content/styles.css">

<script type="text/javascript" src="<?php echo base_url('template/admin_lte/'); ?>/plugins/devbridge-autocomplete/src/jquery.autocomplete.js"></script>
<script type="text/javascript">
$(function(){
	$('#nama_layanan').autocomplete({
		// serviceUrl berisi URL ke controller/fungsi yang menangani request kita
		serviceUrl: '<?php echo base_url_admin() ?>layanan/autocomplete',
		minLength:2,
		// fungsi ini akan dijalankan ketika user memilih salah satu hasil request
		onSelect: function (suggestion) {
			$('#id_layanan').val(''+suggestion.id_layanan);
		}
	});

	$('#nama_pelanggan').autocomplete({
		// serviceUrl berisi URL ke controller/fungsi yang menangani request kita
		serviceUrl: '<?php echo base_url_admin() ?>customer/autocomplete',
		minLength:2,
		// fungsi ini akan dijalankan ketika user memilih salah satu hasil request
		onSelect: function (suggestion) {
			$('#id_pelanggan').val(''+suggestion.id_pelanggan);
		}
	});

	function load_transaksi(){
		$('#transaksi').load('<?php echo base_url_admin() ?>transaksi/load_table');
	}

	$('body').delegate('.delete_transaksi', 'click', function(event) {
		c = confirm("Hapus Layanan?");
		if(c){
			url = $(this).attr('href');

			$.ajax({
				type: "POST",
				url: url,
				success: function(msg){
					load_transaksi();
				}
			});
		}
		return false;
	});

	$("#submit").click(function(){
		var id_layanan 		= $("#id_layanan").val();
		var nama_layanan 	= $("#nama_layanan").val();
		var harga 			= $("#harga").val();
		var qty 			= $("#qty").val();
		$.ajax({
			type: "POST",
			url: '<?php echo base_url_admin() ?>transaksi/add_to_cart',
			data: 'id_layanan='+id_layanan+'&harga='+harga+'&qty='+qty,
			success: function(msg){
				document.getElementById('id_layanan').value ='';
				document.getElementById('nama_layanan').value ='';
				document.getElementById('qty').value ='';
				load_transaksi();
			}
		});
	});

	load_transaksi();

	var date = new Date();
	var currentMonth = date.getMonth();
	var currentDate = date.getDate();
	var currentYear = date.getFullYear();
	
	$("#tgl_selesai").datepicker({
		startDate: new Date(),
		format: 'dd/mm/yyyy',
	});

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

	$('#persentase_diskon').keyup(function(){
		if ($(this).val() > 100){
			alert("Maksimal 100");
			$(this).val('100');
		}
	});

	$('form#checkout').submit(function(event) {
		$.ajax({
			type: "POST",
			url: '<?php echo base_url_admin() ?>transaksi/check_transaksi',
			success: function(msg){
				if(msg.success == "true") return true;
				else{
					alert('Silahkan tambahkan Layanan terlebih dahulu.');
					return false;
				}
			},
			dataType: "json"
		});
	});
});
</script>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Tambah Pelanggan Baru</h4>
				<div class="modal-body">
					<form class="daftar">
						<input type="hidden" name="redirect" value="false">
						<div class="form-group">
							<label>Nama<span style="color:red"><sup>*</sup></span></label>
							<input type="text" class="form-control" id="nama_customer" name="nama_customer" placeholder="Nama" required="required">
						</div>
						<div class="form-group">
							<label>Alamat<span style="color:red"><sup>*</sup></span></label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required="required">
						</div>
						<div class="form-group">
							<label>HP<span style="color:red"><sup>*</sup></span></label>
							<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="HP" required="required">
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
							<button type="button" id="batal" class="btn btn-default" data-dismiss="modal">Batal</button>
							<input type="submit" id="simpan" class="btn btn-primary" value="Simpan">                                                        
							<p class="help-block pull-left"><span style="color:red"><sup>*</sup></span> Wajib Diisi</p><br>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('form.daftar').submit(function(event) {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url_admin() ?>customer/insert",
			data: $('form.daftar').serialize(),
			success: function(msg){
				if(msg.success == "true") alert('Berhasil menambahkan pelanggan baru');
				else alert('Gagal menambahkan pelanggan baru');

				$('.modal-footer #batal').click();
			},
			dataType: "json"
		});
		return false;
	});
})
</script>