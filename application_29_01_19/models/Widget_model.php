<?php
class Widget_model extends MY_Model {
	protected $_table 		= 'widget';
	protected $primary_key 	= 'widId';

	public function list_widgetIconType(){
		return array(
			'fa' => 'Font Awesome',
			'img' => 'Image Url',
		);
	}

	public function list_widgetType(){
		return array(
			'online' => 'Layanan Online',
			'info' => 'Info Pajak Daerah',
		);
	}
}
?>