<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends Admin_Controller{
	public function __construct(){
		parent::__construct();

		// init variable
		$this->title 			= 'Link';
		$this->content_folder 	= 'content/link/';
		$this->redirect_url 	= base_url_admin().'link';

		// init model, helper, library
		$this->load->model("Link_model", 'link');
	}

	public function index(){
		$data['title']		= $this->title;
		$data['content']	= $this->content_folder.'index';
		$data['datatable_url']	= base_url().$this->config->item('index_page').'/link/datatable';

		$this->template($data);
	}

	// add Page by form
	public function add(){
		$data['title']		= 'Tambah '.$this->title;
		$data['state']		= 'add';
		$data['content']	= $this->content_folder.'form';
		$data['url']		= base_url_admin().'link/insert';

		$this->template($data);
	}

	// edit Page by form
	public function edit(){
		$id = $this->input->get('id');
		$data['title']		= 'Edit '.$this->title;
		$data['state']		= 'edit';
		$data['content']	= $this->content_folder.'form';
		$data['url']		= base_url_admin().'link/update';

		$data['datas'] 		= $this->link->get($id);
		$data['id'] 		= $id;

		$this->template($data);
	}

	public function insert(){
		$data = $this->input->post();

		$ret = array('success' => 'false');
		if($this->link->insert($data)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');

			$ret = array('success' => 'true');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
		}

		redirect($this->redirect_url);
	}

	public function update(){
		$this->db->trans_start();
		$data = $this->input->post();
		$id = $data['id'];
		unset($data['id']);

		if($this->link->update($id, $data)){
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
		if($this->link->delete($id)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di hapus.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menghapus data.');
		}
		redirect($this->redirect_url);
	}
	
	//public function print_data(){
		//$id = $this->input->get('id');
		//$data = array();
		//$this->sspd->select('sspd.*, sspd_detail.*');
		//$this->sspd->select('kab_sspd.nama_kabupaten as sspdKabupatenNama, kec_sspd.nama_kecamatan as sspdKecamatanNama, kel_sspd.nama_kelurahan as sspdKelurahanNama');

		//$this->sspd->select('kab_pbb.nama_kabupaten as pbbKabupatenNama, kec_pbb.nama_kecamatan as pbbKecamatanNama, kel_pbb.nama_kelurahan as pbbKelurahanNama');

		//$this->sspd->join('sspd_detail');
		//$this->sspd->join('ref_kabupaten kab_sspd');
		//$this->sspd->join('ref_kecamatan kec_sspd');
		//$this->sspd->join('ref_kelurahan kel_sspd');
		//$this->sspd->join('ref_kabupaten kab_pbb');
		//$this->sspd->join('ref_kecamatan kec_pbb');
		//$this->sspd->join('ref_kelurahan kel_pbb');
		//$data['sspd'] = $this->sspd->get_by(array('sspd.sspdId' => $id));
		//$data['do']	  = 'print';
		//$data['npoptkp'] = $this->npoptkp;

		//$this->load->view('template/moderna/cetak/sspd', $data);
	//}
	
	public function export_data(){}

	public function datatable(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$this->load->library('ssp');

		$table = 'link';
		$primaryKey = 'id';
		$columns = array(
			array(
				'db' => 'id',
				'dt' => 0,
				'field' => 'id',
				'formatter' => function($d, $row) {
					return ''; //blank, for numbering
				}
				),
			array(
				'db' => 'link_judul',
				'dt' => 1,
				'field' => 'link_judul',
				),
			array(
				'db' => 'link_alamat',
				'dt' => 2,
				'field' => 'link_alamat',
				),
			array(
				'db' => 'link_order',
				'dt' => 3,
				'field' => 'link_order',
				),
			array(
				'db' => 'id',
				'dt' => 4,
				'field' => 'id',
				'formatter' => function($d, $row) {
					$txt = button_access('edit', 'link', $d);
					$txt .= '&nbsp;';
					$txt .= button_access('delete', 'link', $d);
					return $txt;
				}
				)
			);

		$joinQuery  = 'FROM `link` ';
		//$joinQuery .= 'LEFT JOIN `ref_kecamatan` ON `sspd`.`sspdKecamatan` = `ref_kecamatan`.`kecCode` ';
		//$joinQuery .= 'LEFT JOIN `ref_kelurahan` ON `sspd`.`sspdKelurahan` = `ref_kelurahan`.`kelCode` ';

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
}
?>