<?php
class File_model extends MY_Model {
	protected $_table 		= 'file';
	protected $_primary_key = 'id';

	public $_allowed_file_type = 'jpeg|jpg|png|gif|txt|doc|docx|xls|xlsx|rtf|pdf'; //defaule allowed filetype

	public function upload_file($file = array(), $file_id = '', $table_name = '', $table_field = '', $field_value = '', $user = ''){
		$file_path = '';
		if($file['name'] != ''){
			$allowed_file_type = $this->_allowed_file_type;
			
			$e = explode('.', $file['name']);
			$ext = end($e);
			
			$file_name = $file_id.'.'.$ext;//$file['name'];

			$file_path = $this->securefile->save_file($file, $file_name, $allowed_file_type);

			if($file_path){
				$this->insert(array(
					'id' => $file_id,
					'table_name' => $table_name,
					'table_field' => $table_field,
					'field_value' => $field_value,
					'file_name' => $file['name'],
					'url' => $file_path,
					'input_by' => $user,
					'input_date' => date('Y-m-d H:i:s'),
					));
			}
		}

		return $file_path;
	}
}
?>