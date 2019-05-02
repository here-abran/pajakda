<?php 
function rupiah($bilangan = 0, $behind_number = 2){
	$bilangan = number_format($bilangan, $behind_number, ',', '.');
	return $bilangan;
}

function terbilang($x = 0){
	$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	if ($x < 12)
		return " " . $abil[$x];
	elseif ($x < 20)
		return Terbilang($x - 10) . " Belas";
	elseif ($x < 100)
		return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
	elseif ($x < 200)
		return " Seratus" . Terbilang($x - 100);
	elseif ($x < 1000)
		return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
	elseif ($x < 2000)
		return " Seribu" . Terbilang($x - 1000);
	elseif ($x < 1000000)
		return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
	elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
?>
<?php
$no_setoran = '004.111.000940';
$arr_lembar = array(
	1 => 'Untuk Wajib Pajak<br/>sebagai bukti<br/>pembayaran',
);
if (isset($do)) {
	$arr_lembar = array(
		1 => 'Untuk Wajib Pajak<br/>sebagai bukti<br/>pembayaran',
		'1.a' => 'Untuk Wajib Pajak<br/>sebagai bukti<br/>pembayaran',
		2 => 'Untuk Badan Keuangan<br/>dan Aset Daerah',
		'2.a' => 'Untuk Badan Keuangan<br/>dan Aset Daerah',
		3 => 'PPAT/Notaris/Kepala Kantor<br/>Lelang/Pejabat Lelang/<br/>Pejabat Pertanahan',
		4 => 'Untuk Badan Keuangan<br/>dan Aset Daerah<br/>melalui Tempat Pembayaran',
		5 => 'Untuk Tempat Pembayaran<br/>BPHTB',
	);
}
?>
<?php if (isset($do)) { ?>
<!DOCTYPE html>
<html>
<head>
	<title>Print BPHTB</title>
</head>
<body onload="print()">
<?php } ?>
<?php foreach ($arr_lembar as $lembar_no => $lembar_for) {?>
<?php if(count($arr_lembar) > 1) { ?>
<div class="page-break"></div>
<?php } ?>
<?php if(!strpos($lembar_no, '.')){ ?>
	<table class="cetak-form">
		<thead>
			<tr>
				<th colspan="3">
					<img src="<?php echo base_url() ?>assets/img/logo-bantul-small-hp.png" class="logo"><br/>PEMERINTAH KAB.<br/>BANTUL
				</th>
				<th colspan="5">
					<h3>SURAT SETORAN PAJAK DAERAH<br/>SSPD</h3>
					<h5>BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN</h5>
				</th>
				<th>
					No. <?= $noForm ?><br>
					<b>Lembar <span class="lembar_no"><?php echo $lembar_no ?></span></b><br/><br/><span class="weight_normal"><?php echo $lembar_for ?></span>
				</th>
			</tr>
			<tr>
				<th colspan="9" class="weight_normal">BADAN KEUANGAN DAN ASET DAERAH KABUPATEN BANTUL<br/>JL. RW Monginsidi Bantul 55711  Website : <i>http://bkad.bantulkab.go.id</i> Email : <i>bkad@bantulkab.go.id</i><br/><b>TELEPON / FAX : (0274) 367260</b></th>
			</tr>
		</thead>
		<tbody>
			<tr class="border-top">
				<td class="border-left">A.</td>
				<td>1.</td>
				<td>Nama Wajib Pajak</td>
				<td>:</td>
				<td class="border-right text-bold" colspan="5"><?php echo $sspd['sspdNama']; ?></td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td style="width: 17px">2.</td>
				<td style="width:105px;">Alamat Wajib Pajak</td>
				<td>:</td>
				<td class="text-bold" colspan="3"><?php echo $sspd['sspdAlamat']; ?></td>
				<td>Blok/Kav/Nomor</td>
				<td class="border-right text-bold">: <?php echo $sspd['sspdBlok']; ?></td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td>3.</td>
				<td>Kelurahan/Desa</td>
				<td>:</td>
				<td class="text-bold"><?php echo $sspd['sspdKelurahanNama']; ?></td>
				<td>4. RT/RW</td>
				<td class="text-bold">: <?php echo $sspd['sspdRtRw']; ?></td>
				<td style="width: 95px;">5. Kecamatan</td>
				<td style="width: 130px;" class="border-right text-bold">: <?php echo $sspd['sspdKecamatanNama']; ?></td>
			</tr>
			<tr class="border-bottom">
				<td class="border-left"></td>
				<td>6.</td>
				<td>Kabupaten</td>
				<td>:</td>
				<td class="text-bold"><?php echo $sspd['sspdKabupatenNama']; ?></td>
				<td>7. No. Telp/HP</td>
				<td class="text-bold">: <?php echo $sspd['sspdTelp']; ?></td>
				<td>8. Kode Pos</td>
				<td class="border-right text-bold">: <?php echo $sspd['sspdKodepos']; ?></td>
			</tr>

			<tr class="border-top">
				<td class="border-left">B.</td>
				<td>1.</td>
				<td>NOP PBB P2</td>
				<td>:</td>
				<td class="border-right" colspan="5">
					<?php $nop = str_split($sspd['nopPBB']); $arr_spasi = array(1,3,6,9,12,16); ?>
					<table class="table-nop">
						<tr>
							<?php foreach ($nop as $i => $n) {?>
							<td><?php echo $n; ?></td>
							<?php if(in_array($i, $arr_spasi)){ ?>
							<td class="no-border">&nbsp;</td>
							<?php } ?>
							<?php } ?>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td>2.</td>
				<td>Lokasi Objek Pajak</td>
				<td>:</td>
				<td colspan="3" class="text-bold"><?php echo $sspd['lokasiPBB'] ?></td>
				<td>Blok/Kav/Nomor</td>
				<td class="border-right text-bold">: <?php echo $sspd['blokPBB'] ?></td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td>3.</td>
				<td>Kelurahan/Desa</td>
				<td>:</td>
				<td class="text-bold"><?php echo $sspd['pbbKelurahanNama']; ?></td>
				<td>4. RT/RW</td>
				<td class="text-bold">: <?php echo $sspd['rtrwPBB']; ?></td>
				<td>5. Kecamatan</td>
				<td class="border-right text-bold">: <?php echo $sspd['pbbKecamatanNama']; ?></td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td>6.</td>
				<td>Kabupaten</td>
				<td>:</td>
				<td class="text-bold" colspan="3"><?php echo $sspd['pbbKabupatenNama']; ?></td>
				<td>8. Kode Pos</td>
				<td class="border-right text-bold">: <?php echo $sspd['kodeposPBB']; ?></td>
			</tr>
			<tr>
				<td class="border-left border-right" colspan="9">Penghitungan NJOP PBB P2</td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td class="text-center border-all" colspan="3" style="vertical-align: middle">Objek Pajak</td>
				<td class="text-center border-all" colspan="1"><b>Luas</b><br/><small class="small">Diisi luas tanah dan atau bangunan<br/>yang haknya diperoleh</small></td>
				<td class="text-center border-all" colspan="2"><b>NJOP PBB P2/m<sup>2</sup></b><br/><small class="small">Diisi berdasarkan SPPT PBB P2 tahun terjadinya<br/>perolehan hak / Tahun ........</small></td>
				<td class="border-right text-center border-all" colspan="2" style="vertical-align: middle">Luas x NJOP</td>
			</tr>
			<tr>
				<td class="border-left" rowspan="2"></td>
				<td class="text-center border-all" rowspan="2" colspan="3" style="vertical-align: middle">Tanah (bumi)</td>
				<td class="text-center border-all" colspan="1">7. Luas Tanah (bumi)</td>
				<td class="border-right text-center border-all" colspan="2">9. NJOP tanah (bumi)/m<sup>2</sup></td>
				<td class="border-right text-center border-all" colspan="2"><i>angka 7 x angka 9</i></td>
			</tr>

			<tr>
				<td class="text-center border-all"><span class="text-bold"><?php echo rupiah($sspd['luasBumi'], 0) ?></span><span class="pull-right">m<sup>2</sup></span></td>
				<td class="text-center border-all" colspan="2"><span class="pull-left">Rp.</span><span class="text-bold"><?php echo rupiah($sspd['njopBumi']) ?></span></td>
				<td class="border-right text-center border-all" colspan="2"><span class="pull-left">11. Rp.</span><span class="text-bold"><?php echo rupiah($sspd['luasBumi'] * $sspd['njopBumi']) ?></span></td>
			</tr>
			<tr>
				<td class="border-left" rowspan="2"></td>
				<td class="text-center border-all" rowspan="2" colspan="3" style="vertical-align: middle">Bangunan</td>
				<td class="text-center border-all" colspan="1">8. Luas Bangunan</td>
				<td class="text-center border-all" colspan="2">10. NJOP bangunan/m<sup>2</sup></td>
				<td class="border-right text-center border-all" colspan="2"><i>angka 8 x angka 10</i></td>
			</tr>
			<tr>
				<td class="text-center border-all"><span class="text-bold"><?php echo rupiah($sspd['luasBangunan'], 0) ?></span><span class="pull-right">m<sup>2</sup></span></td>
				<td class="text-center border-all" colspan="2"><span class="pull-left">Rp.</span><span class="text-bold"><?php echo rupiah($sspd['njopBangunan']) ?></span></td>
				<td class="border-right text-center border-all" colspan="2"><span class="pull-left">12. Rp.</span><span class="text-bold"><?php echo rupiah($sspd['luasBangunan'] * $sspd['njopBangunan']) ?></span></td>
			</tr>
			<tr>
				<td class="border-left" colspan="7"></td>
				<td class="text-center border-right border-all" colspan="2"><i>(angka 11 + angka 12)</i></td>
			</tr>
			<tr>
				<td class="text-right border-left" colspan="7">NJOP PBB P2 : </td>
				<td class="text-center border-right border-all" colspan="2"><span class="pull-left">13. Rp.</span><span class="text-bold"><?php echo rupiah($sspd['sspdNpop']) ?></span></td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td>14.</td>
				<td colspan="5">Jenis perolehan hak atas tanah dan / atau bangunan :</td>
				<td class="text-center border-right" colspan="2">
					<?php $hak = str_split(str_pad($sspd['hakAtasTanah'], 2, '0', STR_PAD_LEFT)); ?>
					<table class="table-nop">
						<tr>
							<?php foreach ($hak as $i => $n) {?>
							<td><?php echo $n; ?></td>
							<?php } ?>
							<td class="no-border" style="font-weight: normal;"><i><small class="small">Diisi sesuai petunjuk pengisian SSPD</small></i></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="border-left"></td>
				<td>15.</td>
				<td colspan="5">Harga transaksi yang terjadi pada perolehan hak atas tanah dan/atau bangunan</td>
				<td class="text-center border-right border-all" colspan="2">
					<span class="pull-left">Rp.</span><span class="text-bold"><?php echo rupiah($sspd['hargaTransaksi']) ?></span>
				</td>
			</tr>
			<tr class="border-bottom">
				<td class="border-left"></td>
				<td style="vertical-align: top;">16.</td>
				<td style="vertical-align: top;" colspan="7"><span>Nomor Sertifikat Tanah :</span>&nbsp;
					<?php $nos = str_split($sspd['noSertifikat']); ?>
					<table class="table-nop" style="display: inline">
						<tr>
							<?php for ($i = 0; $i < 15; $i++) {?>
							<td><?php echo isset($nos[$i]) ? $nos[$i] : "&nbsp;&nbsp;"; ?></td>
							<?php }?>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="border-all">
				<td>C.</td>
				<td colspan="7">PENGHITUNGAN BPHTB (<i>Hanya diisi berdasarkan Penghitungan Wajib Pajak</i>)</td>
				<td class="text-center"><i>Dalam Rupiah</i></td>
			</tr>
			<tr class="border-all">
				<td></td>
				<td>1.</td>
				<td colspan="6">Nilai Perolehan Objek Pajak (NPOP)</td>
				<td class="text-right text-bold"><?php echo rupiah($sspd['sspdNpop']); ?></td>
			</tr>
			<tr class="border-all">
				<td></td>
				<td>2.</td>
				<td colspan="6">Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)</td>
				<td class="text-right text-bold"><?php echo rupiah($sspd['sspdNpoptkp']); ?></td>
			</tr>
			<tr class="border-all">
				<td></td>
				<td>3.</td>
				<td colspan="5">Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)</td>
				<td><i>angka 1 - angka 2</i></td>
				<td class="text-right text-bold"><?php echo rupiah($sspd['sspdNpopkp']); ?></td>
			</tr>
			<tr class="border-all">
				<td></td>
				<td>4.</td>
				<td colspan="5">Bea Perolehan Hak atas Tanah dan Bangunan yang terutang</td>
				<td><i>5% x angka 3</i></td>
				<td class="text-right text-bold"><?php echo rupiah($sspd['sspdTerhutang']); ?></td>
			</tr>
			<tr class="border-all">
				<td></td>
				<td>5.</td>
				<td colspan="5">Pengenaan 50% karena waris / hibah wasiat / pemberian hak pengelolaan</td>
				<td><i>50% x angka 4</i></td>
				<td class="text-right text-bold"><?php echo rupiah($sspd['sspdPersenValue']); ?></td>
			</tr>
			<tr class="border-all">
				<td></td>
				<td>6.</td>
				<td colspan="6">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar</td>
				<td class="text-right text-bold"><?php echo rupiah($sspd['sspdBayar']); ?></td>
			</tr>

			<tr class="border-top">
				<td class="border-left">D.</td>
				<td class="border-right" colspan="8">Jumlah Setoran berdasarkan : (<i>Beri tanda silang "X" pada kotak yang sesuai</i>)</td>
			</tr>
			<tr>
				<td class="border-left text-center" colspan="2"><div class="box-check" style="float:right;"><b><?php if($sspd['jmlSetoranCheck'] == 'A') echo 'X' ?></b></div></td>
				<td class="border-right" colspan="7">a. Penghitungan Wajib Pajak</td>
			</tr>
			<tr>
				<?php 
				$als = array('&nbsp;&nbsp;', '&nbsp;&nbsp;', '&nbsp;&nbsp;');
				$bb = 'STPD/SKPDKB/SKPDKBT';
				$nono = '';
				$tgltgl = '';
				if($sspd['jmlSetoranCheck'] == 'B'){
					$alasan = json_decode($sspd['jmlSetoranValue'], true);
					if($alasan['alasanPenguranganBradio'] == 'stpd'){
						$bb = 'STPD<strike>/SKPDKB/SKPDKBT</strike>';
					}elseif($alasan['alasanPenguranganBradio'] == 'skpdkb'){
						$bb = '<strike>STPD/</strike>SKPDKB<strike>/SKPDKBT</strike>';
					}else{
						$bb = '<strike>STPD/SKPDKB/</strike>SKPDKBT';
					}

					$nono = $alasan['alasanPenguranganBNo'];
					$tgltgl = $alasan['alasanPenguranganBTgl'];
				}
				?>

				<td class="border-left text-center" colspan="2"><div class="box-check" style="float:right;"><b><?php if($sspd['jmlSetoranCheck'] == 'B') echo 'X' ?></b></div></td>
				<td colspan="3">b. <?php echo $bb ?></td>
				<td colspan="2">Nomor : <b><?php echo $nono ?></b></td>
				<td colspan="2" class="border-right">Tanggal : <b><?php echo $tgltgl ?></b></td>
			</tr>
			<tr>
				<td class="border-left text-center" colspan="2"><div class="box-check" style="float: right;"><b><?php if($sspd['jmlSetoranCheck'] == 'C') echo 'X' ?></b></div></td>
				<td colspan="3">c. Pengurangan dihitung sendiri karena : </td>
				<td colspan="4" class="border-right">
					<?php 
					$als = array('&nbsp;&nbsp;', '&nbsp;&nbsp;');
					if($sspd['jmlSetoranCheck'] == 'C'){
						$alasan = json_decode($sspd['jmlSetoranValue'], true);
						$als = str_split(str_pad($alasan['alasanPenguranganC'], 2, '0', STR_PAD_LEFT));
					}
					?>
					<table class="table-nop">
						<tr>
							<?php foreach ($als as $a) {?>
							<td><?php echo $a ?></td>
							<?php } ?>
						</tr>
					</table>
				</td>
			</tr>
			<tr class="border-bottom">
				<td class="border-left text-center" colspan="2"><div class="box-check" style="float: right;"><b><?php if($sspd['jmlSetoranCheck'] == 'D') echo 'X' ?></b></div></td>
				<?php 
				$als = '';
				if($sspd['jmlSetoranCheck'] == 'D'){
					$alasan = json_decode($sspd['jmlSetoranValue'], true);
					$als = $alasan['alasanPenguranganD'];
				}
				?>
				<td colspan="7" class="border-right">d. <span class="text-bold"><?php echo $als ?></span></td>
			</tr>

			<tr class="border-top border-bottom">
				<td class="border-left"></td>
				<td colspan="5">Jumlah Pembayaran : <span class="text-bold">Rp. <?php echo rupiah($sspd['sspdBayar']); ?></span><br/>Terbilang : <span class="text-bold"><?php echo strtoupper(terbilang($sspd['sspdBayar']).' Rupiah'); ?></span></td>
				<td colspan="3" class="border-right text-center">
					Untuk disetorkan ke Rekening Kas Daerah<br/>Kode Rekening BPHTB<br/><br/>
					<center>
						<table class="table-nop">
							<tr>
								<?php foreach (str_split($no_setoran) as $n) {?>
								<td><?php echo $n ?></td>
								<?php } ?>
							</tr>
						</table>
					</center><br/><br/>
				</td>
			</tr>

			<tr class="border-top border-bottom">
				<td colspan="9" class="border-left border-right no-padding">
					<table id="table-ttd">
						<tbody>
							<tr>
								<td class="text-center no-padding border-right ttd-first">
									MENGETAHUI :<br/>PPAT / NOTARIS / KEPALA KANTOR LELANG / PEJABAT LELANG/<br/>KEPALA KANTOR PERTANAHAN KABUPATEN BANTUL
								</td>
								<td class="text-center border-right">
									DITERIMA OLEH :<br/>TEMPAT PEMBAYARAN BPHTB<br/>Tanggal : 
								</td>
								<td class="text-center">
									..................., tgl ...................<br/>WAJIB PAJAK / PENYETOR
								</td>
							</tr>
							<tr>
								<td class="text-center border-right" style="height: 40px;"></td>
								<td class="text-center border-right"></td>
								<td class="text-center"></td>
							</tr>
							<tr>
								<td class="text-center border-right"><small>Nama lengkap, stempel dan tanda tangan</small></td>
								<td class="text-center border-right"><small>Nama lengkap, stempel dan tanda tangan</small></td>
								<td class="text-center"><small>Nama lengkap dan tanda tangan</small></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
<?php }else{ ?>
	<table class="cetak-form">
		<thead>
			<tr>
				<th colspan="3">
					<img src="<?php echo base_url() ?>assets/img/logo-bantul-small-hp.png" class="logo"><br/>PEMERINTAH KAB.<br/>BANTUL
				</th>
				<th colspan="5">
					<h3>SURAT SETORAN PAJAK DAERAH<br/>SSPD</h3>
					<h5>BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN</h5>
				</th>
				<th>
					<b>Lembar <span class="lembar_no"><?php echo $lembar_no ?></span></b><br/><br/><span class="weight_normal"><?php echo $lembar_for ?></span>
				</th>
			</tr>
			<tr>
				<th colspan="9" class="weight_normal">BADAN KEUANGAN DAN ASET DAERAH KABUPATEN BANTUL<br/>JL. RW Monginsidi Bantul 55711  Website : <i>http://bkad.bantulkab.go.id</i> Email : <i>bkad@bantulkab.go.id</i><br/><b>TELEPON / FAX : (0274) 367260</b></th>
			</tr>
		</thead>
		<tbody>
			<tr class="border-top border-bottom">
				<td class="border-left border-right" colspan="9">
					<table id="table-lampiran">
						<thead>
							<th>No</th>
							<th>NOP</th>
							<th>Kepemilikan<br/>Jenis | Nomor Sertifikat</th>
							<th>Luas (m<sup>2</sup>)<br/>Bumi | Bangunan</th>
							<th>NJOP (Rp per m<sup>2</sup>)<br/>Bumi | Bangunan</th>
							<th>Subtotal</th>
						</thead>
						<tbody>
							<?php $no = 1; $total_detail = 0; foreach ($sspd_detail as $index => $detail) {?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $detail['nopPBB'] ?></td>
									<td><?php echo $hak_atas_tanah[$detail['hakAtasTanah']] ?> | <?php echo $detail['noSertifikat'] ?></td>
									<td><?php echo rupiah($detail['luasBumi'], 0) ?> | <?php echo rupiah($detail['luasBangunan'], 0) ?></td>
									<td><?php echo rupiah($detail['njopBumi']) ?> | <?php echo rupiah($detail['njopBangunan']); ?></td>
									<?php $subtotal = ($detail['luasBumi'] * $detail['njopBumi']) + ($detail['luasBangunan'] * $detail['njopBangunan']) ?>
									<td><?php echo rupiah($subtotal); ?></td>
								</tr>
							<?php $total_detail += $subtotal; $no++; } ?>
						</tbody>
						<tfoot>
							<th colspan="5" style="text-align:right">TOTAL</th>
							<th ><?php echo rupiah($total_detail); ?></th>
						</tfoot>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?>

<?php } ?>

<?php if(count($arr_lembar) > 1) { ?>
<div class="page-break"></div>
<p class="judul-form">FORMULIR PENYAMPAIAN SSPD</p>

<table>
	<tbody>
		<tr>
			<td>Lampiran</td><td width="20px" align="center">:</td><td></td>
		</tr>
		<tr>
			<td>Hal</td><td width="20px" align="center">:</td><td></td>
		</tr>
	</tbody>
</table>

<br>
<p>
	Yth. Bupati Bantul<br>
	Cq. Kepala Dinas BKAD<br>
	Kabupaten Bantul<br>
	Di Bantul
</p>
<br>
<p>Yang bertanda tangan dibawah ini:</p>
<table>
	<tbody>
		<tr>
			<td width="200px">Nama Wajib Pajak</td><td width="20px" align="center">:</td><td><?= $sspd['sspdNama'] ?></td>
		</tr>
		<tr>
			<td width="200px">NPWP</td><td width="20px" align="center">:</td><td>--</td>
		</tr>
		<tr>
			<td width="200px">Alamat</td><td width="20px" align="center">:</td><td><?= $sspd['sspdAlamat'] ?></td>
		</tr>
		<tr>
			<td width="200px">Desa/Kelurahan</td><td width="20px" align="center">:</td><td><?= $sspd['sspdKelurahan'] ?></td>
		</tr>
		<tr>
			<td width="200px">Kecamatan</td><td width="20px" align="center">:</td><td><?= $sspd['sspdKecamatan'] ?></td>
		</tr>
		<tr>
			<td width="200px">Kabupaten/Kota</td><td width="20px" align="center">:</td><td><?= $sspd['sspdKabupaten'] ?></td>
		</tr>
		<tr>
			<td width="200px">Telepon</td><td width="20px" align="center">:</td><td><?= $sspd['sspdTelp'] ?></td>
		</tr>
	</tbody>
</table>

<br>
<p>Bersama ini menyampaikan SSPD BPHTB untuk diteliti atas perolehan hak atas tanah dan/atau bangunan sebagai berikut:</p>
<table>
	<tbody>
		<tr>
			<td width="200px">NOP</td><td width="20px" align="center">:</td><td><?= $sspd_detail[0]['nopPBB'] ?></td>
		</tr>
		<tr>
			<td width="200px">Alamat</td><td width="20px" align="center">:</td><td><?= $sspd_detail[0]['lokasiPBB'] . ' ' . $sspd_detail[0]['rtrwPBB'] ?></td>
		</tr>
		<tr>
			<td width="200px">Desa</td><td width="20px" align="center">:</td><td><?= $sspd_detail[0]['kelurahanPBB'] ?></td>
		</tr>
		<tr>
			<td width="200px">Kecamatan</td><td width="20px" align="center">:</td><td><?= $sspd_detail[0]['kecamatanPBB'] ?></td>
		</tr>
		<tr>
			<td width="200px">Kabupaten</td><td width="20px" align="center">:</td><td><?= $sspd_detail[0]['kabupatenPBB'] ?></td>
		</tr>
	</tbody>
</table>
<br>
<span>Terlampir dokumen sebagai berikut:</span>
<ol>
	<li>Foto Copy PBB 2018</li>
	<li>Foto Copy Identitas Wajib Pajak berupa KTP</li>
	<li>Foto Copy Sertipikat Tanah/ Letter C</li>
</ol>
<br>
<table>
	<tbody>
		<tr>
			<td width="350px"></td>
			<td>
				Bantul,<br>
				Wajib Pajak,<br><br><br><br><br>
				<?= $sspd['sspdNama'] ?>
			</td>
		</tr>
	</tbody>
</table>
<?php } ?>
<style type="text/css">

p.judul-form{
	font-size: 12;
	font-weight: bold;
	text-align: center;
}
table.cetak-form{
	width: 100%;
	border-collapse: collapse;
	font-size: 11px;
}

small.small{
	font-size: 9px;
}

table#table-ttd tbody tr td{
	line-height: 16px;
	font-size: 11px;
	/*width: 33.33%;*/
}

table#table-ttd tbody tr td.ttd-first{
	width: 45%;
}

table.cetak-form th{
	text-align: center;
	border: 1px solid black;
}

table.cetak-form td{
	vertical-align: top;
	padding: 4px;
}

table.cetak-form img.logo{
	width: 60px;
	/*margin: 10px;*/
}

table.cetak-form span.lembar_no{
	font-size: 30px;
}

table.cetak-form .weight_normal{
	font-weight: normal;
}

table tr.border-top > td{
	border-top: 1px solid black;
}

table tr td.border-left{
	border-left: 1px solid black;
}

table tr td.border-right{
	border-right: 1px solid black;
}

table tr.border-bottom > td{
	border-bottom: 1px solid black;
}

table tr.border-all td{
	border: 1px solid black;
}

table tr td.border-all{
	border: 1px solid black;
}

table td.no-padding{
	padding: 0px;
}

div.box-check {
	float: left;
	width: 18px;
	height: 17px;
	border: 1px solid black;
}

table th.text-right, table td.text-right{
	text-align: right;
}

table td.text-center{
	text-align: center;
}

table.table-nop{
	border-collapse: collapse;
}

table.table-nop td{
	border:1px solid black;
	padding: 1px 6px;
	font-weight: bold; 
	font-size: 12px;
}

table.table-nop td.no-border{
	border:none;
}

.text-bold{
	font-weight: bold;
}

table#table-ttd{
	width: 100%;
}

span.pull-right{
	float: right;
}

span.pull-left{
	float: left;
}

strike{
	color: #656565;
}

@media all {
	.page-break { display: none; }
}

@media print {
	.page-break { display: block; page-break-before: always; }
}

/*Table Lampiran*/

table#table-lampiran{
	width: 100%;
	border-collapse: collapse;
}

table#table-lampiran th, table#table-lampiran td{
	border:1px solid black;
	text-align: center;
	padding: 4px;
}
</style>
<?php if(isset($do)){ ?>
</body>
</html>
<?php } ?>