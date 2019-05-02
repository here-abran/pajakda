<?php
class Group_model extends MY_Model {
	protected $_table 		= 'group';
	protected $primary_key = 'id';

	public $before_create = array('create_mark');
	public $before_update = array('update_mark');
	
	/*function get_all(){
		return $this->db->get('group')->result_array();
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get('group')->row();
	}
	
	function insert_group($arr){
		$this->db->set('name', $arr['nama_group']);
		$this->db->set('create_date', date("Y-m-d H:i:s"));
		$this->db->set('create_by', $this->session->userdata('id'));
		$this->db->insert('group');
		return $this->db->insert_id();
	}
	
	function update_group($arr){
		$this->db->set('name', $arr['nama_group']);
		$this->db->set('update_date', date("Y-m-d H:i:s"));
		$this->db->set('update_by', $this->session->userdata('id'));
		$this->db->where('id', $arr['group']);
		return $this->db->update('group');
	}
	
	function delete_group($id){
		$this->db->where('id', $id);
		return $this->db->delete('group');
	}*/
}
?>