<section id="inner-headline">
	<div class="container">
		<div class="row"></div>
	</div>
</section>
<section id="content">
	<div class="container">
		<?php if($type == ''){ ?>
		<div class="row">
			<div class="col-lg-12">
				<h3>Layanan</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquam luctus fringilla. Fusce tempus mauris ac gravida tempor. Quisque feugiat pellentesque nulla nec mattis. Maecenas eget blandit erat. Nulla dignissim ultricies lorem, id fringilla sapien suscipit ac. Integer vel vehicula odio. Quisque convallis ullamcorper vehicula. Donec ac gravida libero. Donec iaculis, augue non lobortis sodales, elit odio ultricies sapien, a elementum purus sem id mi. Donec efficitur, nunc ut ornare faucibus, massa ex accumsan augue, ut blandit diam mauris quis ipsum. Nunc rutrum purus non ultrices pretium. Suspendisse rhoncus tincidunt dolor, eleifend venenatis tortor ornare eget. Pellentesque in lobortis lacus. </p>
				<div class="layanan-list">
					<ul class="pagination" style="margin-bottom: 0px;">
						<li><a href="<?php echo base_url() ?>index.php/layanan/add?type=bphtb">BPHTB</a></li><!-- class="active" -->
						<li><a href="#">PBB</a></li>
						<li><a href="#">Hotel</a></li>
						<li><a href="#">Restoran</a></li>
						<li><a href="#">Hiburan</a></li>
						<li><a href="#">Reklame</a></li>
						<li><a href="#">PPJ</a></li>
						<li><a href="#">MBLB</a></li>
						<li><a href="#">Parkir</a></li>
						<li><a href="#">Air Tanah</a></li>
						<li><a href="#">Sarang Burung Walet</a></li>
					</ul>
					<!-- <ul class="pagination" style="margin-top: 0px;">
						<li><a href="#">Pajak </a></li>
						<li><a href="#">Pajak Sarang Burung Walet</a></li>
					</ul> -->
				</div>
			</div>
		</div>
		<?php }elseif($type == 'bphtb'){ ?>
		<div class="row row-nomargin">
			<div class="col-lg-12">
				<h3>Layanan SSPD</h3>
				<form class="" action="<?php echo base_url(); ?>index.php/layanan/cetak" method="GET" id="sspd_form">
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label for="noNik">No NIK Wajib Pajak</label>
								<input type="text" class="form-control" name="nik">
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label for="noSspd">No Formulir SSPD</label>
								<input type="text" class="form-control" name="noFormulir">
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label for="no_sspd">&nbsp;</label>
								<input type="submit" class="form-control btn btn-theme" value="Cetak Ulang">
							</div>
						</div>
						<div class="col-lg-3"></div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="no_sspd">&nbsp;</label>
								<a href="" class="form-control btn btn-theme">Isi Formulir SSPD Baru</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row row-nomargin">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-gray">
						<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/layanan/insert" method="POST">
							<input type="hidden" name="type" value="sspd">
							<table class="table-sspd">
								<tbody>
									<!-- <tr>
										<td colspan="3"></td>
										<td colspan="2"><h4>SURAT SETORAN PAJAK DAERAH<br/>(SSPD)<br/>BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN</h4></td>
										<td></td>
									</tr> -->
									<tr>
										<td>A.</td>
										<td>1.</td>
										<td style="width: 130px;">No NIK Wajib Pajak</td>
										<td colspan="6"><input type="text" class="form-control" name="wpNik" placeholder=""></td>
									</tr>
									<tr>
										<td></td>
										<td>2.</td>
										<td style="width: 130px;">Nama Wajib Pajak</td>
										<td colspan="6"><input type="text" class="form-control" name="wpNama" placeholder=""></td>
									</tr>
									<tr>
										<td></td>
										<td>3.</td>
										<td>Alamat Wajib Pajak</td>
										<td colspan="3"><input type="text" class="form-control" name="wpAlamat" placeholder=""></td>
										<td>Blok/Kav/Nomor</td>
										<td><input type="text" class="form-control" name="wpBlok" placeholder=""></td>
									</tr>
									<tr>
										<td></td>
										<td>4.</td>
										<td>RT/RW</td>
										<td><input type="text" class="form-control" name="wpRtRw" placeholder=""></td>
										<td>5. Kabupaten</td>
										<td><select class="form-control" name="wpKabupaten" id="wpKabupaten" required="required" style="width: 100%"></select></td>
										<td>6. Kecamatan</td>
										<td><select class="form-control select2" name="wpKecamatan" id="wpKecamatan" required="required" style="width: 100%"></select></td>
									</tr>
									<tr>
										<td></td>
										<td>7.</td>
										<td>Kelurahan/Desa</td>
										<td><select class="form-control select2" name="wpKelurahan" id="wpKelurahan" required="required" style="width: 100%"></select></td>
										<td>8. No. Telp/HP</td>
										<td><input type="text" class="form-control" name="wpTelp" placeholder=""></td>
										<td>9. Kode Pos</td>
										<td><input type="text" class="form-control" name="wpKodepos" placeholder=""></td>
									</tr>
									<!-- <tr>
										<td></td>
										<td>4.</td>
										<td>Kelurahan/Desa</td>
										<td><select class="form-control select2" name="wpKelurahan" required="required"></select></td>
										<td>5. RT/RW</td>
										<td><input type="text" class="form-control" name="wpRtRw" placeholder=""></td>
										<td>6. Kecamatan</td>
										<td><input type="text" class="form-control" name="wpKecamatan" placeholder=""></td>
									</tr>
									<tr>
										<td></td>
										<td>7.</td>
										<td>Kabupaten</td>
										<td><input type="text" class="form-control" name="wpKabupaten" placeholder=""></td>
										<td>8. No. Telp/HP</td>
										<td><input type="text" class="form-control" name="wpTelp" placeholder=""></td>
										<td>9. Kode Pos</td>
										<td><input type="text" class="form-control" name="wpKodepos" placeholder=""></td>
									</tr> -->
									<tr>
										<td colspan="8">&nbsp;</td>
									</tr>
									<tr>
										<td>B.</td>
										<td colspan="7">Objek Pajak</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="7">
											<a href="#" class="btn btn-theme" data-toggle="modal" data-target="#modalObjekPajak">+ Tambah Objek Pajak</a><br/><br/>
											<table class="table-objek-pajak">
												<thead>
													<tr>
														<td style="width:40px">No</td>
														<td>NOP</td>
														<td>Nomor Sertifikat</td>
														<td>Harga Transaksi</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan="4">Belum ada Objek Pajak</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="8">&nbsp;</td>
									</tr>
									<tr>
										<td>C.</td>
										<td colspan="6">Perhitungan BPHTB (<i>Hanya diisi berdasarkan Perhitungan Wajib Pajak</i>)</td>
										<td><i>Dalam Rupiah</i></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="6">Nilai Perolehan Objek Pajak (NPOP)</td>
										<td><input type="text" name="wpNpop" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="6">Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)</td>
										<td><input type="text" name="wpNpoptkp" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="5">Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)</td>
										<td><i>angka 1 - angka 2</i></td>
										<td><input type="text" name="wpNpopkp" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="5">Bea Perolehan Hak atas Tanah dan Bangunan yang terutang</td>
										<td><i>5% x angka 3</i></td>
										<td><input type="text" name="wpTerhutang" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="5">Pengenaan 50% karena <input type="radio" name="wpPersenType" value="waris">waris / <input type="radio" name="wpPersenType" value="hibah_wasiat"> hibah wasiat / <input type="radio" name="wpPersenType" value="pemberian"> pemberian hak pengelolaan</td>
										<td><i>50% x angka 4</i></td>
										<td><input type="text" name="wpPersenValue" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="6">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar</td>
										<td><input type="text" name="wpBayar" class="form-control"></td>
									</tr>
									<tr>
										<td colspan="8">&nbsp;</td>
									</tr>
									<tr>
										<td>D.</td>
										<td colspan="7">Jumlah Setoran berdasarkan : (<i>Beri tanda v pada kotak yang sesuai</i>)</td>
									</tr>
									<tr>
										<td></td>
										<td><input type="checkbox" name=""></td>
										<td colspan="6">a. Penghitungan Wajib Pajak</td>
									</tr>
									<tr>
										<td></td>
										<td><input type="checkbox" name=""></td>
										<td colspan="2">b. <input type="radio" name="" value="stpd"> STPD / <input type="radio" name="" value="skpdkb"> SKPDKB / <input type="radio" name="" value="skpdkbt"> SKPDKBT</td>
										<td>Nomor</td>
										<td><input type="text" name="" class="form-control"></td>
										<td>Tanggal</td>
										<td><input type="text" name="" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="checkbox" name=""></td>
										<td colspan="2">c. Pengurangan dihitung sendiri karena</td>
										<td><input type="text" name="" class="form-control"></td>
										<td colspan="4"></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="checkbox" name=""></td>
										<td colspan="6">d. <input type="text" class="form-control" name="" style="width: 95%;display:inline;"></td>
									</tr>
									<tr>
										<td colspan="8">&nbsp;</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2">Jumlah Pembayaran</td>
										<td colspan="5"><input type="text" class="form-control" name=""></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2">Terbilang</td>
										<td colspan="5" id="terbilang"></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="7" class="text-center"><input type="submit" value="SUBMIT" class="btn btn-theme submit"></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="modalObjekPajak" class="modal fade" role="dialog">
			<div class="modal-dialog" style="width: 1100px;">
				<form id="form-objek-pajak">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Tambah Objek Pajak</h4>
						</div>
						<div class="modal-body">
							<table class="input-objek-pajak">
								<tr>
									<td>1.</td>
									<td>NOP PBB</td>
									<td colspan="4"><input type="text" name="nomorObjekPajak" class="form-control"></td>
									<td><input type="checkbox" name="checkNOP" id="checkNOP"> Gunakan NOP untuk SSPD</td>
								</tr>
								<tr>	
									<td>2.</td>
									<td>Lokasi Objek Pajak</td>
									<td colspan="3"><input type="text" name="lokasiObjekPajak" class="form-control"></td>
									<td>Blok/Kav/Nomor</td>
									<td><input type="text" name="blokObjekPajak" class="form-control"></td>
								</tr>
								<tr>
									<td>3.</td>
									<td style="width: 125px;">Desa</td>
									<td><input type="text" name="desaObjekPajak" class="form-control"></td>
									<td style="width: 70px;">4. RT/RW</td>
									<td><input type="text" name="rtObjekPajak" class="form-control"></td>
									<td style="width: 115px;">5. Kecamatan</td>
									<td><input type="text" name="kecamatanObjekPajak" class="form-control"></td>
								</tr>
								<tr>
									<td>6.</td>
									<td>Kabupaten</td>
									<td colspan="3"><input type="text" name="kabupatenObjekPajak" class="form-control"></td>
									<td>Kode Pos</td>
									<td><input type="text" name="kodeposObjekPajak" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="7">Penghitungan NJOP PBB P2</td>
								</tr>
								<tr>
									<td colspan="7">
										<table id="tabel-penghitungan-njop">
											<tr>
												<td style="width: 120px;" class="text-center">Objek Pajak</td>
												<td class="text-center"><b>Luas</b><br/>Diisi luas tanah dan atau bangunan yang haknya diperoleh</td>
												<td class="text-center"><b>NJOP PBB P2 / m2</b><br/>Diisi berdasarkan SPPT PBB P2 tahun terjadinya perolehan hak / Tahun</td>
												<td class="text-center">Luas x NJOP PBB P2 / m2</td>
											</tr>
											<tr>
												<td rowspan="2">Tanah (bumi)</td>
												<td class="text-center">7. Luas Tanah (bumi)</td>
												<td class="text-center">9. NJOP tanah (bumi)/m2</td>
												<td class="text-center"><i>11. (angka 7 x angka 9)</i></td>
											</tr>
											<tr>
												<td><input type="text" name="luasTanahObjekPajak" class="form-control"></td>
												<td><input type="text" name="njopTanahObjekPajak" class="form-control"></td>
												<td><input type="text" id="luasxnjoptanah" class="form-control"></td>
											</tr>
											<tr>
												<td rowspan="2">Bangunan</td>
												<td class="text-center">8. Luas Bangunan</td>
												<td class="text-center">10. NJOP bangunan/m2</td>
												<td class="text-center"><i>12. (angka 8 x angka 10)</i></td>
											</tr>
											<tr>
												<td><input type="text" name="luasBangunanObjekPajak" class="form-control"></td>
												<td><input type="text" name="njopBangunanObjekPajak" class="form-control"></td>
												<td><input type="text" id="luasxnjopbangunan" class="form-control"></td>
											</tr>
											<tr>
												<td colspan="3" class="noborder"></td>
												<td class="text-center"><i>13. (angka 11 x angka 12)</i></td>
											</tr>
											<tr>
												<td colspan="3" class="noborder text-right">NJOP PBB P2 </td>
												<td><input type="text" id="totalHitung" class="form-control"></td>
											</tr>
											<tr>
												<td colspan="3" class="noborder">14. Jenis Perolehan hak atas tanah dan / atau bangunan</td>
												<td><input type="text" id="jenisPerolehanObjekPajak" class="form-control"></td>
											</tr>
											<tr>
												<td colspan="3" class="noborder">15. Harga transaksi yang terjadi pada perolehan hak atas tanah dan/atau bangunan/Nilai pasar</td>
												<td><input type="text" id="hargaObjekPajak" class="form-control"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>16.</td>
									<td colspan="2">Nomor Sertifikat Tanah</td>
									<td colspan="4"><input type="text" name="sertifikatObjekPajak" class="form-control"></td>
								</tr>
							</table>
							<br/>
							<center>
								<input type="submit" class="btn btn-theme submit" value="Submit">
							</center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div> -->
		<div id="modalObjekPajak" class="modal fade" role="dialog">
			<div class="modal-dialog" style="width: 800px;">
				<!-- Modal content-->
				<form id="form-objek-pajak">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Tambah Objek Pajak</h4>
						</div>
						<div class="modal-body">
							<table class="input-objek-pajak">
								<tr>
									<td>1. NOP PBB</td>
									<td colspan="2"><input type="text" name="nomorObjekPajak" class="form-control">
									<td><input type="checkbox" name="checkNOP" id="checkNOP"> Gunakan NOP untuk SSPD</td></td>
								</tr>
								<tr>
									<td>2. Hak atas Tanah</td>
									<td><select class="form-control" id="hakAtasTanah" name="hakAtasTanah" style="width: 100%;"></select></td>
									<td>3. Nomor Sertifikat Tanah</td>
									<td><input type="text" name="nomorSertifikat" class="form-control"></td>
								</tr>
								<tr>
									<td>4. Luas Bumi</td>
									<td><input type="text" name="luasTanahObjekPajak" class="form-control"></td>
									<td>5. NJOP Bumi</td>
									<td><input type="text" name="njopTanahObjekPajak" class="form-control"></td>
								</tr>
								<tr>
									<td>6. Luas Bangunan</td>
									<td><input type="text" name="luasBangunanObjekPajak" class="form-control"></td>
									<td>7. NJOP Bangunan</td>
									<td><input type="text" name="njopBangunanObjekPajak" class="form-control"></td>
								</tr>
							</table>
							<br/>
							<center>
								<input type="submit" class="btn btn-theme submit" value="Submit">
								<button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
							</center>
						</div>
						<!-- <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div> -->
					</div>
				</form>
			</div>
		</div>
		<?php } ?>
	</div>
</section>
<!-- Modal -->
<style type="text/css">
	div.col-lg-12{
		text-align: center;
	}
	div.layanan-list{
		width: 100%;
		text-align: center;
	}
	ul.pagination li{
		text-align:center;
	}
	ul.pagination li a{ 
		/*width: 33.33%;*/
	}
	table.table-sspd, table.input-objek-pajak{
		width: 100%;
		border-collapse: collapse;
		text-align: left;
	}
	table.table-sspd td, table.input-objek-pajak td{
		padding: 1px;
	}
	table.table-sspd input[type="text"]{
		width: 100%;
	}
	table.table-objek-pajak, table.input-objek-pajak{
		width: 100%;
		border-collapse: collapse;
		text-align: left;
	}
	table.table-objek-pajak td, table.table-objek-pajak th{
		padding: 5px;
		border: 1px solid #ccc;
		text-align: left;
	}
	input.submit, button.cancel{
		padding: 10px 60px;
	}
	form#sspd_form{
		margin: 0px;
	}
	form#sspd_form label{
		float: left;
	}
	div.row-nomargin{
		margin: 0px;
	}
	table#tabel-penghitungan-njop{
		border-collapse: collapse;
	}
	table#tabel-penghitungan-njop td{
		border:1px solid #ccc;
	}
	table#tabel-penghitungan-njop td.noborder{
		border:none;
	}
</style>