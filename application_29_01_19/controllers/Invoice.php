<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends Admin_Controller implements ControllerInterface{
	public function __construct(){
		parent::__construct();
		// init variable
		$this->title 			= 'Invoice';
		$this->content_folder 	= 'content/transaksi/';
		$this->redirect_url 	= base_url_admin().'transaksi';

		// init model, helper, library
		$this->load->model("Transaksi_model", 'transaksi');
		$this->load->model("Transaksi_detail_model", 'transaksi_detail');
	}

	public function index(){
		
	}

	// add Page by form
	public function add(){}

	// edit Page by form
	public function edit(){
		$data['title']		= $this->title;
		$data['content']	= $this->content_folder.'invoice';
		$data['no_invoice']	= $this->input->get('no_invoice');

		$this->db->select('transaksi.*, customer.nama_customer');
		$this->transaksi->join('customer');
		$data['datas'] 		= $this->transaksi->get_by(array('no_invoice' => $data['no_invoice']));

		if(count($data['datas']) == 0){
			redirect($this->redirect_url);
		}else{
			$this->transaksi_detail->join('layanan');
			$data['detail'] 	= $this->transaksi_detail->get_many_by(array('transaksi_id' => $data['datas']['id']));

			$this->template($data);
		}
	}

	public function insert(){}

	public function update(){
		$post = $this->input->post();
		$data = array();
		$data['catatan'] = $post['catatan'];

		$transaksi = $this->transaksi->get_by(array('id' => $post['id']));

		if(count($transaksi) > 0){
			$data['dibayar'] = $transaksi['dibayar'] + $post['tambah_bayar'];

			$diskon = 0;
			if($transaksi['jenis_diskon'] == '%') $diskon = ($transaksi['diskon'] / 100) * $transaksi['total'];
			else if($transaksi['jenis_diskon'] == 'rp') $diskon = $transaksi['diskon'];

			$data['sisa'] 	= $data['dibayar'] - ($transaksi['total'] - $diskon);

			$data['status_pembayaran'] 	= 'belum lunas';
			if($data['sisa'] == 0){
				$data['status_pembayaran'] 	= 'lunas';
			}

			if($this->transaksi->update($post['id'], $data)){
				$this->session->set_flashdata('notif_status', true);
				$this->session->set_flashdata('notif_msg', 'Data berhasil di simpan.');
			}else{
				$this->session->set_flashdata('notif_status', false);
				$this->session->set_flashdata('notif_msg', 'Gagal menyimpan data.');
			}
		}
		redirect(base_url_admin().'invoice/edit?no_invoice='.$post['no_invoice']);
	}

	public function delete(){}
	
	public function print_data($no_invoice = ''){
		$data = array();
		$this->load->model('Setting_model', 'setting');
		$data['setting'] = $this->setting->extract_data();

		$this->db->select('transaksi.*, customer.nama_customer, customer.alamat, customer.no_hp');
		$this->transaksi->join('customer');
		$data['datas'] 		= $this->transaksi->get_by(array('no_invoice' => $no_invoice));

		$this->transaksi_detail->join('layanan');
		$data['detail'] 	= $this->transaksi_detail->get_many_by(array('transaksi_id' => $data['datas']['id']));

		$this->load->view($this->session->userdata('template_admin_use').'print', $data);
	}
	
	public function export_data(){}
}
?>