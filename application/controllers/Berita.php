<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends Admin_Controller{
	public function __construct(){
		parent::__construct();

		// init variable
		$this->title 			= 'Berita';
		$this->content_folder 	= 'content/berita/';
		$this->redirect_url 	= base_url_admin().'berita';

		// init model, helper, library 
		$this->load->model("Berita_model", 'berita');

		$this->upload_path = getcwd().'/upload';
	}

	public function index(){
		$data['title']		= $this->title;
		$data['content']	= $this->content_folder.'index';
		$data['datatable_url']	= base_url().$this->config->item('index_page').'/berita/datatable';

		$this->template($data);
	}

	// add Page by form
	public function add(){
		$data['title']		= 'Tambah '.$this->title;
		$data['state']		= 'add';
		$data['content']	= $this->content_folder.'form';
		$data['url']		= base_url_admin().'berita/insert';
		$data['datas']		= array();

		$this->template($data);
	}

	// edit Page by form
	public function edit(){
		$id = $this->input->get('id');
		$data['title']		= 'Edit '.$this->title;
		$data['state']		= 'edit';
		$data['content']	= $this->content_folder.'form';
		$data['url']		= base_url_admin().'berita/update';

		$data['datas'] 		= $this->berita->get($id);
		$data['id'] 		= $id;

		$this->template($data);
	}

	public function insert(){
		$data = $this->input->post();
		$file = $_FILES['berita_image'];
		$file_name = trim(str_replace(' ', '-', strtolower($data['berita_judul'])));

		if($file['name'] != ''){
			$e = explode('.', $file['name']);
			$ext = end($e);

			$file_name_image = $file_name.'.'.$ext;
			$data['berita_image'] = $this->securefile->save_file($file, $file_name_image, 'jpeg|jpg|png|gif');
		}

		$data['berita_slug'] = $file_name;
		if($data['berita_url'] == '') $data['berita_url'] = base_url().'index.php/artikel?title='.$data['berita_slug'];

		if($this->berita->insert($data)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
		}

		redirect($this->redirect_url);
	}

	public function update(){
		$data = $this->input->post();
		$id = $data['berita_id'];
		$file = $_FILES['berita_image'];
		$file_name = trim(str_replace(' ', '-', strtolower($data['berita_judul'])));

		if($file['name'] != ''){
			$e = explode('.', $file['name']);
			$ext = end($e);

			$file_name_image = $file_name.'.'.$ext;
			$data['berita_image'] = $this->securefile->save_file($file, $file_name_image, 'jpeg|jpg|png|gif');
		}

		$data['berita_slug'] = $file_name;
		if($data['berita_url'] == '') $data['berita_url'] = base_url().'index.php/artikel?title='.$data['berita_slug'];

		if($this->berita->update($id, $data)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di update.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal mengedit data.');
		}

		redirect($this->redirect_url);
	}

	public function delete(){
		$id = $this->input->get('berita_id');
		if($this->sspd->delete($id)){
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

		$table = 'berita';
		$primaryKey = 'berita_id';
		$columns = array(
			array(
				'db' => 'berita_id',
				'dt' => 0,
				'field' => 'berita_id',
				'formatter' => function($d, $row) {
					return ''; //blank, for numbering
				}
				),
			array(
				'db' => 'berita_judul',
				'dt' => 1,
				'field' => 'berita_judul',
				),
			array(
				'db' => 'berita_url',
				'dt' => 2,
				'field' => 'berita_url',
				),
			array(
				'db' => 'berita_detail',
				'dt' => 3,
				'field' => 'berita_detail',
				'formatter' => function($d, $row) {
					if(strpos($d, 'iframe') !== false){
						$txt = str_replace("<", "&lt;", $d);
						$txt = str_replace(">", "&gt;", $txt);
						return $txt;
					}else{
						return $d;
					}
				}
				),
			array(
				'db' => 'featured',
				'dt' => 4,
				'field' => 'featured',
				),
			array(
				'db' => 'berita_full',
				'dt' => 5,
				'field' => 'berita_full',
				),
			
			array(
				'db' => 'berita_id',
				'dt' => 6,
				'field' => 'berita_id',
				'formatter' => function($d, $row) {
					//$txt = button_access('print_data', 'sspd', $d);
					$txt .= button_access('edit', 'berita', $d);
					$txt .= '&nbsp;';
					$txt .= button_access('delete', 'berita', $d);
					return $txt;
				}
				)
			);

		$joinQuery  = 'FROM `berita` ';
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