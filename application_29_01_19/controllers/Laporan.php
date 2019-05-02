<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Public_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Laporan';
		$data['content'] 	= 'laporan';

		$this->template($data);
	}
}