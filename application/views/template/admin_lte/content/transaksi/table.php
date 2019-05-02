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
			<?php $total_qty = 0; ; $total_harga = 0; ?>
			<?php $no = 1; foreach ($cart as $i => $v) {?>
				<?php $total_qty += $v['qty']; $total_harga += ($layanan[$v['id']]['harga_'.$v['harga']] * $v['qty']) ;?>
				<tr>
					<td><?php echo $no ?></td>
					<td><?php echo $layanan[$v['id']]['nama_layanan'] ?></td>
					<td><?php echo $v['qty'] ?></td>
					<td><?php echo $layanan[$v['id']]['unit'] ?></td>
					<td><?php echo money_format_ext($layanan[$v['id']]['harga_'.$v['harga']]) ?></td>
					<td><?php echo $v['harga'] ?></td>
					<td><?php echo money_format_ext($layanan[$v['id']]['harga_'.$v['harga']] * $v['qty']) ?></td>
					<td>
						<?php $get = "id=".$v['id']."&qty=".$v['qty']."&harga=".$v['harga']; ?>
						<a title="Hapus Item" class="btn btn-danger btn-sm delete_transaksi" href="<?php echo base_url_admin() ?>transaksi/delete_item_cart?<?php echo $get ?>">
							<i style="color:#fff" class="fa fa-trash-o"></i>
						</a>
					</td>
				</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
	<div class="form-group">
		<table class="table table-bordered table-striped">
			<tbody>
				<tr>
					<td><label>Jumlah item</label></td>
					<td style="text-align:center">:</td>
					<td style="font-size:20px; text-align:center"><span><strong><?php echo $total_qty ?></strong></span></td>
				</tr>
				<tr>
					<td> <label>Total</label></td>
					<td style="text-align:center">:</td>
					<td style="font-size:25px; text-align:center"><span><strong><?php echo money_format_ext($total_harga) ?></strong></span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>