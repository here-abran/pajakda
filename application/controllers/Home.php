<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller{

	public function __construct(){
		parent::__construct();
		// $this->load->model('Widget_model', 'widget');
		$this->load->model('Berita_model', 'berita');
		// $this->load->model('Link_model', 'link');
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Home';
		$data['content'] 	= 'home';
		$data['js_file'] 	= 'home';
		// $this->widget->order_by('widType, widOrder', 'ASC');
		// $data['widget'] 	= $this->widget->get_all();

		$this->berita->order_by('create_date', 'DESC');
		$data['beritas'] 	= $this->berita->get_many_by(array('featured' => 1));

		// $this->link->order_by('link_order', 'ASC');
		// $data['link'] 	= $this->link->get_all();

		// echo $this->session->userdata('template');
		$this->template($data);
	}

	public function destroy_session(){
		$this->session->sess_destroy();
	}
}
