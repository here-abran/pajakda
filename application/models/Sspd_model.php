<?php
class Sspd_model extends MY_Model {
	protected $_table 		= 'sspd';
	protected $_primary_key = 'sspdId';

	public $belongs_to = array(
		'ref_kabupaten kab_sspd' => array('from_column' => 'sspdKabupaten', 'to_column' => 'kabCode'),
		'ref_kecamatan kec_sspd' => array('from_column' => 'sspdKecamatan', 'to_column' => 'kecCode'),
		'ref_kelurahan kel_sspd' => array('from_column' => 'sspdKelurahan', 'to_column' => 'kelCode'),
		'ref_kabupaten kab_pbb' => array('table' => 'sspd_detail', 'from_column' => 'kabupatenPBB', 'to_column' => 'kabCode'),
		'ref_kecamatan kec_pbb' => array('table' => 'sspd_detail', 'from_column' => 'kecamatanPBB', 'to_column' => 'kecCode'),
		'ref_kelurahan kel_pbb' => array('table' => 'sspd_detail', 'from_column' => 'kelurahanPBB', 'to_column' => 'kelCode'),
		'sspd_detail' => array('from_column' => 'sspdId', 'to_column' => 'sspdID'),
	);

	public function generateFormNo($year = 0, $month = 0){
		$no = 1;
		$this->order_by('sspdId', 'DESC');
		$this->limit(1);
		$data = $this->get_many_like(array('sspdFormNo' => $year.'.'.$month));
		// var_dump($data);
		if(count($data) > 0) {
			$no = (int)substr($data[0]['sspdFormNo'], -4);
			$no++;
		}
		$formNo = date('Y.m').'.'.str_pad($no, 4, '0', STR_PAD_LEFT);
		return $formNo;
	}
}
?>