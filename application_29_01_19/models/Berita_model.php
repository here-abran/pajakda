<?php
class Berita_model extends MY_Model {
	protected $_table 		= 'berita';
	protected $primary_key = 'berita_id';

	public $belongs_to = array(
		'user' => array('from_column' => 'create_by', 'to_column' => 'id'),
	);

	protected $before_create = array('create_mark');
	protected $before_update = array('update_mark');

	protected function create_mark($row){
		$this->_user_id = $this->session->userdata('id');
		if (is_object($row))
		{
			$row->create_date =  date('Y-m-d H:i:s');
			$row->create_by   =  $this->_user_id;
		}
		else
		{
			$row['create_date'] =  date('Y-m-d H:i:s');
			$row['create_by']   =  $this->_user_id;
		}
		return $row;
	}

	protected function update_mark($row){
		$this->_user_id = $this->session->userdata('id');
		if (is_object($row))
		{
			$row->update_date =  date('Y-m-d H:i:s');
			$row->update_by   =  $this->_user_id;
		}
		else
		{
			$row['update_date'] =  date('Y-m-d H:i:s');
			$row['update_by']   =  $this->_user_id;
		}
		
		return $row;
	}

	public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('create_date', 'DESC');
        $query = $this->db->get($this->_table);
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
     
    public function get_total() 
    {
        return $this->db->count_all($this->_table);
    }
} 
?>