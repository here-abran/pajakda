<section id="content">
	<div class="container">
		<div class="row row-nomargin">
			<div class="col-lg-12">
				<div class="box">
					<center>
						<h4><?php echo strtoupper($type).'<br/>'.$noForm ?></h4>
					</center>
					<div class="box-gray">
						<?php if(!isset($error)){ ?>
							<?php $this->load->view('template/moderna/'.$cetak_dok); ?>
						<?php }else{ ?>
							<center>
							<?php echo $error ?>
							</center>
						<?php } ?>
					</div>
					<center>
						<br/>
						<?php if(isset($url_print)){ ?>
							<a href="<?php echo $url_print ?>" class="btn btn-theme submit">PRINT / PRINT ULANG</a>
						<?php }else{?>
							<a href="<?php echo base_url().'index.php/layanan/add?type=bphtb' ?>" class="btn btn-theme submit">Coba No NIK Wajib Pajak dan No Formulir SSPD Lainnya</a>
						<?php } ?>
					</center>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		a.submit{
			padding: 10px 60px;
		}
	</style>
</section>