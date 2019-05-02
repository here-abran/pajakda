<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller implements ControllerInterface{
	public function __construct(){
		parent::__construct();
		$this->load->model("User_model", 'user');
		$this->title = 'User';
		$this->redirect_url = base_url_admin().'user';
	}

	function index(){
		$data['title']		= $this->title;
		$data['content']	= 'content/user/index';
		$this->user->select('user.*, group.name as group_name');
		$this->user->join('group');
		$this->user->order_by('user.id','DESC');
		$data['datas']		= array();//$this->user->get_all();

		$this->template($data);
	}

	// add Page by form
	function add(){
		$data['title']		= 'Add New '.$this->title;
		$data['state']		= 'add';
		$data['content']	= 'content/user/form';
		
		$this->load->model('Group_model', 'group');
		$this->group->order_by('id', 'DESC');
		$data['group']		= $this->group->get_all();

		$this->template($data);
	}

	// edit Page by form
	function edit(){
		$id = $this->input->get('id');
		$data['title']		= 'Edit '.$this->title;
		$data['state']		= 'edit';
		$data['content']	= 'content/user/form';

		$this->db->select('user.*, file.url');
		$this->db->join('file', "user.id = file.field_value AND file.table_name = 'user' AND file.table_field = 'id'", 'LEFT');
		$data['datas'] 		= $this->user->get_by(array('user.id' => $id));
		$data['id'] 		= $id;
		
		$this->load->model('Group_model', 'group');
		$this->group->order_by('id', 'DESC');
		$data['group']		= $this->group->get_all();

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

		//redirect($this->redirect_url);
		redirect('dashboard');
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