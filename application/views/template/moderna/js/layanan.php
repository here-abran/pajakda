<link href="<?php echo base_url('template/moderna'); ?>/dist/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url('template/moderna'); ?>/dist/select2-4.0.3/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/terbilang.js"></script>
<script src="<?= base_url('assets/jquery-form-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery-form-validation/languages/messages_id.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-mask/jquery.inputmask.bundle.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input.numeric').inputmask('numeric', {rightAlign: true, radixPoint: ',', groupSeparator: '.', prefix: '', digits:0, autoGroup:true});
    })
    $(document).ready(function () {
        // $(".select2").select2();
        $("select#sspdKabupaten").select2({placeholder: "Pilih Kabupaten", });
        $("select#sspdKecamatan").select2({placeholder: "Pilih Kecamatan", });
        $("select#sspdKelurahan").select2({placeholder: "Pilih Kelurahan/Desa", });
        $("select#hakAtasTanah").select2({placeholder: "Pilih Hak Atas Tanah", });
        $("select#alasanPenguranganC").select2({placeholder: "Pilih Alasan Pengurangan", });

        $('#sspdKabupaten').change(function (event) {
            req = $(this).val();
            $('#sspdKecamatan').html('<option value=""></option>');
            $.get('<?php echo base_url() ?>index.php/layanan/get_kecamatan?req=' + req, function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#sspdKecamatan').append("<option value='" + data[i].id_provinsi + '|' + data[i].id_kabupaten + '|' + data[i].id_kecamatan + "'>" + data[i].nama_kecamatan + "</option>");
                }
                $('#sspdKecamatan').trigger('change');
            }, 'json');
        });

        $('#sspdKecamatan').change(function (event) {
            req = $(this).val();
            $('#sspdKelurahan').html('<option value=""></option>');
            $.get('<?php echo base_url() ?>index.php/layanan/get_kelurahan?req=' + req, function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#sspdKelurahan').append("<option value='" + data[i].id_provinsi + '|' + data[i].id_kabupaten + '|' + data[i].id_kecamatan + '|' + data[i].id_kelurahan + "'>" + data[i].nama_kelurahan + "</option>");
                }
            }, 'json');
        });

        $('#sspdKabupaten').trigger('change');

        // $("select#kabupatenObjekPajak").select2({placeholder: "Pilih Kabupaten", });
        // $("select#kecamatanObjekPajak").select2({placeholder: "Pilih Kecamatan", });
        // $("select#kelurahanObjekPajak").select2({placeholder: "Pilih Kelurahan/Desa", });

        $('#kabupatenObjekPajak').change(function (event) {
            req = $(this).val();
            $('#kecamatanObjekPajak').html('');
            $.get('<?php echo base_url() ?>index.php/layanan/get_kecamatan_bantul?req=' + req, function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#kecamatanObjekPajak').append("<option value='" + data[i].id_provinsi + '|' + data[i].id_kabupaten + '|' + data[i].id_kecamatan + "'>" + data[i].nama_kecamatan + "</option>");
                }
                $('#kecamatanObjekPajak').trigger('change');
            }, 'json');
        });

        $('#kecamatanObjekPajak').change(function (event) {
            req = $(this).val();
            $('#kelurahanObjekPajak').html('');
            $.get('<?php echo base_url() ?>index.php/layanan/get_kelurahan?req=' + req, function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#kelurahanObjekPajak').append("<option value='" + data[i].id_provinsi + '|' + data[i].id_kabupaten + '|' + data[i].id_kecamatan + '|' + data[i].id_kelurahan + "'>" + data[i].nama_kelurahan + "</option>");
                }
            }, 'json');
        });

        $('#kabupatenObjekPajak').trigger('change');


        var no = 0;
        var total = 0;
        var npopkp = 0;
        var npoptkp = <?php echo $npoptkp ?>;
        var terhutang = 0;

        function remove_comma(string){
            return string.replace(/\D/g,'');
        }

        function ribuan(bilangan) {
            var reverse = bilangan.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }

        window.rupiah = function (bilangan, with_rp) {
            if(bilangan == NaN) bilangan = '0';
            console.log(bilangan)
            var reverse = bilangan.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');

            text = 'Rp. ' + ribuan + ',00';
            if (with_rp == false)
                text = ribuan + ',00';
            return text;
        }

        function hitungBPHTB() {
            total_hitung = total;
            if(remove_comma($('#hargaTransaksi').val()) > total){
                total_hitung = remove_comma($('#hargaTransaksi').val());

                npopkp = total_hitung - npoptkp;
                terhutang = 0;

                if (npopkp < 0) npopkp = 0;
            }

            terhutang = 0.05 * npopkp;

            $('input#sspdNpop').val(rupiah(total_hitung, false));
            $('input#sspdNpoptkp').val(rupiah(npoptkp, false));
            $('input#sspdNpopkp').val(rupiah(npopkp, false));
            $('input#sspdTerhutang').val(rupiah(terhutang, false));

            var persen = 0;
            if ($('input#sspdPersenCheck').is(':checked')) {
                persen = 0.5 * terhutang;
                $('input#sspdPersenValue').val(rupiah(persen, false));
            } else {
                $('input#sspdPersenValue').val(rupiah(persen, false));
            }

            bayar = terhutang - persen;

            // alert($("input[name='jmlSetoranCheck']:checked").val());

            $('input#sspdBayar').val(rupiah(bayar, false));

            if($("input[name='jmlSetoranCheck']:checked").val() == 'C'){
                pengurangan = $('select#alasanPenguranganC').val();
                bayar = bayar - (bayar * pengurangan);
            }

            $('input#jumlahPembayaran').val(rupiah(bayar, false));
            $('td#terbilang').html(terbilang('0' + bayar));
        }

        $('input#sspdPersenCheck').change(function (event) {
            hitungBPHTB();
        });

        $('select#alasanPenguranganC').change(function(event) {
            hitungBPHTB();
        });

        $('input.jmlSetoranCheck').change(function(event) {
            hitungBPHTB();
            $('select#alasanPenguranganC').val('');
            $('select#alasanPenguranganBradio').val('');
        });

        hak_atas_tanah = new Array;
        <?php foreach ($hak_atas_tanah as $hak) { ?>
            hak_atas_tanah[<?php echo $hak['hakId'] ?>] = '<?php echo $hak['hakName'] ?>';
        <?php } ?>

        $("#form-objek-pajak").validate({
            submitHandler: function (form) {
                /* Act on the event */
                nomorObjekPajak = $('input#nomorObjekPajak').val();
                checkNOP = $('input#checkNOP').val();
                hakAtasTanah = $('select#hakAtasTanah').val();
                nomorSertifikat = $('input#nomorSertifikat').val();
                luasTanahObjekPajak = remove_comma($('input#luasTanahObjekPajak').val());
                njopTanahObjekPajak = remove_comma($('input#njopTanahObjekPajak').val());
                luasBangunanObjekPajak = remove_comma($('input#luasBangunanObjekPajak').val());
                njopBangunanObjekPajak = remove_comma($('input#njopBangunanObjekPajak').val());

                lokasiObjekPajak = $('input#lokasiObjekPajak').val();
                blokObjekPajak = $('input#blokObjekPajak').val();
                rtObjekPajak = $('input#rtObjekPajak').val();
                kabupatenObjekPajak = $('select#kabupatenObjekPajak').val();
                kecamatanObjekPajak = $('select#kecamatanObjekPajak').val();
                kelurahanObjekPajak = $('select#kelurahanObjekPajak').val();
                kelurahanObjekPajak = $('select#kelurahanObjekPajak').val();
                kodeposObjekPajak = $('input#kodeposObjekPajak').val();
                luasBumiSertifikatObjekPajak = remove_comma($('input#luasBumiSertifikatObjekPajak').val());
                luasBangunanSertifikatObjekPajak = remove_comma($('input#luasBangunanSertifikatObjekPajak').val());

                subtotal = (parseFloat(luasBumiSertifikatObjekPajak) * parseFloat(njopTanahObjekPajak)) + (parseFloat(luasBangunanSertifikatObjekPajak) * parseFloat(njopBangunanObjekPajak));
                total = total + subtotal;

                input_value = checkNOP + ';' + nomorObjekPajak + ';' + hakAtasTanah + ';' + nomorSertifikat + ';' + luasTanahObjekPajak + ';' + njopTanahObjekPajak + ';' + luasBangunanObjekPajak + ';' + njopBangunanObjekPajak + ';' + subtotal + ';' + lokasiObjekPajak + ';' + blokObjekPajak + ';' + rtObjekPajak + ';' + kabupatenObjekPajak + ';' + kecamatanObjekPajak + ';' + kelurahanObjekPajak + ';' + kodeposObjekPajak + ';' + luasBumiSertifikatObjekPajak + ';' + luasBangunanSertifikatObjekPajak;

                input = '<input type="hidden" name="objekPajak[]" class="objekPajak" value="' + input_value + '">';

                html = '<tr>';
                html += '<td class="text-center">' + (no + 1) + '.' + input + '</td>';
                html += '<td class="text-center"><a href="#" class="delete_objek">Hapus</a></td>';
                html += '<td>' + nomorObjekPajak + '</td>';
                html += '<td>' + hak_atas_tanah[hakAtasTanah] + '</td>';
                html += '<td class="text-center">' + nomorSertifikat + '</td>';
                html += '<td class="text-center">' + ribuan(luasBumiSertifikatObjekPajak) + ' | ' + ribuan(luasBangunanSertifikatObjekPajak) + '</td>';
                html += '<td class="text-center">' + rupiah(njopTanahObjekPajak, true) + ' | ' + rupiah(njopBangunanObjekPajak, true) + '</td>';
                html += '<td class="text-right">' + rupiah(subtotal, true) + '</td>';
                html += '</tr>';

                if (no == 0) {
                    $('table.table-objek-pajak tbody').html(html);
                } else {
                    $('table.table-objek-pajak tbody').append(html);
                }

                $('table.table-objek-pajak tfoot').html("<tr><td colspan='7'><b>TOTAL</b></td><td class='text-right'>" + rupiah(total, true) + "</td></tr>");

                no++;

                if(hakAtasTanah == 4 || hakAtasTanah == 5){
                    // hibah waris atau waris
                    npoptkp = 300000000;
                    $('#hargaTransaksi').val(0); 
                    $('#hargaTransaksi').attr('readonly', 'readonly'); 
                }else{
                    npoptkp = <?php echo $npoptkp ?>;
                    $('#hargaTransaksi').val(0); 
                    $('#hargaTransaksi').removeAttr('readonly');
                }

                npopkp = total - npoptkp;
                terhutang = 0;

                if (npopkp < 0) npopkp = 0;

                hitungBPHTB();

                $('#modalObjekPajak').modal('toggle');
                $('#form-objek-pajak')[0].reset();
                return false;
            }
        });

        // $('form#form-objek-pajak').submit(function(){
        // 	nomorObjekPajak 	= $('input#nomorObjekPajak').val();
        // 	checkNOP 			= $('input#checkNOP').val();
        // 	hakAtasTanah 		= $('select#hakAtasTanah').val();
        // 	nomorSertifikat 	= $('input#nomorSertifikat').val();
        // 	luasTanahObjekPajak = $('input#luasTanahObjekPajak').val();
        // 	njopTanahObjekPajak = $('input#njopTanahObjekPajak').val();
        // 	luasBangunanObjekPajak = $('input#luasBangunanObjekPajak').val();
        // 	njopBangunanObjekPajak = $('input#njopBangunanObjekPajak').val();

        // 	lokasiObjekPajak = $('input#lokasiObjekPajak').val();
        // 	blokObjekPajak = $('input#blokObjekPajak').val();
        // 	rtObjekPajak = $('input#rtObjekPajak').val();
        // 	kabupatenObjekPajak = $('select#kabupatenObjekPajak').val();
        // 	kecamatanObjekPajak = $('select#kecamatanObjekPajak').val();
        // 	kelurahanObjekPajak = $('select#kelurahanObjekPajak').val();
        // 	kelurahanObjekPajak = $('select#kelurahanObjekPajak').val();
        // 	kodeposObjekPajak = $('input#kodeposObjekPajak').val();

        // 	subtotal = (parseFloat(luasTanahObjekPajak) * parseFloat(njopTanahObjekPajak)) + (parseFloat(luasBangunanObjekPajak) * parseFloat(njopBangunanObjekPajak));
        // 	total = total + subtotal;

        // 	input_value = checkNOP+';'+nomorObjekPajak+';'+hakAtasTanah+';'+nomorSertifikat+';'+luasTanahObjekPajak+';'+njopTanahObjekPajak+';'+luasBangunanObjekPajak+';'+njopBangunanObjekPajak+';'+subtotal+';'+lokasiObjekPajak+';'+blokObjekPajak+';'+rtObjekPajak+';'+kabupatenObjekPajak+';'+kecamatanObjekPajak+';'+kelurahanObjekPajak+';'+kodeposObjekPajak;

        // 	input = '<input type="hidden" name="objekPajak[]" class="objekPajak" value="'+input_value+'">';

        // 	html = '<tr>';
        // 	html += '<td class="text-center">'+(no+1)+'.'+input+'</td>';
        // 	html += '<td class="text-center"><a href="#" class="delete_objek">Hapus</a></td>';
        // 	html += '<td>'+nomorObjekPajak+'</td>';
        // 	html += '<td class="text-center">'+nomorSertifikat+'</td>';
        // 	html += '<td class="text-center">'+ribuan(luasTanahObjekPajak)+' | '+ribuan(luasBangunanObjekPajak)+'</td>';
        // 	html += '<td class="text-center">'+rupiah(njopTanahObjekPajak, true)+' | '+rupiah(njopBangunanObjekPajak, true)+'</td>';
        // 	html += '<td class="text-right">'+rupiah(subtotal, true)+'</td>';
        // 	html += '</tr>';

        // 	if(no == 0){
        // 		$('table.table-objek-pajak tbody').html(html);
        // 	}else{
        // 		$('table.table-objek-pajak tbody').append(html);
        // 	}

        // 	$('table.table-objek-pajak tfoot').html("<tr><td colspan='6'><b>TOTAL</b></td><td class='text-right'>"+rupiah(total, true)+"</td></tr>");

        // 	no++;

        // 	npopkp = total - npoptkp;
        // 	if(npopkp < 0) npopkp = 0;
        // 	else{
        // 		terhutang = 0.05 * npopkp;
        // 	}

        // 	hitungBPHTB();

        // 	$('#modalObjekPajak').modal('toggle');
        // 	$('#form-objek-pajak')[0].reset();
        // 	return false;
        // });

        $('input.jmlSetoranCheck').change(function (data) {
            v = $(this).val();
            thing = ['A', 'B', 'C', 'D'];
            for (var i = 0; i < thing.length; i++) {
                if (thing[i] == v) {
                    $('tr.alasan_' + thing[i] + ' td input').removeAttr('disabled');
                    $('tr.alasan_' + thing[i] + ' td select').removeAttr('disabled');
                } else {
                    $('tr.alasan_' + thing[i] + ' td input[type=text]').val('');
                    $('tr.alasan_' + thing[i] + ' td select').val('');
                    $('tr.alasan_' + thing[i] + ' td input:not(.jmlSetoranCheck)').attr('disabled', 'disabled');
                    $('tr.alasan_' + thing[i] + ' td select:not(.jmlSetoranCheck)').attr('disabled', 'disabled');
                }
            }
        })

        $('body').delegate('.delete_objek', 'click', function (event) {
            a = confirm('Hapus Objek Pajak Terpilih?');
            if (a) {
                val = $(this).parent().parent().find('input.objekPajak').val();
                d = val.split(';');
                total = total - d[8];
                npopkp = total - npoptkp;

                if (npopkp <= 0) {
                    npopkp = 0;
                    terhutang = 0;
                } else {
                    terhutang = 0.05 * npopkp;
                }
                no--;

                if (no == 0) {
                    $('table.table-objek-pajak tbody').html('<tr><td colspan="8">Belum ada Objek Pajak</td></tr>');
                }
                $('table.table-objek-pajak tfoot').html("<tr><td colspan='7'><b>TOTAL</b></td><td class='text-right'>" + rupiah(total, true) + "</td></tr>");

                hitungBPHTB();

                $(this).parent().parent().remove();
            }
            return false;
        });
        hitungBPHTB();

        $('form#form-sspd').submit(function (event) {
            if (!$('input.objekPajak').length) {
                alert("Silahkan masukan objek pajak terlebih dahulu dengan menekan tombol\n'+ TAMBAH OBJEK PAJAK' dan mengisikan form objek pajak.");
                return false;
            }
        });

        $('#cek-nop').on('click', function () {
            if($('#nomorObjekPajak').val().length >= 18){
                $('#cek-nop').prop('disabled', true);
                $('#cek-nop').val('Harap Tunggu..');
                $('#cek-nop').html('Harap Tunggu..');
                $("body").css("cursor", "progress");
                $.ajax({
                    url: "<?php echo base_url('index.php/layanan/cek_nop') ?>",
                    type: "POST",
                    data: "nop=" + $('#nomorObjekPajak').val(),
                    timeout: 120000,
                    dataType: "json",
                    success: function (data)
                    {
                        if(data.status == false){
                            alert(data.pesan);
                        }else{
                            $('#lokasiObjekPajak').val(data.LOKASI);
                            $('#blokObjekPajak').val(data.BLOK);
                            $('#rtObjekPajak').val(data.RTRW);
                            // $('#kabupatenObjekPajak').val(data.NOP_TITIK.split('.')[0] + '|' + data.NOP_TITIK.split('.')[1]).trigger('change');
                            $('#kecamatanObjekPajak').val(data.NOP_TITIK.split('.')[0] + '|' + data.NOP_TITIK.split('.')[1] + '|' + data.NOP_TITIK.split('.')[2]).trigger('change');
                            setTimeout(() => {
                              $('#kelurahanObjekPajak').val(data.NOP_TITIK.split('.')[0] + '|' + data.NOP_TITIK.split('.')[1] + '|' + data.NOP_TITIK.split('.')[2] + '|' + data.NOP_TITIK.split('.')[3]).trigger('change');
                            }, 1000)
                            // $('#kodeposObjekPajak').val(data.BLOK);
                            // $('#hakAtasTanah').val(data.BLOK);
                            // $('#nomorSertifikat').val(data.BLOK);
                            $('#luasTanahObjekPajak').val(ribuan(data.LUASBUMI, false));
                            $('#luasBangunanObjekPajak').val(ribuan(data.LUASBANGUNAN, false));
                            $('#njopTanahObjekPajak').val(ribuan(data.NJOPBUMI, false));
                            $('#njopBangunanObjekPajak').val(ribuan(data.NJOPBANGUNAN, false));
                        }
                        $('#cek-nop').prop('value', 'CEK NOP');
                        $('#cek-nop').val('CEK NOP');
                        $('#cek-nop').html('CEK NOP');
                        $("body").css("cursor", "default");
                        $('#cek-nop').prop('disabled', false);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Terjadi kesalahan saat menghubungkan ke server.');
                        $('#cek-nop').val('CEK NOP');
                        $('#cek-nop').html('CEK NOP');
                        $("body").css("cursor", "default");
                        $('#cek-nop').prop('disabled', false);
                    }
                });
            }else{
                alert('Data tidak ditemukan');
            }
        })

        $('#tombol-next-step2').click(function (event) {
            /* Act on the event */
            // $(this).hide();
            next = false;
            if ( $('#hargaTransaksi').is('[readonly]') ) {
                next = true;
            }else if($('#hargaTransaksi').val() !== '0'){
                next = true;
            }

            if(next == false){
                alert('Harga Transaksi tidak boleh 0!');
                return false;
            }

            $('#tombol-back-step2').hide();
            $('#step3').show();
            $('#step4').show();

            // if ($('input#hargaTransaksi').val() > $('input#sspdNpop').val().replace(/./g, '')) {
            //     $('input#sspdNpop').val(rupiah($('input#hargaTransaksi').val(), false));
            // }
            hitungBPHTB();
        });
    });
</script>
<style type="text/css">
    tr.alasan_C td .select2-container {
        position: relative;
        z-index: 2;
        float: left;
        width: 10%;
        margin-bottom: 0;
        display: table;
        table-layout: fixed;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $("#sspd_form").validate();
        $("#form-sspd").validate();

        $('#tombol-cetak-ulang').click(function () {
            $('#section-pilihan').hide();
            $('#section-form-baru').hide();

            $('#section-cetak-ulang').show();
        })

        $('#tombol-form-baru').click(function () {
            $('#section-pilihan').hide();
            $('#section-cetak-ulang').hide();

            $('#section-form-baru').show();
            $('#step1').show();
        })

        $('#tombol-next-step1').click(function (event) {
            /* validasi form */
            if ($('#form-sspd [name="sspdNik"]').val() == '' ||
                    $('#form-sspd [name="sspdNama"]').val() == '' ||
                    $('#form-sspd [name="sspdAlamat"]').val() == '' ||
                    $('#form-sspd [name="sspdRtRw"]').val() == '' ||
                    $('#form-sspd [name="sspdKabupaten"]').val() == '' ||
                    $('#form-sspd [name="sspdKecamatan"]').val() == '' ||
                    $('#form-sspd [name="sspdKelurahan"]').val() == '' ||
                    $('#form-sspd [name="sspdTelp"]').val() == ''
                    ) {
                //  || $('#form-sspd [name="sspdKodepos"]').val() == ''
                //  $('#form-sspd [name="sspdBlok"]').val() == '' ||
                alert('Terdapat form yang belum diisi.');
            } else {
                /* Act on the event */
                $('#step1').hide();
                $('#step2').show();
                $('#tombol-next-step2').show();
            }
        });

        $('#tombol-back-step2').click(function () {
            $('#step1').show();
            $('#step2').hide();
        })

        $('#tombol-back-step4').click(function () {
            $('#step1').show();
            $('#step2').hide();
            $('#step3').hide();
            $('#step4').hide();
        })

        
    });
</script>
