<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller implements ControllerInterface{
	public function __construct(){
		parent::__construct();
		// init variable
		$this->title 			= 'Profile';
		$this->content_folder 	= 'content/profile/';
		$this->redirect_url 	= base_url_admin().'profile';

		// init model, helper, library
		$this->load->model("User_model", 'user');
	}

	public function index(){
		$data['title']		= $this->title;
		$data['content']	= $this->content_folder.'index';

		$data['url']		= base_url_admin().'profile/update';
		$data['datas'] 		= $this->user->get($this->session->userdata('id'));

		$this->template($data);
	}

	// add Page by form
	public function add(){}

	// edit Page by form
	public function edit(){}

	public function insert(){}

	public function update(){
		$this->db->trans_start();
		$id = $this->session->userdata('id');
		$data = $this->input->post();
		if($data['password'] != '') $data['password'] = genpass($data['password']);
		else unset($data['password']);

		$status = $this->user->update($id, $data);
		if($status !== false){
			$this->session->set_flashdata('notif_status', true);
			$this->session->set_flashdata('notif_msg', 'Data berhasil di update.');
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'Gagal mengedit data.');
		}
		$this->db->trans_complete();

		redirect($this->redirect_url);
	}

	public function delete(){}
	
	public function print_data(){}
	
	public function export_data(){}
}
?>