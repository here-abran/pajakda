<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget extends Admin_Controller implements ControllerInterface{

	public function __construct(){
		parent::__construct();
		$this->load->model('Widget_model', 'widget');
		$this->redirect_url = base_url_admin().'widget';
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Widget';
		$data['content'] 	= 'content/widget/index';
		$data['datatable_url']	= base_url_admin().'/widget/datatable';

		$this->template($data);
	}
	
	public function add(){
		$data = array();
		$data['title'] 		= 'Tambah Widget';
		$data['content'] 	= 'content/widget/form';
		$data['state'] 		= 'insert';
		$data['url']		= base_url_admin().'widget/insert';

		$data['datas'] 		= array();
		$data['list_widgetType'] = $this->widget->list_widgetType();
		$data['list_widgetIconType'] = $this->widget->list_widgetIconType();
			
		$this->template($data);
	}
	
	public function edit(){
		if(isset($_GET['id'])){
			$data['title'] 		= 'Edit widget';
			$data['content'] 	= 'content/widget/form';
			$data['state'] 		= 'edit';
			$data['url']		= base_url_admin().'widget/update';

			$data['datas'] 		= $this->widget->get($_GET['id']);
			$data['list_widgetType'] = $this->widget->list_widgetType();
			$data['list_widgetIconType'] = $this->widget->list_widgetIconType();

			$this->template($data);
		}else{
			redirect($this->redirect_url);
		}
	}
	
	public function insert(){
		$datas = $this->input->post();
		
		if($this->widget->insert($datas)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
			
		}
		redirect($this->redirect_url);
	}
	
	
	public function update(){
		$datas = $this->input->post();
		if($this->widget->update($datas['widId'], $datas)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di update.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Gagal mengedit data.');
		}
		redirect($this->redirect_url);
	}
	
	public function delete(){
		$id = $this->input->get('id');
		
		if($this->widget->delete($id)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di hapus.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Gagal menghapus data.');
		}
		redirect(base_url_admin().'widget');
	}
	
	public function print_data(){}
	function export_data(){}

	function datatable(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$this->load->library('ssp');

		$table = 'widget';
		$primaryKey = 'widId';
		$columns = array(
			array(
				'db' => 'widId',
				'dt' => 0,
				'field' => 'widId',
				'formatter' => function($d, $row) {
					return ''; //blank, for numbering
				}
				),
			array(
				'db' => 'widTitle',
				'dt' => 1,
				'field' => 'widTitle',
				),
			array(
				'db' => 'widType',
				'dt' => 2,
				'field' => 'widType',
				),
			array(
				'db' => 'widIconType',
				'dt' => 3,
				'field' => 'widIconType',
				),
			array(
				'db' => 'widIconValue',
				'dt' => 4,
				'field' => 'widIconValue',
				),
			array(
				'db' => 'widDesc',
				'dt' => 5,
				'field' => 'widDesc',
				),
			array(
				'db' => 'widUrl',
				'dt' => 6,
				'field' => 'widUrl',
				),
			array(
				'db' => 'widOrder',
				'dt' => 7,
				'field' => 'widOrder',
				),
			array(
				'db' => 'widId',
				'dt' => 8,
				'field' => 'widId',
				'formatter' => function($d, $row) {
					$txt = button_access('edit', 'widget', $d);
					$txt .= button_access('delete', 'widget', $d);
					return $txt;
				}
				)
			);

		$joinQuery  = 'FROM `widget` ';

		$extraWhere = '';
		//$extraWhere = ' t1.isactive = 1';
		$sql_details = array(
			'user' => $this->db->username,
			'pass' => $this->db->password,
			'db' => $this->db->database,
			'host' => $this->db->hostname
		);

		echo @json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $widgetBy = ''));
	}
}
