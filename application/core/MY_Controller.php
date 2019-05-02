<?php

class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
}

interface ControllerInterface{
	public function index();
	public function add();
	public function edit();
	public function insert();
	public function update();
	public function delete();
	public function print_data();
	public function export_data();
}

class Admin_Controller extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('general');
		$this->load->helper('admin');
		login_check(true);

		// if(!in_array(uri_string(), $this->session->userdata('acc_grant'))){
		// 	// access not granted
		// 	$this->session->set_flashdata('notif_status', false);
		// 	$this->session->set_flashdata('notif_msg', "You don't have permission to access the menu");
		// 	redirect(base_url_admin().'dashboard');
		// }
	}

	public function template($data = array()){
		$data['content'] 	= $this->session->userdata('template_admin_use').$data['content'];
		$this->load->view($this->session->userdata('template_admin'), $data);
	}
}

class Public_Controller extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('general');
		$this->load->helper('public');
		$this->load->model('Widget_model', 'widget');
		$this->load->model('Link_model', 'link');
		public_template();
	}

	public function template($data = array()){
		$this->widget->order_by('widType, widOrder', 'ASC');
		$data['widget'] 	= $this->widget->get_all();
		$data['content'] 	= $this->session->userdata('template_use').$data['content'];
		$this->link->order_by('link_order', 'ASC');
		$data['link'] 	= $this->link->get_all();
		$this->load->view($this->session->userdata('template'), $data);
	}
}
?>