<div class="row row-nomargin">
	<div class="col-lg-12">
		<h3>Layanan SSPD BPHTB</h3>
		<div class="row"  id="section-pilihan">
			<div class="col-sm-offset-3 col-sm-3">
				<button id="tombol-cetak-ulang" class="form-control btn btn-theme">Cetak Ulang</button>
			</div>
			<div class="col-sm-3">
				<button id="tombol-form-baru" class="form-control btn btn-theme">Isi Formulir SSPD Baru</button>
			</div>
		</div>
	</div>
</div>
<div class="row row-nomargin" id="section-cetak-ulang" style="display: none">
	<div class="col-lg-12">
		<form class="" action="<?php echo base_url(); ?>index.php/layanan/cetak" method="GET" id="sspd_form">
			<div class="row">
				<div class="col-lg-offset-4 col-lg-2">
					<div class="form-group">
						<label for="noSspd">No Formulir SSPD</label>
						<input type="text" class="form-control" name="noForm" maxlength="12" required="required">
						<input type="hidden" class="form-control" name="type" value="bphtb">
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="noNik">No NIK Wajib Pajak</label>
						<input type="text" class="form-control" name="nik" maxlength="20" required="required">
					</div>
				</div>
<!-- 				<div class="col-lg-2">
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
				</div> -->
			</div>
			<div class="row">
				<div class="col-lg-offset-4 col-lg-2">
					<!-- <input type="submit" class="form-control btn btn-theme" value="Cetak Ulang"> -->
				</div>
				<div class="col-lg-2">
					<input type="submit" class="form-control btn btn-theme" value="Cetak Ulang">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row row-nomargin" id="section-form-baru" style="display: none">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-gray">
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/layanan/insert" method="POST" id="form-sspd">
					<input type="hidden" name="type" value="sspd">
					<table class="table-sspd">
						<tbody id="step1" style="display: none">
							<!-- <tr>
								<td colspan="3"></td>
								<td colspan="2"><h4>SURAT SETORAN PAJAK DAERAH<br/>(SSPD)<br/>BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN</h4></td>
								<td></td>
							</tr> -->
							<tr>
								<td>A.</td>
								<td>1.</td>
								<td style="width: 140px;">No NIK Wajib Pajak <span class="required">*</span></td>
								<td colspan="6"><input type="text" maxlength="16" class="form-control" name="sspdNik" placeholder="" required="required"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.</td>
								<td style="width: 140px;">Nama Wajib Pajak <span class="required">*</span></td>
								<td colspan="6"><input maxlength="255" type="text" class="form-control" name="sspdNama" placeholder="" required="required"></td>
							</tr>
							<tr>
								<td></td>
								<td>3.</td>
								<td>Alamat Wajib Pajak <span class="required">*</span></td>
								<td colspan="3"><input type="text" maxlength="255" class="form-control" name="sspdAlamat" placeholder="" required="required"></td>
								<td>Blok/Kav/Nomor</td>
								<td><input type="text" class="form-control" maxlength="50" name="sspdBlok" placeholder=""></td>
							</tr>
							<tr>
								<td></td>
								<td>4.</td>
								<td>RT/RW <span class="required">*</span></td>
								<td><input type="text" class="form-control" maxlength="20" name="sspdRtRw" placeholder="" required="required"></td>
								<td>5. Kabupaten <span class="required">*</span></td>
								<td>
									<select class="form-control" name="sspdKabupaten" id="sspdKabupaten" required="required" style="width: 100%">
										<option value="">-</option>
										<?php foreach ($kabupaten as $kab) {?>
											<option value="<?php echo $kab['id_provinsi'].'|'.$kab['id_kabupaten'] ?>"><?php echo $kab['nama_kabupaten'] ?></option>
										<?php } ?>
									</select>
								</td>
								<td>6. Kecamatan <span class="required">*</span></td>
								<td><select class="form-control select2" name="sspdKecamatan" id="sspdKecamatan" required="required" style="width: 100%"></select></td>
							</tr>
							<tr>
								<td></td>
								<td>7.</td>
								<td>Kelurahan/Desa <span class="required">*</span></td>
								<td><select class="form-control select2" name="sspdKelurahan" id="sspdKelurahan" required="required" style="width: 100%"></select></td>
								<td>8. No. Telp/HP <span class="required">*</span></td>
								<td><input type="text" maxlength="20" class="form-control" name="sspdTelp" placeholder="" required="required"></td>
								<td>9. Kode Pos</td>
								<td><input type="text" maxlength="5" class="form-control" name="sspdKodepos" placeholder=""></td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="7">
								</td>
								<td>
									<a class="btn btn-theme pull-right" id="tombol-next-step1">NEXT</a>
								</td>
							</tr>
						</tbody>
						<tbody id="step2" style="display: none">
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
												<th style="width:40px">No</th>
												<th>Action</th>
												<th>NOP</th>
												<th>Jenis Peralihan</th>
												<th>Kepemilikan<br/>Jenis | Nomor Sertifikat</th>
												<th>Luas<br/>Bumi | Bangunan</th>
												<th>NJOP<br/>Bumi | Bangunan</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="8">Belum ada Objek Pajak</td>
											</tr>
										</tbody>
										<tfoot></tfoot>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr>
								<td></td>
								<td colspan='2'>Harga Transaksi</td>
								<td colspan='5'><input type="text" name="hargaTransaksi" id="hargaTransaksi" class="form-control" required="required"></td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2">
									<span class="btn btn-theme" id="tombol-back-step2">BACK</span>
								</td>
								<td colspan="5">
								</td>
								<td>
									<span class="btn btn-theme pull-right" id="tombol-next-step2">Perhitungan BPHTB</span>
								</td>
							</tr>
						</tbody>
						<tbody id="step3" style="display: none">
							<tr>
								<td>C.</td>
								<td colspan="6">Perhitungan BPHTB <!-- (<i>Hanya diisi berdasarkan Perhitungan Wajib Pajak</i>) --></td>
								<td><i>Dalam Rupiah</i></td>
							</tr>
							<tr>
								<td></td>
								<td>1.</td>
								<td colspan="5">Nilai Perolehan Objek Pajak (NPOP)</td>
								<td><input type="text" name="sspdNpop" id="sspdNpop" class="form-control text-right" disabled="disabled" value="<?php echo rupiah(0) ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.</td>
								<td colspan="5">Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)</td>
								<td><input type="text" name="sspdNpoptkp" id="sspdNpoptkp" class="form-control text-right" disabled="disabled" value="<?php echo rupiah($npoptkp); ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>3.</td>
								<td colspan="4">Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)</td>
								<td><i>angka 1 - angka 2</i></td>
								<td><input type="text" name="sspdNpopkp" id="sspdNpopkp" class="form-control text-right" disabled="disabled" value="<?php echo rupiah(0) ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>4.</td>
								<td colspan="4">Bea Perolehan Hak atas Tanah dan Bangunan yang terutang</td>
								<td><i>5% x angka 3</i></td>
								<td><input type="text" name="sspdTerhutang" id="sspdTerhutang" class="form-control text-right" disabled="disabled" value="<?php echo rupiah(0) ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>5.</td>
								<td colspan="4">Pengenaan 50% karena waris/hibah wasiat/pemberian hak pengelolaan <input type="checkbox" name="sspdPersenCheck" id="sspdPersenCheck"></td>
								<td><i>50% x angka 4</i></td>
								<td><input type="text" name="sspdPersenValue" id="sspdPersenValue" class="form-control text-right" disabled="disabled" value="<?php echo rupiah(0) ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>6.</td>
								<td colspan="5">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar</td>
								<td><input type="text" name="sspdBayar" id="sspdBayar" class="form-control text-right" disabled="disabled" value="<?php echo rupiah(0) ?>"></td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
						</tbody>
						<tbody id="step4" style="display: none">
							<tr>
								<td>D.</td>
								<td colspan="7">Jumlah Setoran berdasarkan : (<i>Beri tanda pada kotak yang sesuai</i>)</td>
							</tr>
							<!-- <tr class="alasan_E">
								<td></td>
								<td><input type="radio" name="jmlSetoranCheck" class="jmlSetoranCheck" value="E" checked="checked"> -- </td>
								<td colspan="6">Tanpa Pengurangan</td>
							</tr> -->
							<tr class="alasan_A">
								<td></td>
								<td style="min-width: 35px;"><input type="radio" name="jmlSetoranCheck" class="jmlSetoranCheck" value="A" checked="checked"> a. </td>
								<td colspan="6">Penghitungan Wajib Pajak</td>
							</tr>
							<tr class="alasan_B">
								<td></td>
								<td><input type="radio" name="jmlSetoranCheck" class="jmlSetoranCheck" value="B"> b. </td>
								<td colspan="2"><!-- <input type="radio" name="alasanPenguranganBradio" value="stpd" disabled="disabled"> STPD / <input type="radio" name="alasanPenguranganBradio" value="skpdkb" disabled="disabled"> SKPDKB / <input type="radio" name="alasanPenguranganBradio" value="skpdkbt" disabled="disabled"> SKPDKBT</td> -->
								<select name="alasanPenguranganBradio">
									<option value=""></option>
									<option value="stpd">SKPDKB</option>
									<option value="skpdkb">SKPDKB</option>
									<option value="skpdkbt">SKPDKBT</option>
								</select>
								<td>Nomor</td>
								<td><input type="text" name="alasanPenguranganBNo" class="form-control" disabled="disabled"></td>
								<td>Tanggal</td>
								<td><input type="text" name="alasanPenguranganBTgl" class="form-control" disabled="disabled"></td>
							</tr>
							<tr class="alasan_C">
								<td></td>
								<td><input type="radio" name="jmlSetoranCheck" class="jmlSetoranCheck" value="C"> c. </td>
								<td colspan="7">Pengurangan dihitung sendiri karena<br/>
									<select name="alasanPenguranganC" id="alasanPenguranganC" class="form-control" disabled="disabled" style="width: 100%;height: 100%;">
										<option value="">Pilih Alasan Pengurangan</option>
										<?php foreach ($alasan_pengurangan as $als_no => $als) {?>
											<!-- <option value="<?php echo $als['krId'] ?>" nilai="<?php echo $als['krValue'] ?>"><?php echo str_pad(($als_no+1), 2, '0', STR_PAD_LEFT).'. '.$als['krName'].' ('.($als['krValue'] * 100).'%)' ?></option> -->
											<option value="<?php echo $als['krValue'] ?>"><?php echo str_pad(($als_no+1), 2, '0', STR_PAD_LEFT).'. '.$als['krName'].' ('.($als['krValue'] * 100).'%)' ?></option>
										<?php } ?>
									</select>
								</td>
								<!-- <td colspan="4"></td> -->
							</tr>
							<tr class="alasan_D">
								<td></td>
								<td><input type="radio" name="jmlSetoranCheck" class="jmlSetoranCheck" value="D"> d. </td>
								<td colspan=2>Lainnya</td>
								<td colspan="5"><input type="text" class="form-control" name="alasanPenguranganD" disabled="disabled"></td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">Jumlah Pembayaran</td>
								<td colspan="5"><input type="text" class="form-control" name="jumlahPembayaran" id="jumlahPembayaran" disabled="disabled"></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">Terbilang</td>
								<td colspan="5" id="terbilang"></td>
							</tr>
							<tr>
								<td colspan="2">
									<a class="btn btn-theme" id="tombol-back-step4">BACK</a>
								</td>
								<td></td>
								<td colspan="7" class="text-center"><input type="submit" value="SUBMIT" class="btn btn-theme submit pull-right"></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="modalObjekPajak" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 1000px;">
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
							<td style="width: 220px;">1. NOP PBB <span class="required">*</span><br/><small>(* tanpa tanda baca)</small></td>
							<td colspan="2"><input type="text" id="nomorObjekPajak" name="nomorObjekPajak" maxlength="18" class="form-control" required="required">
                                                        <td><button class="btn btn-theme btn-primary" name="cek-nop" onclick="return false" id="cek-nop">CEK NOP</button></td>
						</tr>
						<tr>
                                                    <td colspan="3"><input type="checkbox" name="checkNOP" id="checkNOP"> Gunakan NOP untuk SSPD</td>
						</tr>
					</table>
					<hr/>
					<table class="input-objek-pajak">
						<tr>
							<td style="width: 220px;">2. Lokasi <span class="required">*</span></td>
							<td><input type="text" name="lokasiObjekPajak" id="lokasiObjekPajak" class="form-control"  required="required" maxlength="255" readonly></td>
							<td style="width: 220px;">3. Blok/Kav/Nomor <span class="required">*</span></td>
							<td><input type="text" name="blokObjekPajak" id="blokObjekPajak" class="form-control"  required="required" maxlength="50" readonly></td>
						</tr>
						<tr>
							<td>4. RT/RW <span class="required">*</span></td>
							<td><input type="text" name="rtObjekPajak" id="rtObjekPajak" class="form-control"  required="required" maxlength="20" readonly></td>
							<td>5. Kabupaten <span class="required">*</span></td>
							<td>
								<select class="form-control" name="kabupatenObjekPajak" id="kabupatenObjekPajak" required="required" style="width: 100%" readonly>
									<?php foreach ($kabupaten_bantul as $kab) {?>
										<option value="<?php echo $kab['id_provinsi'].'|'.$kab['id_kabupaten'] ?>"><?php echo $kab['nama_kabupaten'] ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>6. Kecamatan <span class="required">*</span></td>
							<td>
								<select class="form-control" name="kecamatanObjekPajak" id="kecamatanObjekPajak" style="width: 100%" readonly></select>
							</td>
							<td>7. Kelurahan <span class="required">*</span></td>
							<td>
								<select class="form-control" name="kelurahanObjekPajak" id="kelurahanObjekPajak" style="width: 100%" readonly></select>
							</td>
						</tr>
						<tr>
							<td>8. Kode Pos</td>
							<td><input type="text" name="kodeposObjekPajak" id="kodeposObjekPajak" class="form-control" maxlength="5"></td>
							<td></td>
							<td></td>
						</tr>
					</table>
					<hr/>
					<table class="input-objek-pajak">
						<tr>
							<td style="width: 220px;">9. Hak atas Tanah <span class="required">*</span></td>
							<td>
								<?php $opt_group = ''; ?>
								<select class="form-control" id="hakAtasTanah" name="hakAtasTanah" style="width: 100%;"  required="required">
									<?php foreach ($hak_atas_tanah as $h => $hak) {?>
										<?php if($hak['optGroup'] != $opt_group){ ?>
											<?php if($h != 0){ ?>
												</optgroup>
											<?php } ?>
											<optgroup label='<?php echo $hak['optGroup'] ?>'>
											<?php $opt_group = $hak['optGroup']; ?>
										<?php } ?>
										<option value="<?php echo $hak['hakId'] ?>"><?php echo $hak['hakName'] ?></option>
									<?php } ?>
									</optgroup>
								</select>
								</td>
							<td style="width: 220px;">10. Nomor Sertifikat Tanah <span class="required">*</span></td>
							<td><input type="text" name="nomorSertifikat" maxlength="14" id="nomorSertifikat" class="form-control" required="required" placeholder="14 digit tanpa karakter"></td>
						</tr>
						<tr>
							<td>11. Luas Bumi (m<sup>2</sup>) <span class="required">*</span></td>
							<td><input type="text" name="luasTanahObjekPajak" id="luasTanahObjekPajak" class="form-control" value="0"  required="required" readonly></td>
							<td>12. NJOP Bumi <span class="required">*</span></td>
							<td><input type="text" name="njopTanahObjekPajak" id="njopTanahObjekPajak" class="form-control" value="0"  required="required" readonly></td>
						</tr>
						<tr>
							<td>13. Luas Bangunan (m<sup>2</sup>) <span class="required">*</span></td>
							<td><input type="text" name="luasBangunanObjekPajak" id="luasBangunanObjekPajak" class="form-control" value="0" required="required" readonly></td>
							<td>14. NJOP Bangunan <span class="required">*</span></td>
							<td><input type="text" name="njopBangunanObjekPajak" id="njopBangunanObjekPajak" class="form-control" value="0" required="required" readonly></td>
						</tr>
						<tr>
							<td>15. Luas Bumi (sesuai sertifikat) <span class="required">*</span></td>
							<td><input type="text" name="luasBumiSertifikatObjekPajak" id="luasBumiSertifikatObjekPajak" class="form-control" value="0" required="required" readonly></td>
							<td>16. Luas Bangunan (sesuai sertifikat)<span class="required">*</span></td>
							<td><input type="text" name="luasBangunanSertifikatObjekPajak" id="luasBangunanSertifikatObjekPajak" class="form-control" value="0" required="required" readonly></td>
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
<style type="text/css">
	span.required{
		color: red;
	}
</style>