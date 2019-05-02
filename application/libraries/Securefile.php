<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Securefile class
 * Membantu upload dan ambil file dari posisi bukan public_html, dengan harapan penyimpanan file lebih secure
 *
 * @author 		Haniefhan
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @since		2015
 */

class Securefile {
	public $file_path_upload = '';

	public $allowed_file_type = '*';

	public function __construct(){
		$CI =& get_instance();
		//$CI->config->load('special_config');
		$this->file_path_upload = $CI->config->item('path_files'); // see in config/additional_config.php
	}

	/**
	 * [save_image description]
	 * @param  array  $file     $_FILE, info lengkap file yang diupload
	 * @param  string $filename filename to save
	 * @param  string $return   value : hanya path file,
	 * @return string           
	 */
	public function save_file($file = array(), $filename = '', $allowed_file_type = '*', $return = 'value'){
		// $filename = str_replace('/', '+', $filename);
		$filename = str_replace('/', '_', $filename);
		$year = date('Y');
		$month = date('m');
		$this->allowed_file_type = $allowed_file_type;

		if(!file_exists($this->file_path_upload.$year)) mkdir($this->file_path_upload.$year);
		if(!file_exists($this->file_path_upload.$year.'/'.$month)) mkdir($this->file_path_upload.$year.'/'.$month);

		$destination = $this->file_path_upload.$year.'/'.$month.'/'.$filename;

		if($allowed_file_type == "*" || $this->is_allowed($filename)){
			if(move_uploaded_file($file['tmp_name'], $destination)){
				if($return == 'value') return $year.'/'.$month.'/'.$filename;
			}else{
				if($return == 'value') return false;
			}
		}else{
			return false;
		}
	}

	public function is_allowed($filename = ''){
		if($this->allowed_file_type == '*'){
			return true;
		}else{
			return in_array($this->get_extension($filename), explode('|', $this->allowed_file_type));
		}
	}

	public function get_extension($filename = ''){
		$x = explode('.', $filename);

		if (count($x) === 1) return '';

		$ext = strtolower(end($x));
		return $ext;
	}

	public function get_image($filepath = ''){
		$path = $this->file_path_upload.$filepath;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		return $base64;
	}

	public function get_file($filepath = '', $encode = true, $common_path = false, $full = false){
		$path = $filepath;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		if($common_path == true){
			// file dengan penamaan lama
			$path = $this->file_path_upload.$filepath;

			// ambil file dengan penamaan baru (setelah tanggal 15 april 2016)
			if (!file_exists($path)) {
				$path = $this->file_path_upload.$filepath;
			}
		}

		$data = file_get_contents($path);
		if($type == 'txt') $type = 'text/plain';

		elseif($type == 'jpg') $type = 'image/jpeg';
		elseif($type == 'jpeg') $type = 'image/pjpeg';
		elseif($type == 'png') $type = 'image/png';
		elseif($type == 'gif') $type = 'image/gif';

		elseif($type == 'pdf') $type = 'application/pdf';
		elseif($type == 'sql') $type = 'application/octet-stream';
		elseif($type == 'zip') $type = 'application/zip';
		elseif($type == 'doc') $type = 'application/msword';
		elseif($type == 'docx') $type = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
		elseif($type == 'xls') $type = 'application/excel';
		elseif($type == 'xlsx') $type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		elseif($type == 'rtf') $type = 'application/rtf';
		
		if($encode == true){
			$base64 = 'data:' . $type . ';base64,' . base64_encode($data);
			return $base64;
		}else{
			if($full == true){
				$d = $data;
				$n = explode('/', $filepath);
				$data = array();
				$data['type'] = $type;
				$data['data'] = $d;
				$data['name'] = end($n);
			}
			return $data;
		}
	}

	public function get_file_list($filepath = '', $create_folder = true){
		$error = '';
		if(!file_exists($filepath) && $create_folder == true){
			if(!mkdir($filepath)){
				$error = 'tidak bisa membuat folder backup';
			}
		}

		$return = array();
		$return['error'] = $error;
		$return['data'] = array();
		if(file_exists($filepath)){
			$folder = @opendir($filepath);
			while($file = readdir($folder)){
				if($file != '.' && $file != '..') $return['data'][] = $file;
			}
		}

		return $return;
	}

	public function save_logging($path = '', $filename = '', $data = ''){

		if(!file_exists($path)) mkdir($path);

		$zip = new ZipArchive();
		$zip_file = $path.$filename.'.zip';

		if ($zip->open($zip_file, ZipArchive::CREATE)!==TRUE) {
		    return false;
		}

		$zip->addFromString($filename.".sql", $data);
		$zip->close();
		return true;
	}

	/**
	 * Hash file path in server, because 'common' naming format not permitted in server
	 * @author haniefhan <[hanief@isatechindonesia.com]>
	 * @param  string $filepath filepath in server
	 * @return string           hashed filepath in server
	 */
	/*private function _hash_filepath($filepath = ''){
		$f 			= explode('/', $filepath);
		$filename 	= end($f);
		array_pop($f);

		// get type file
		$type = pathinfo($filename, PATHINFO_EXTENSION);

		$filepath 	= '';
		foreach ($f as $i => $path) {
			$filepath .= $path.'/';
		}
		return $filepath.md5($filename).'.'.$type;
	}*/
}