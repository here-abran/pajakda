<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends Admin_Controller implements ControllerInterface{
	public function __construct(){
		parent::__construct();
		$this->load->model("Pengaturan_model", 'pengaturan');
		$this->title = 'Pengaturan';
		$this->redirect_url = base_url_admin().'pengaturan';
	}

	function index(){
		$data['title']		= 'Outlet';
		$data['content']	= 'content/pengaturan/index';
		$this->pengaturan->select('outlet.*');
		$this->pengaturan->order_by('outlet.id','DESC');
		$data['datas']		= array();//$this->user->get_all();

		$this->template($data);
	}
	
	function layanan(){
		$data['title']		= 'Layanan & Harga';
		$data['content']	= 'content/pengaturan/layanan';
		$this->pengaturan->select('layanan.*');
		$this->pengaturan->order_by('layanan.id','DESC');
		$data['datas']		= array();//$this->user->get_all();

		$this->template($data);
	}
	
	function tambah(){
		$data['title']		= $this->title;
		$data['content']	= 'content/pengaturan/tambah';
		$this->pengaturan->select('layanan.*');
		$this->pengaturan->order_by('layanan.id','DESC');
		$data['datas']		= array();//$this->user->get_all();

		$this->template($data);
	}
	

	// add Page by form
	function add(){
		$data['title']		= 'Add New '.$this->title;
		$data['state']		= 'add';
		$data['content']	= 'content/customer/form';
		
		$this->load->model('Customer_model', 'customer');
		$this->customer->order_by('id', 'DESC');
		$data['customer']		= $this->customer->get_all();

		$this->template($data);
	}

	// edit Page by form
	function edit(){
		$id = $this->input->get('id');
		$data['title']		= 'Edit '.$this->title;
		$data['state']		= 'edit';
		$data['content']	= 'content/customer/form';

		$this->db->select('customer.*');
		//$this->db->join('file', "user.id = file.field_value AND file.table_name = 'user' AND file.table_field = 'id'", 'LEFT');
		$data['datas'] 		= $this->customer->get_by(array('customer.id' => $id));
		$data['id'] 		= $id;
		
		$this->load->model('Customer_model', 'customer');
		$this->customer->order_by('id', 'DESC');
		$data['customer']		= $this->customer->get_all();

		$this->template($data);
	}

	function insert(){
		$this->db->trans_start();
		$data = $this->input->post();
		$data['password'] = genpass($data['password']);

		$data['id'] = generate_id('user');
		if($this->user->insert($data)){
			$file_upload = $this->_upload_foto($_FILES['userfile'], $data['id']);

			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
		}

		$this->db->trans_complete();

		redirect($this->redirect_url);
	}

	function update(){
		$this->db->trans_start();
		$id = $this->input->get('id');
		$data = $this->input->post();
		if($data['password'] != '') $data['password'] = genpass($data['password']);
		else unset($data['password']);

		$status = $this->user->update($id, $data);
		if($status !== false){
			$file_upload = $this->_upload_foto($_FILES['userfile'], $id);

			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di update.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal mengedit data.');
		}
		$this->db->trans_complete();

		redirect($this->redirect_url);
	}

	function delete(){
		$id = $this->input->get('id');
		if($this->user->delete($id)){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di hapus.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal menghapus data.');
		}
		redirect($this->redirect_url);
	}
	
	function print_data(){}

	function _upload_foto($file = array(), $field_value = ''){
		$file_id 		= generate_id('file');
		$table_name 	= 'user';
		$table_field 	= 'id';
		$user 			= $this->session->userdata('id');

		$this->load->model('File_model', 'file');
		return $this->file->upload_file($file, $file_id, $table_name, $table_field, $field_value, $user);
	}
	
	function export_data(){}

	function datatable(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$this->load->library('ssp');

		$table = 'user';
		$primaryKey = 'user`.`id';
		$columns = array(
			array(
				'db' => 'user.id',
				'dt' => 0,
				'field' => 'id',
				'formatter' => function($d, $row) {
					return ''; //blank, for numbering
				}
				),
			array(
				'db' => 'user.username',
				'dt' => 1,
				'field' => 'username',
				),
			array(
				'db' => 'user.name',
				'dt' => 2,
				'field' => 'name',
				'formatter' => function($d, $row) {
					// return '<div align="left">' . $d . '</div>';
					return $d;
				}
				),
			array(
				'db' => 'email',
				'dt' => 3,
				'field' => 'email',
				),
			array(
				'db' => 'group.name',
				'dt' => 4,
				'field' => 'group_name',
				),
			array(
				'db' => 'user.id',
				'dt' => 5,
				'field' => 'id',
				'formatter' => function($d, $row) {
					$txt = button_access('edit', 'user', $d);
					$txt .= button_access('delete', 'user', $d);
					return $txt;
				}
				)
			);

		$joinQuery  = 'FROM `user` ';
		$joinQuery .= 'LEFT JOIN `group` ON `user`.`group_id` = `group`.`id` ';

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
}
?>