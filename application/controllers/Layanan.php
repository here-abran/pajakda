<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->npoptkp = 60000000;
        $this->load->model('Sspd_model', 'sspd');
        $this->load->model('Sspddetail_model', 'sspd_detail');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Layanan';
        $data['content'] = 'layanan';
        $data['state'] = 'show';
        $data['type'] = '';
        $this->template($data);
    }

    public function add() {
        $data = array();
        $data['title'] = 'Layanan';
        $data['content'] = 'layanan';
        $data['state'] = 'add';
        $data['type'] = '';

        if ($this->input->get('type')) {
            $this->load->model('Kabupaten_model', 'kabupaten');
            $data['npoptkp'] = $this->npoptkp;
            $data['kabupaten'] = $this->kabupaten->get_all();
            $data['kabupaten_bantul'] = $this->kabupaten->get_many_by(array('id_provinsi' => 34, 'id_kabupaten' => 02));
            $data['hak_atas_tanah'] = $this->list_hak_atas_tanah();
            $data['alasan_pengurangan'] = $this->list_alasan_pengurangan();
            $data['type'] = $this->input->get('type');
            $data['js_file'] = 'layanan';
        }

        $this->template($data);
    }

    public function insert() {
        $post = $this->input->post();
        if ($post['type'] == 'sspd') {
            $data = $post;
            $data_detail = array();
            unset($data['objekPajak']);
            unset($data['type']);
            unset($data['jmlSetoranCheck']);
            if (isset($data['sspdPersenCheck']))
                unset($data['sspdPersenCheck']);;
            // var_dump($post);
            $nilaiNpop = 0;
            foreach ($post['objekPajak'] as $obj) {
                $v = explode(';', $obj);
                $is_sspd = false;
                if ($v[0] == 'on')
                    $is_sspd = true;
                $data_detail[] = array(
                    'nopPBB' => $v[1],
                    'hakAtasTanah' => $v[2],
                    'noSertifikat' => $v[3],
                    'luasBumi' => $v[4],
                    'njopBumi' => $v[5],
                    'luasBangunan' => $v[6],
                    'njopBangunan' => $v[7],
                    'npop' => $v[8],
                    'lokasiPBB' => $v[9],
                    'blokPBB' => $v[10],
                    'rtrwPBB' => $v[11],
                    'kabupatenPBB' => $this->beautifyWilayah($v[12]),
                    'kecamatanPBB' => $this->beautifyWilayah($v[13]),
                    'kelurahanPBB' => $this->beautifyWilayah($v[14]),
                    'kodeposPBB' => $v[15],
                    'is_sspd' => $is_sspd
                );
                $nilaiNpop += $v[8];
            }

            $data['sspdNama'] = strtoupper($data['sspdNama']);
            $data['sspdAlamat'] = strtoupper($data['sspdAlamat']);
            $data['sspdBlok'] = strtoupper($data['sspdBlok']);
            $data['sspdRtRw'] = strtoupper($data['sspdRtRw']);
            $data['sspdFormNo'] = $this->sspd->generateFormNo(date('Y'), date('m'));
            $data['sspdKabupaten'] = $this->beautifyWilayah($data['sspdKabupaten']);
            $data['sspdKecamatan'] = $this->beautifyWilayah($data['sspdKecamatan']);
            $data['sspdKelurahan'] = $this->beautifyWilayah($data['sspdKelurahan']);
            $data['sspdNpop'] = ($data['hargaTransaksi'] > $nilaiNpop) ? $data['hargaTransaksi'] : $nilaiNpop;
            $data['sspdNpoptkp'] = $this->npoptkp;

            $npopkp = $data['sspdNpop'] - $data['sspdNpoptkp'];
            $data['sspdNpopkp'] = ($npopkp > 0) ? $npopkp : 0;
            $data['sspdTerhutang'] = 0.05 * $data['sspdNpopkp'];
            $data['sspdPersenValue'] = 0;
            if (isset($post['sspdPersenCheck'])) {
                $data['sspdPersenValue'] = 0.5 * $data['sspdTerhutang'];
            }

            $data['sspdBayar'] = $data['sspdTerhutang'] - $data['sspdPersenValue'];
            $data['jmlSetoranCheck'] = $post['jmlSetoranCheck'];
            $data['jmlSetoranValue'] = '';

            if ($data['jmlSetoranCheck'] == 'B') {
                $data['jmlSetoranValue'] = json_encode(array(
                    'alasanPenguranganBradio' => $data['alasanPenguranganBradio'],
                    'alasanPenguranganBNo' => $data['alasanPenguranganBNo'],
                    'alasanPenguranganBTgl' => $data['alasanPenguranganBTgl'],
                ));
                unset($data['alasanPenguranganBradio']);
                unset($data['alasanPenguranganBNo']);
                unset($data['alasanPenguranganBTgl']);
            } elseif ($data['jmlSetoranCheck'] == 'C') {
                $data['jmlSetoranValue'] = json_encode(array(
                    'alasanPenguranganC' => $data['alasanPenguranganC'],
                ));
                unset($data['alasanPenguranganC']);
            } elseif ($data['jmlSetoranCheck'] == 'D') {
                $data['jmlSetoranValue'] = json_encode(array(
                    'alasanPenguranganD' => $data['alasanPenguranganD'],
                ));
                unset($data['alasanPenguranganD']);
            }

            $data['sspdStatusBayar'] = 0; // 0 : belum bayar, 1 : sudah bayar
            $data['sspdTrxDate'] = date('Y-m-d H:i:s');

            $sspdId = $this->sspd->insert($data);
            if ($sspdId) {
                foreach ($data_detail as $i => $value) {
                    $data_detail[$i]['sspdId'] = $sspdId;
                }

                if (count($data_detail) > 0)
                    $this->sspd_detail->insert_batch($data_detail);

                redirect(base_url() . 'index.php/layanan/cetak?type=bphtb&nik=' . $data['sspdNik'] . '&noForm=' . $data['sspdFormNo']);
            }
            // var_dump($post);
            // var_dump($data);
            // var_dump($data_detail);
        }
    }

    public function cetak_pdf() {
        // http://localhost/project/ipajakda_web_sspd_bphttb/index.php/layanan/cetak?type=bphtb&nik=3241&noForm=2018.03.0001
    }

    public function cetak() {
        $get = $this->input->get();
        if ($get) {
            $data = $get;
            $data['title'] = 'Cetak';
            $data['content'] = 'cetak_show';
            $data['cetak_dok'] = 'cetak/sspd';
            $this->sspd->select('sspd.*, sspd_detail.*');
            $this->sspd->select('kab_sspd.nama_kabupaten as sspdKabupatenNama, kec_sspd.nama_kecamatan as sspdKecamatanNama, kel_sspd.nama_kelurahan as sspdKelurahanNama');

            $this->sspd->select('kab_pbb.nama_kabupaten as pbbKabupatenNama, kec_pbb.nama_kecamatan as pbbKecamatanNama, kel_pbb.nama_kelurahan as pbbKelurahanNama');

            $this->sspd->join('sspd_detail');
            $this->sspd->join('ref_kabupaten kab_sspd');
            $this->sspd->join('ref_kecamatan kec_sspd');
            $this->sspd->join('ref_kelurahan kel_sspd');
            $this->sspd->join('ref_kabupaten kab_pbb');
            $this->sspd->join('ref_kecamatan kec_pbb');
            $this->sspd->join('ref_kelurahan kel_pbb');
            $data['sspd'] = $this->sspd->get_by(array('sspdNik' => $get['nik'], 'sspdFormNo' => $get['noForm'], 'is_sspd' => 1));
            if ($data['sspd'] != NULL) {
                $data['sspd_detail'] = $this->sspd_detail->get_many_by(array('sspdId' => $data['sspd']['sspdId']));
                $data['hak_atas_tanah'] = $this->list_hak_atas_tanah('array');
                $data['npoptkp'] = $this->npoptkp;
                $data['url_print'] = base_url() . 'index.php/layanan/cetak?' . http_build_query($get) . '&do=printpdf';
            } else {
                $data['error'] = 'Tidak ditemukan SSPD BPHTB dengan No NIK Wajib Pajak dan No Formulir SSPD yang diberikan.';
            }
            if (isset($get['do'])) {
                if ($get['do'] == 'print') {
                    $this->load->view('template/moderna/' . $data['cetak_dok'], $data);
                } elseif ($get['do'] == 'printpdf') {
                    set_time_limit(0);
                    include_once APPPATH . 'third_party/mPDF/mpdf.php';
//                    echo "<pre>";
//                    print_r($this->load->view('template/moderna/' . $data['cetak_dok'] . '_pdf', $data, TRUE));
//                    print_r($data);
////                    echo "</pre>";
//                    exit();
                    $mpdf = new mPDF('c', 'F4', '', '', 2, 2, 2, 0, 0, 0);
                    $mpdf->SetProtection(array('print'));
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->WriteHTML($this->load->view('template/moderna/' . $data['cetak_dok'] . '_pdf', $data, TRUE));
                    $mpdf->debug = true;
                    $mpdf->setTitle('tes');
                    $mpdf->Output(url_title('tes') . '.pdf', 'i');
                    exit;

                    // $a = $this->load->view('template/moderna/'.$data['cetak_dok'], $data);
                }
            } else {
                $this->template($data);
            }
        } else {
            // redirect();
        }
    }

    /* public function generate_wilayah(){
      $this->load->model('Kabupaten_model', 'kabupaten');
      foreach ($this->kabupaten->get_all() as $kab) {
      $kabCode = str_pad($kab['id_provinsi'], 2, '0', STR_PAD_LEFT);
      $kabCode .= str_pad($kab['id_kabupaten'], 2, '0', STR_PAD_LEFT);
      $this->kabupaten->update_by(array('id_provinsi' => $kab['id_provinsi'], 'id_kabupaten' => $kab['id_kabupaten']), array('kabCode' => $kabCode));
      }

      $this->load->model('Kecamatan_model', 'kecamatan');
      foreach ($this->kecamatan->get_all() as $kab) {
      $kabCode = str_pad($kab['id_provinsi'], 2, '0', STR_PAD_LEFT);
      $kabCode .= str_pad($kab['id_kabupaten'], 2, '0', STR_PAD_LEFT);
      $kabCode .= str_pad($kab['id_kecamatan'], 2, '0', STR_PAD_LEFT);

      $this->kecamatan->update_by(array('id_provinsi' => $kab['id_provinsi'], 'id_kabupaten' => $kab['id_kabupaten'], 'id_kecamatan' => $kab['id_kecamatan']), array('kecCode' => $kabCode));
      }

      $this->load->model('Kelurahan_model', 'kelurahan');
      foreach ($this->kelurahan->get_all() as $kab) {
      $kabCode = str_pad($kab['id_provinsi'], 2, '0', STR_PAD_LEFT);
      $kabCode .= str_pad($kab['id_kabupaten'], 2, '0', STR_PAD_LEFT);
      $kabCode .= str_pad($kab['id_kecamatan'], 2, '0', STR_PAD_LEFT);
      $kabCode .= str_pad($kab['id_kelurahan'], 2, '0', STR_PAD_LEFT);

      $this->kelurahan->update_by(array('id_provinsi' => $kab['id_provinsi'], 'id_kabupaten' => $kab['id_kabupaten'], 'id_kecamatan' => $kab['id_kecamatan'], 'id_kelurahan' => $kab['id_kelurahan']), array('kelCode' => $kabCode));
      }
      } */

    private function beautifyWilayah($text = '') {
        $ret = '';
        $txs = explode('|', $text);
        foreach ($txs as $tx) {
            $ret .= str_pad($tx, 2, '0', STR_PAD_LEFT);
        }
        return $ret;
    }

    public function get_kecamatan() {
        $req = $this->input->get('req');
        list($prov_id, $kab_id) = explode('|', $req);

        $this->load->model('Kecamatan_model', 'kecamatan');
        // $this->kecamatan->order_by('cast(id_provinsi as unsigned)', 'ASC');
        // $this->kecamatan->order_by('cast(id_kabupaten as unsigned)', 'ASC');
        $this->kecamatan->order_by('nama_kecamatan', 'ASC');
        $data = $this->kecamatan->get_many_by(array('id_provinsi' => $prov_id, 'id_kabupaten' => $kab_id));
        echo json_encode($data);
    }

    public function get_kecamatan_bantul() {
        $req = $this->input->get('req');
        list($prov_id, $kab_id) = explode('|', $req);
        $prov_id = 34;
        $kab_id = 02;

        $this->load->model('Kecamatan_model', 'kecamatan');
        // $this->kecamatan->order_by('cast(id_provinsi as unsigned)', 'ASC');
        // $this->kecamatan->order_by('cast(id_kabupaten as unsigned)', 'ASC');
        $this->kecamatan->order_by('nama_kecamatan', 'ASC');
        $data = $this->kecamatan->get_many_by(array('id_provinsi' => $prov_id, 'id_kabupaten' => $kab_id));
        echo json_encode($data);
    }

    public function get_kelurahan() {
        $req = $this->input->get('req');
        list($prov_id, $kab_id, $kec_id) = explode('|', $req);

        $this->load->model('Kelurahan_model', 'kelurahan');
        // $this->kecamatan->order_by('cast(id_provinsi as unsigned)', 'ASC');
        // $this->kecamatan->order_by('cast(id_kabupaten as unsigned)', 'ASC');
        $this->kelurahan->order_by('nama_kelurahan', 'ASC');
        $data = $this->kelurahan->get_many_by(array('id_provinsi' => $prov_id, 'id_kabupaten' => $kab_id, 'id_kecamatan' => $kec_id));
        echo json_encode($data);
    }

    private function list_hak_atas_tanah($type = 'db') {
        $ret = array();
        $ret[] = array('hakId' => 1, 'hakName' => 'Jual Beli', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 2, 'hakName' => 'Tukar Menukar', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 3, 'hakName' => 'Hibah', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 4, 'hakName' => 'Hibah Wasiat', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 5, 'hakName' => 'Waris', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 6, 'hakName' => 'Pemasukan dalam perseroan / badan hukum lainnya', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 7, 'hakName' => 'Pemisahan hak yang mengakibatkan peralihan', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 8, 'hakName' => 'Penunjukan pembeli dalam lelang', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 9, 'hakName' => 'Pelaksanaan putusan hakim yang mempunyai kekuatan hukum tetap', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 10, 'hakName' => 'Penggabungan usaha', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 11, 'hakName' => 'Peleburan usaha', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 12, 'hakName' => 'Pemekaran usaha', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 13, 'hakName' => 'Hadiah', 'optGroup' => 'Pemindahan Hak');
        $ret[] = array('hakId' => 14, 'hakName' => 'Pemberian hak baru sebagai kelanjutan pelepasan hak', 'optGroup' => 'Pemberian Hak Baru');
        $ret[] = array('hakId' => 15, 'hakName' => 'Pemberian hak baru dilepas pelepasan hak', 'optGroup' => 'Pemberian Hak Baru');
        if ($type == 'array') {
            $temp = array();
            foreach ($ret as $rt) {
                $temp[$rt['hakId']] = $rt['hakName'];
            }
            $ret = $temp;
        }
        return $ret;
    }

    private function list_alasan_pengurangan() {
        $ret = array();
        $ret[] = array('krId' => 1, 'krValue' => 0.75, 'krName' => 'Wajib pajak orang pribadi yang memperoleh hak baru melalui program pemerintah di bidang pertanahan dan tidak mempunyai kemampuan secara ekonomis');
        $ret[] = array('krId' => 2, 'krValue' => 0.5, 'krName' => 'Wajib pajak yang memperoleh hak atas tanah dan/atau bangunan yang tidak berfungsi lagi seperti semula disebabkan bencana alam atau sebab-sebab lainnya seperti kebakaran, banjie, tanah longsor, gempa bumi, gunung meletus, huru-hara dan lain-lain yang terjadi dalam jangka waktu paling lama 3 (tiga) bulan sejak penandatanganan akta');
        $ret[] = array('krId' => 3, 'krValue' => 0.5, 'krName' => 'Wajib pajak Badan yang mempunyai hak baru selain Hak Pengelolaan dan telah menguasai tanah dan/atau bangunan secara fisik lebih dari 20 (dua puluh) tahun yang dibuktikan dengan surat pernyataan Wajib Pajak dan keterangan dari Pejabat Pemerintah');
        $ret[] = array('krId' => 4, 'krValue' => 0.5, 'krName' => 'Wajib pajak yang memperoleh hak atas tanah melalui pembelian dari hasil ganti rugi pemerintah yang nilai ganti ruginya dibawah Nilai Jual Objek Pajak Pajak Bumi dan Bangunan');
        $ret[] = array('krId' => 5, 'krValue' => 0.5, 'krName' => 'Wajib pajak yang memperoleh hak atas tanah sebagai pengganti atas tanah yang dibebaskan oleh pemerintah untuk kepentingan umum');
        $ret[] = array('krId' => 6, 'krValue' => 0.5, 'krName' => 'Wajib pajak orang pribadi Veteran, PNS, TNI, POLRI, pensiunan PNS, purnawirawan TNI, purnawirawan POLRI atau janda/dudanya yang memperoleh hak atas tanah dan/atau bangunan rumah dinas pemerintah');
        $ret[] = array('krId' => 7, 'krValue' => 0.5, 'krName' => 'Wajib pajak yang memperoleh hak atas tanah dan/atau bangunan yang akan digunakan untuk kepentingan sosial, keagamaan atau pendidikan yang semata-mata tidak untuk mencari keuntungan antara lain untuk panti asuhan, panti jompo, rumah yatim piatu, sekolah yang tidak ditujukan mencari keuntungan, rumah sakit swasta yang memiliki institusi pelayanan sosial masyarakat');
        $ret[] = array('krId' => 8, 'krValue' => 0.5, 'krName' => 'Wajib pajak orang pribadi yang menerima hibah dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau satu derajat ke bawah');
        $ret[] = array('krId' => 9, 'krValue' => 0.5, 'krName' => 'Wajib pajak Badan yang terkena dampak krisis ekonomi dan moneter yang berdampak luas pada kehidupan perekonomian nasional sehingga Wajib Pajak harus melakukan restrukturisasi usaha dan ???? usaha sesuai dengan kebijaksanaan pemerintah');
        $ret[] = array('krId' => 10, 'krValue' => 0.5, 'krName' => 'Wajib pajak Badan yang melakukan penggabungan usaha (merger) atau peleburan usaha (konsolidasi) dengan atau tanpa terlebih dahulu mengadakan likuidasi dan telah memperoleh keputusan persetujuan penggunaan Nilai Buku dalam rangka penggabungan atau peleburan usaha');
        $ret[] = array('krId' => 11, 'krValue' => 0.25, 'krName' => 'Wajib pajak orang pribadi yang memperoleh hak ats tanah dan/atau bangunan Rumah Susun Sederhana serta Rumah Sangat Sederhana (RSS) yang diperoleh langsung dari pengembang dan dibayar secara angsuran');

        return $ret;
    }

    public function cek_nop() {
        if (!$this->input->is_ajax_request())
            return;

        $this->load->library('PHPRequests');
        $headers = array('Content-Type' => 'application/json');
        if (empty($this->input->post('nop'))) {
            $output['status'] = FALSE;
            $output['pesan'] = 'NOP harus diisi';
            return $this->output->set_output(json_encode($output));
        }
        // build data
        $data = array('nop' => $this->input->post('nop'));
        $opt = array('timeout' => 90, 'connect_timeout' => 90, 'verify' => FALSE);
        // request ke API
        $response = Requests::post('https://pajakda.bantulkab.go.id/api/v1/pbb/cek_nop', array(), $data, $opt);
        $result_nop = json_decode($response->body);
        // request cek pembayaran
        $response_pembayaran = Requests::post('https://pajakda.bantulkab.go.id/api/v1/pbb/cek_nop_pbb', array(), $data, $opt);
        $rs_pembayaran = json_decode($response_pembayaran->body);

        $result['STATUS_PEMBAYARAN'] = TRUE;

        foreach ($rs_pembayaran as $i => $vn) {
            if ($vn->STATUS == 0) {
                $result_nop->STATUS_PEMBAYARAN = FALSE;
                $result_nop->pesan = 'Terdapat pembayaran yang belum dilunasi';
            } else {
                $result_nop->pesan = '';
            }
        }

        return $this->output->set_output(json_encode($result_nop));
    }

}
