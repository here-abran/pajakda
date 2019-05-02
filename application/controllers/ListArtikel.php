<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListArtikel extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Berita_model', 'berita');
    }

    public function index($start_index = 0)
    {
        $data            = array();
        $data['title']   = 'Artikel';
        $data['content'] = 'list_artikel';

        $this->berita->select('berita_judul, berita_detail, berita_url, berita_image, berita_preview');
        $this->berita->order_by('create_date', 'DESC');
        $this->berita->limit(5);
        $data['another_berita'] = $this->berita->get_all();

        // init params
        $limit_per_page = 2;
        // $start_index    = $index;
        $total_records = $this->berita->get_total();

        if ($total_records > 0) {
            // get current page records
            $data["results"] = $this->berita->get_current_page_records($limit_per_page, $start_index);

            $config['base_url']    = base_url() . 'index.php/listArtikel/index';
            $config['total_rows']  = $total_records;
            $config['per_page']    = $limit_per_page;
            $config["uri_segment"] = 3;

            // Membuat Style pagination untuk BootStrap
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';

            $this->pagination->initialize($config);

            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        // echo "<pre>";
        // print_r($data);

        $this->template($data);
    }
}
