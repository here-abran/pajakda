<div class="row">
	<div class="col-xs-12 col-md-12 col-lg-6">
		<div class="box">
			<div class="box-header"></div>
			<form accept-charset="utf-8" method="post" action="<?php echo base_url_admin() ?>invoice/update">
				<input type="hidden" value="<?php echo $datas['id'] ?>" name="id">
				<input type="hidden" value="<?php echo $datas['no_invoice'] ?>" name="no_invoice">
				<div class="box-body">
					<div class="form-group">
						<label>No Invoice</label>
						<input type="text" disabled="disabled" value="<?php echo $datas['no_invoice'] ?>" placeholder="No Invoice" name="no_invoice" class="form-control">
					</div>
					<div class="form-group">
						<label>Tanggal Order</label>
						<input type="text" disabled="disabled" value="<?php echo date_format_ext($datas['tgl_terima'], 3) ?>" placeholder="Tanggal Order" name="tgl_terima" class="form-control">
					</div>
					<div class="form-group">
						<label>Tanggal Selesai</label>
						<input type="text" disabled="disabled" value="<?php echo date_format_ext($datas['tgl_selesai'], 3) ?>" placeholder="Tanggal Selesai" name="tgl_selesai" class="form-control">
					</div>
					<div class="form-group">
						<label>Nama Customer</label>
						<input type="text" disabled="disabled" value="<?php echo $datas['nama_customer'] ?>" placeholder="Nama Customer" name="nama_customer" class="form-control">
					</div>

					<div class="form-group">
						<label>Catatan</label>
						<textarea class="form-control" name="catatan"><?php echo $datas['catatan'] ?></textarea>
					</div> 

					<div class="form-group">
						<label>Bayar</label>
						<input type="text" value="" placeholder="Bayar sisa kekurangan" name="tambah_bayar" class="form-control">
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<!-- <a class="btn btn-primary" href="http://go-laundry.com/demo/admin"><i class="fa fa-chevron-circle-left"></i> Kembali</a> -->
					<input type="submit" value="Simpan" class="btn btn-primary">
					<a target="_blank" class="btn btn-primary" href="<?php echo base_url_admin() ?>invoice/print_data/<?php echo $datas['no_invoice'] ?>"><i class="fa fa-print"></i> Print Invoice</a>
				</div>
			</form>                                
		</div>
	</div><!-- /.col-xs-6--> 
	<div class="col-xs-12 col-md-12 col-lg-6">
		<h3 style="margin-top:0 !important">RINCIAN INVOICE</h3>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="20">No</th>
						<th>Nama Layanan</th>
						<th>Pilihan Layanan</th>
						<th>Qty</th>
						<th>Unit</th>
						<th>Harga</th>
						<th>Sub Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $total = 0; ?>
					<?php $no = 1; foreach ($detail as $i => $v) {?>
						<tr>
							<td align="center"><?php echo $no ?></td>
							<td><?php echo $v['nama_layanan'] ?></td>
							<td><?php echo ucwords(str_replace('harga_', '', $v['tipe_harga'])) ?></td>
							<td><?php echo $v['qty'] ?></td>
							<td><?php echo $v['unit'] ?></td>
							<td><?php echo money_format_ext($v['harga']) ?></td>
							<td style="text-align:right"><?php echo money_format_ext($v['sub_total']) ?></td>
							<?php $total += $v['sub_total']; ?>
						</tr>
					<?php $no++; } ?>
					<tr>
						<td style="text-align:center" colspan="6"><strong>Total</strong></td>
						<td style="border-top:2px solid #ccc; text-align:right"><?php echo money_format_ext($total) ?></td>
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
						<td style="text-align:center" colspan="6"><strong>Diskon</strong></td>
						<td style="text-align:right"><?php echo $diskon_label ?></td>
					</tr>
					<tr>
						<td style="text-align:center" colspan="6"><strong>Grand Total</strong></td>
						<td style="border-top:2px solid #ccc; text-align:right; font-size:17px;"><strong><?php echo money_format_ext($total - $diskon) ?></strong></td>
					</tr>
					<tr>
						<td style="text-align:center" colspan="6"><strong>Bayar</strong></td>
						<td style="text-align:right"><strong><?php echo money_format_ext($datas['dibayar']) ?></strong></td>
					</tr>
					<tr>
						<td style="text-align:center" colspan="6"><strong>Sisa</strong></td>
						<td style="font-size:17px; text-align:right"><strong><?php echo money_format_ext($datas['sisa']) ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>