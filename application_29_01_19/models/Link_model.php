<?php
class Link_model extends MY_Model {
	protected $_table 		= 'link';
	protected $primary_key = 'link_id';

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
}
?>