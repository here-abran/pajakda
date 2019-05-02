<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sspd extends Admin_Controller{
	public function __construct(){
		parent::__construct();

		// init variable
		$this->title 			= 'SSPD';
		$this->content_folder 	= 'content/sspd/';
		$this->redirect_url 	= base_url_admin().'sspd';

		// init model, helper, library
		$this->load->model("Sspd_model", 'sspd');
		$this->load->model('Sspddetail_model', 'sspd_detail');
		$this->npoptkp = 60000000;
	}

	public function index(){
		$data['title']		= $this->title;
		$data['content']	= $this->content_folder.'index';
		$data['datatable_url']	= base_url().$this->config->item('index_page').'/sspd/datatable';

		$this->template($data);
	}

	// add Page by form
	public function add(){
		$data['title']		= 'Tambah '.$this->title;
		$data['state']		= 'add';
		$data['content']	= $this->content_folder.'form';
		$data['url']		= base_url_admin().'sspd/insert';

		$this->template($data);
	}

	// edit Page by form
	public function edit(){
		$id = $this->input->get('id');
		$data['title']		= 'Edit '.$this->title;
		$data['state']		= 'edit';
		$data['content']	= $this->content_folder.'form';
		$data['url']		= base_url_admin().'sspd/update';

		$data['datas'] 		= $this->sspd->get($id);
		$data['id'] 		= $id;

		$this->template($data);
	}

	public function insert(){
		$this->db->trans_start();
		$data = $this->input->post();
		$do_redirect = false;
		if(isset($data['redirect'])){
			$do_redirect = true;
			unset($data['redirect']);
		}

		$ret = array('success' => 'false');
		if($this->sspd->insert($data)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');

			$ret = array('success' => 'true');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
		}

		$this->db->trans_complete();

		if(!$do_redirect) redirect($this->redirect_url);
			else echo json_encode($ret);
	}

	public function update(){
		$this->db->trans_start();
		$data = $this->input->post();
		$id = $data['id'];
		unset($data['id']);

		if($this->sspd->update($id, $data)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di update.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal mengedit data.');
		}
		$this->db->trans_complete();

		redirect($this->redirect_url);
	}

	public function delete(){
		$id = $this->input->get('id');
		if($this->sspd->delete($id)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di hapus.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menghapus data.');
		}
		redirect($this->redirect_url);
	}
	
	public function print_data(){
		$id = $this->input->get('id');
		$data = array();
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
		$data['sspd'] = $this->sspd->get_by(array('sspd.sspdId' => $id));
		
		if($data['sspd'] != NULL){
			$data['sspd_detail'] = $this->sspd_detail->get_many_by(array('sspdId' => $data['sspd']['sspdId']));
			$data['hak_atas_tanah'] = $this->list_hak_atas_tanah('array');
			$data['npoptkp'] = $this->npoptkp;
		}else{
			$data['error'] = 'Tidak ditemukan SSPD BPHTB dengan No NIK Wajib Pajak dan No Formulir SSPD yang diberikan.';
		}

		$data['do']	  = 'print';
		$data['npoptkp'] = $this->npoptkp;

		$this->load->view('template/moderna/cetak/sspd', $data);
	}
	
	public function export_data(){}

	public function datatable(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$this->load->library('ssp');

		$table = 'sspd';
		$primaryKey = 'sspdId';
		$columns = array(
			array(
				'db' => 'sspdId',
				'dt' => 0,
				'field' => 'sspdId',
				'formatter' => function($d, $row) {
					return ''; //blank, for numbering
				}
				),
			array(
				'db' => 'sspdFormNo',
				'dt' => 1,
				'field' => 'sspdFormNo',
				),
			array(
				'db' => 'sspdNik',
				'dt' => 2,
				'field' => 'sspdNik',
				),
			array(
				'db' => 'sspdNama',
				'dt' => 3,
				'field' => 'sspdNama',
				),
			array(
				'db' => 'sspdAlamat',
				'dt' => 4,
				'field' => 'sspdAlamat',
				),
			array(
				'db' => 'nama_kecamatan',
				'dt' => 5,
				'field' => 'nama_kecamatan',
				),
			array(
				'db' => 'nama_kelurahan',
				'dt' => 6,
				'field' => 'nama_kelurahan',
				),
			array(
				'db' => 'hargaTransaksi',
				'dt' => 7,
				'field' => 'hargaTransaksi',
				),
			array(
				'db' => 'sspdNpop',
				'dt' => 8,
				'field' => 'sspdNpop',
				),
			array(
				'db' => 'sspdNpoptkp',
				'dt' => 9,
				'field' => 'sspdNpoptkp',
				),
			array(
				'db' => 'sspdNpopkp',
				'dt' => 10,
				'field' => 'sspdNpopkp',
				),
			array(
				'db' => 'sspdTerhutang',
				'dt' => 11,
				'field' => 'sspdTerhutang',
				),
			array(
				'db' => 'sspdBayar',
				'dt' => 12,
				'field' => 'sspdBayar',
				),
			array(
				'db' => 'sspdId',
				'dt' => 13,
				'field' => 'sspdId',
				'formatter' => function($d, $row) {
					$txt = button_access('print_data', 'sspd', $d);
					$txt .= '&nbsp;';
					// $txt .= button_access('delete', 'sspd', $d);
					return $txt;
				}
				)
			);

		$joinQuery  = 'FROM `sspd` ';
		$joinQuery .= 'LEFT JOIN `ref_kecamatan` ON `sspd`.`sspdKecamatan` = `ref_kecamatan`.`kecCode` ';
		$joinQuery .= 'LEFT JOIN `ref_kelurahan` ON `sspd`.`sspdKelurahan` = `ref_kelurahan`.`kelCode` ';

		$extraWhere = '';
		//$extraWhere = ' t1.isactive = 1';
		$sql_details = array(
			'user' => $this->db->username,
			'pass' => $this->db->password,
			'db' => $this->db->database,
			'host' => $this->db->hostname
		);

		echo @json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy = ''));
	}

	public function autocomplete(){
		$key = $this->input->get('query');
		$ret = array();
		$ret['query'] = $key;
		$ret['suggestions'] = array();

		$data = $this->customer->get_many_like(array('nama_customer' => $key));

		foreach ($data as $i => $v) {
			$ret['suggestions'][] = array('id_pelanggan' => $v['id'], 'value' => $v['nama_customer'].' - '.$v['no_hp']);
		}

		echo json_encode($ret);
	}

	private function list_hak_atas_tanah($type = 'db'){
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
		if($type == 'array'){
			$temp = array();
			foreach ($ret as $rt) {
				$temp[$rt['hakId']] = $rt['hakName'];
			}
			$ret = $temp;
		}
		return $ret;
	}
}
?>