<html>
<head>
	<title>Invoice Pembayaran</title>
	<style type="text/css">
	body{
		width: 100mm;
	}
	/*#outtable{
		padding-right: 5px;
		padding-left: 5px;
		padding-top: 5px;
		padding-bottom: 5px;
		border:1px solid #e3e3e3;
		width:100mm;
		border-radius: 5px;
		font-size: 12px;
		margin-bottom: 7px;
	}*/

	.short{width: auto; }
	.normal{width: auto; }
	.jenis{text-align: center; }
	.center {text-align: center; }
	.left {text-align: left; }
	.right {text-align: right; }
	.footer {font-family: arial; color:#000000; font-size: 11px; }
	.top {border : none; }
	p {margin-top: 0px; margin-bottom: 0px; }
	caption {font-family: arial; color:#000000; }
	table{border-collapse: collapse; font-family: arial; color:#000000; width: auto; font-size:11px; width:91%;}
	thead th{text-align: left; padding: 10px; }
	tbody td{border-top: 1px solid #e3e3e3; padding: 2px 7px; }
	tbody tr:nth-child(even){background: #F6F5FA; }
	tbody tr:hover{background: #EAE9F5 }


	@page :left {
      margin-left: 0cm;
      margin-right: 0cm;
   }

   @page :right {
      margin-left: 0cm;
      margin-right: 0cm;
   }

	</style>
</head>
<body>
	<div id="outtable">
		<table>
			<caption>
				<strong><?php echo $setting['site_title'] ?></strong>
				<p style="text-align: center;"><em><?php echo $setting['tagline'] ?></em></p><br>
			</caption>
			<thead>
				<tr>
					<td colspan="2">No Invoice</td>
					<td colspan="3">: <?php echo $datas['no_invoice'] ?></td>
				</tr>
				<tr>
					<td colspan="2">Nama</td>
					<td colspan="3">: <?php echo $datas['nama_customer'] ?></td>
				</tr>
				<!-- <tr>
					<td>Alamat</td>
					<td>: <?php echo $datas['alamat'] ?></td>
					<td colspan="3" class="left"></td>
				</tr> -->
				<tr>
					<td colspan="2">HP</td>
					<td colspan="3">: <?php echo $datas['no_hp'] ?></td>
				</tr>
				<tr>
					<td colspan="2">Tgl Order</td>
					<td colspan="3">: <?php echo date_format_ext($datas['tgl_terima'], 3) ?></td>
				</tr>
				<tr>
					<td colspan="2">Tgl Selesai</td>
					<td colspan="3">: <?php echo date_format_ext($datas['tgl_selesai'],3) ?></td>
				</tr>
			</thead>
			<thead>
				<tr>
					<th class="short center">No</th>
					<!-- <th class="normal">Nama Layanan</th> -->
					<th class="jenis">Jenis Layanan</th>
					<th class="normal center">Qty</th>
					<th class="normal center">Unit</th>
					<th class="normal">Harga</th>
					<th class="normal right">Sub Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $total = 0; ?>
				<?php $no = 1; foreach ($detail as $i => $v) {?>
				<tr>
					<td align="center"><?php echo $no ?></td>
					<td><?php echo $v['nama_layanan'] ?></td>
					<!-- <td class="jenis"><?php echo ucwords(str_replace('harga_', '', $v['tipe_harga'])) ?></td> -->
					<td class="center"><?php echo $v['qty'] ?></td>
					<td class="center"><?php echo $v['unit'] ?></td>
					<td><?php echo money_format_ext($v['harga']) ?></td>
					<td class="right"><?php echo money_format_ext($v['sub_total']) ?></td>
					<?php $total += $v['sub_total']; ?>
				</tr>
				<?php $no++; } ?>
				<tr>
					<td colspan="4" style="text-align:center"><strong>Jumlah</strong></td>
					<td colspan="2" class="right" style="border-top: 1px solid #000"><strong><?php echo money_format_ext($total); ?></strong></td>
				</tr>
				<?php
				$diskon_label = '';
				$diskon = 0;

				if($datas['jenis_diskon'] == '%'){
					$diskon_label = $datas['diskon'].' %';
					$diskon = ($datas['diskon']/100) * $total;
				}
				else{
					$diskon_label = money_format_ext($datas['diskon']);
					$diskon = $datas['diskon'];
				}
				?>
				<tr>
					<td colspan="4" style="text-align:center"><strong>Diskon</strong></td>
					<td colspan="2" style="border-bottom: 1px solid #000" class="right"><strong><?php echo $diskon_label ?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center"><strong>Total</strong></td>
					<td colspan="2" class="right"><strong><?php echo money_format_ext($total - $diskon) ?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center"><strong>Bayar</strong></td>
					<td colspan="2" class="right"><strong><?php echo money_format_ext($datas['dibayar']) ?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center"><strong>Sisa</strong></td>
					<td colspan="2" class="right"><strong><?php echo money_format_ext($datas['sisa']) ?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center"><strong>Status Pembayaran</strong></td>
					<td colspan="2" class="right"><strong><?php echo ucwords($datas['status_pembayaran']) ?></strong></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="footer">
		<strong>Perhatian : </strong> <br>
		1. Barang yang tidak diambil setelah <em>1 bulan</em> diluar tanggung jawab kami <br>
		2. Barang yang hilang diganti dengan 5x ongkos cuci <br>
		3. Kerusakan/kelunturan/mengerut sendiri diluar tanggung jawab kami <br>
		4. Periksa kembali hasil cucian saat pengambilan barang<br>
		5. Komplain setelah keluar Outlet tidak akan kami layani
	</div>
	<script type="text/javascript">
	//this.print(true)
	</script> 
</body>
</html>