<?php 
	function rupiah($bilangan = 0){
		$bilangan = number_format($bilangan, 2, ',', '.');
		return $bilangan;
	}
?>
<!-- <section id="inner-headline">
	<div class="container">
		<div class="row"></div>
	</div>
</section> -->
<section id="content">
	<div class="container">
		<?php if($type == ''){ ?>
		
		<?php // }elseif($type == 'bphtb'){ 
			}else {
				$this->load->view('layanan/' . $type);
			} ?>
		
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
	
	table.table-objek-pajak th{
		padding: 5px;
		border: 1px solid #ccc;
		text-align: center;
	}

	table.table-objek-pajak td{
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
	table.table-objek-pajak td.text-center{
		text-align: center;
	}
	table.table-objek-pajak td.text-right{
		text-align: right;
	}
	form input[type=text]{
		text-transform:uppercase;
	}
</style>

