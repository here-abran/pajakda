<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends Admin_Controller implements ControllerInterface{

	public function __construct(){
		parent::__construct();
		$this->load->model('Group_model', 'group');
		$this->load->model("Menugroup_model", 'access');
		$this->load->model("Menu_model", 'menu');
		$this->redirect_url = base_url_admin().'group';
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Group';
		$data['content'] 	= 'content/group/index';
		$data['group'] 		= array();//$this->group->get_all();

		$this->template($data);
	}
	
	public function add(){
		$data = array();
		$data['title'] 		= 'Tambah Group';
		$data['content'] 	= 'content/group/form_input';
		$data['state'] 		= 'insert';

		$data['datas']		= $this->access->menugroup_structured();
		$data['menus']		= $this->menu->menu_structured();
		$data['access_name'] = $this->menu->access_name();
			
		$this->template($data);
	}
	
	public function edit(){
		if(isset($_GET['id'])){
			$data['title'] 		= 'Edit Group';
			$data['content'] 	= 'content/group/form_input';
			$data['group'] 		= $this->group->get($_GET['id']);
			$data['state'] 		= 'edit';
			
			$data['datas']		= $this->access->menugroup_structured($_GET['id']);
			$data['menus']		= $this->menu->menu_structured();
			$data['access_name'] = $this->menu->access_name();

			$this->template($data);
		}else{
			redirect($this->redirect_url);
		}
	}
	
	public function insert(){
		$datas = $this->input->post();
		$menu = $datas['menus'];
		unset($datas['menus']);
		$access = $this->menu->access_name();
		
		$this->db->trans_start(); //begin transaction
		
		$id_group = generate_id('group');
		$datas['id'] = $id_group;
		$this->group->insert($datas);
		
		foreach ($menu as $i => $v) {
			foreach ($access as $acc) {
				if(!isset($menu[$i][$acc])) $menu[$i][$acc] = 0;
			}
			$menu[$i]['group_id'] = $id_group;
			$menu[$i]['menu_id'] = $i;
		}
		
		$this->access->delete_by(array('group_id' => $id_group));
		$this->access->insert_batch($menu);
		
		
		$this->db->trans_complete(); // end transactions
		
		if($this->db->trans_status() === FALSE){
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
		}else{
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');
		}
		redirect(base_url_admin().'group');
	}
	
	
	public function update(){
		$datas = $this->input->post();
		$menu = $datas['menus'];
		unset($datas['menus']);
		$access = $this->menu->access_name();
		
		$this->db->trans_start();
		
		$this->group->update($datas['id'], $datas);
		foreach ($menu as $i => $v) {
			foreach ($access as $acc) {
				if(!isset($menu[$i][$acc])) $menu[$i][$acc] = 0;
			}
			$menu[$i]['group_id'] = $datas['id'];
			$menu[$i]['menu_id'] = $i;
		}
		
		$this->access->delete_by(array('group_id' => $datas['id']));
		$this->access->insert_batch($menu);
		
		$this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE){
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Gagal mengedit data.');
		}else{
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di update.');
		}
		redirect(base_url_admin().'group');
	}
	
	public function delete(){
		$id = $this->input->get('id');
		// var_dump($id);
		// exit;
		$this->db->trans_start();
		$this->access->delete_by(array('group_id' => $id));
		$this->group->delete($id);
		$this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE){
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Gagal menghapus data.');
		}else{
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di hapus.');
		}
		redirect(base_url_admin().'group');
	}
	
	public function print_data(){}
	function export_data(){}

	function datatable(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$this->load->library('ssp');

		$table = 'group';
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
				'db' => 'name',
				'dt' => 1,
				'field' => 'name',
				),
			array(
				'db' => 'id',
				'dt' => 2,
				'field' => 'id',
				'formatter' => function($d, $row) {
					$txt = button_access('edit', 'user', $d);
					$txt .= button_access('delete', 'user', $d);
					return $txt;
				}
				)
			);

		$joinQuery  = 'FROM `group` ';

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
