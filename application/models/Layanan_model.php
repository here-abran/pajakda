<?php
class Layanan_model extends MY_Model {
	protected $_table 		= 'layanan';
	protected $primary_key = 'id';

	public function restructured_format(){
		$return = array();

		foreach ($this->get_all() as $i => $v) {
			$return[$v['id']] = $v;
		}

		return $return;
	}
}
?>