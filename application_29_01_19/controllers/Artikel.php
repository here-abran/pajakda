<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends Public_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if($this->input->get('title')){
			$data = array();
			$data['title'] 		= 'Artikel';
			$data['content'] 	= 'artikel';

			$data['title'] = $this->input->get('title');
			$this->load->model('Berita_model', 'berita');
			$this->berita->select('berita_judul, berita_detail, berita_url, berita_image, berita_full, berita.create_date, user.name');
			$this->berita->join('user');
			$data['berita'] = $this->berita->get_by(array('berita_slug' => $data['title']));
			
			$this->berita->select('berita_judul, berita_detail, berita_url, berita_image, berita_preview');
			$this->berita->order_by('create_date', 'DESC');
			$this->berita->limit(5);
			$data['another_berita'] = $this->berita->get_all();

			$this->template($data);
		}else{
			redirect(base_url());
		}
	}
}
