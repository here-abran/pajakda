<?php
if ( ! function_exists('set_menu')){
	/* // old type
	function set_menu(){
		$CI = & get_instance();
		if($CI->session->userdata('menus')){
			return $CI->session->userdata('menus');
		}else{
			$res = $CI->db->get('menu')->result_array();
			
			$tree = array();
			$child = array();
			foreach ($res as $i => $v) {
				if($v['parent'] != 0){
					unset($v['create_date']);
					unset($v['create_by']);
					unset($v['update_date']);
					unset($v['update_by']);

					$child[$v['parent']][$v['order']] = $v;
					unset($res[$i]);
				}
			}

			foreach ($res as $i => $v) {
				unset($v['create_date']);
				unset($v['create_by']);
				unset($v['update_date']);
				unset($v['update_by']);
				
				$tree[(int)$v['order']] = $v;
				if(isset($child[$v['id']])){
					$tree[$v['order']]['children'] = $child[$v['id']];
				}
			}
			ksort($tree);
			
			$CI->session->set_userdata('menus', $tree);
		}
	}*/

	function set_menu($group_id = 0){
		$CI = & get_instance();
		if($CI->session->userdata('menus')){
			return $CI->session->userdata('menus');
		}else{
			$CI->db->select('id, name, url, icon, parent, order');
			$CI->db->select('view, add, edit, delete');
			$CI->db->join('menu', 'menugroup.menu_id = menu.id', 'LEFT');
			$CI->db->where('group_id', $group_id);
			$CI->db->where('menu.status', 1);
			$res = $CI->db->get('menugroup')->result_array();

			// $res = $CI->db->get('menu')->result_array();
			
			$tree = array();
			$child = array();
			$acc_grant = array();

			$admin_folder = '';

			foreach ($res as $i => $v) {
				if($v['parent'] != '0'){
					$child[$v['parent']][$v['order']] = $v;
					unset($res[$i]);

					if($v['view'] == 1){
						$acc_grant[] = $admin_folder.$v['url'].'/index';
						$acc_grant[] = $admin_folder.$v['url'].'/t_data';
						$acc_grant[] = $admin_folder.$v['url'].'/export_data';
						$acc_grant[] = $admin_folder.$v['url'];
					}

					if($v['add'] == 1){
						$acc_grant[] = $admin_folder.$v['url'].'/add';
						$acc_grant[] = $admin_folder.$v['url'].'/insert';
					}

					if($v['edit'] == 1){
						$acc_grant[] = $admin_folder.$v['url'].'/edit';
						$acc_grant[] = $admin_folder.$v['url'].'/update';
					}

					if($v['delete'] == 1){
						$acc_grant[] = $admin_folder.$v['url'].'/delete';
					}
				}
			}

			foreach ($res as $i => $v) {
				$tree[(int)$v['order']] = $v;
				if(isset($child[$v['id']])){
					$tree[$v['order']]['children'] = $child[$v['id']];
				}else{
					$in_arr = array();
					if($v['view'] == 1){
						$in_arr[] = 'view';
					}
					if($v['add'] == 1){
						$in_arr[] = 'add';
					}

					$chds = array();
					if(count($in_arr) > 0){
						$CI->db->where('parent', $v['id']);
						$CI->db->where_in('state', $in_arr);
						$chds = $CI->db->get('menu')->result_array();
					}

					if(count($chds > 0)){
						foreach ($chds as $chd) {
							$tree[$v['order']]['children'][] = $chd;
						}
					}
				}

				// set whitelist
				if($v['view'] == 1){
					$acc_grant[] = $admin_folder.$v['url'].'/index';
					$acc_grant[] = $admin_folder.$v['url'].'/print_data';
					$acc_grant[] = $admin_folder.$v['url'].'/export_data';
					$acc_grant[] = $admin_folder.$v['url'];
				}

				if($v['add'] == 1){
					$acc_grant[] = $admin_folder.$v['url'].'/add';
					$acc_grant[] = $admin_folder.$v['url'].'/insert';
				}

				if($v['edit'] == 1){
					$acc_grant[] = $admin_folder.$v['url'].'/edit';
					$acc_grant[] = $admin_folder.$v['url'].'/update';
				}

				if($v['delete'] == 1){
					$acc_grant[] = $admin_folder.$v['url'].'/delete';
				}

			}
			ksort($tree);
			
			$CI->session->set_userdata('menus', $tree);
			$CI->session->set_userdata('acc_grant', $acc_grant);
		}
	}
}

if ( ! function_exists('admin_template')){
	function parse_accessgrant($url = ''){
		if(strpos($url, '?') != false){
			$u = explode('?', $url);
			$url = $u[0];
		}
		return $url;
	}
}

if ( ! function_exists('admin_template')){
	function admin_template(){
		$CI = & get_instance();
		// $CI->session->sess_destroy();
		if(!$CI->session->userdata('template_admin')){
			// get from database
			$CI->load->model('Setting_model', 'setting');
			$temp = $CI->setting->get_by(array('name' => 'template_admin'));
			$ver = $CI->setting->get_by(array('name' => 'app_version'));
			$login = $CI->setting->get_by(array('name' => 'first_login'));

			$CI->load->model('Template_model', 'template');
			$template = $CI->template->get_by(array('name' => $temp['value']));

			$CI->session->set_userdata('template_admin', $template['url'].'index');
			$CI->session->set_userdata('template_login', $template['url'].'login');
			$CI->session->set_userdata('template_admin_use', $template['url']);
			$CI->session->set_userdata('login_attempt', 0);
			$CI->session->set_userdata('app_version', $ver['value']);
			$CI->session->set_userdata('first_login', $login['value']);
			// $CI->session->set_userdata('title', 'Sintesa Admin |');
		}
	}
}

if ( ! function_exists('login_check')){
	function login_check($redirect = false){
		$CI = & get_instance();
		if($CI->session->userdata('user_login') === true){
			return true;
		}else{
			if($redirect == true){
				redirect(base_url().'index.php');
			}
			return false;
		}
	}
}

if ( ! function_exists('button_access')){
	function button_access($state = '', $uri_string = '', $id = '0', $report_type = NULL){
		$CI = & get_instance();

		// check if have /index in the last, remove it
		// ex : admin/post/index
		if(strpos($uri_string, '/index')){
			$uri_string = str_replace('/index', '', $uri_string);
		}
		
		if(in_array($uri_string.'/'.$state, $CI->session->userdata('acc_grant'))){
			if($state == 'add')
				return '<a class="btn btn-primary btn-sm" href="'.base_url().'index.php/'.$uri_string.'/add" data-toggle="tooltip" data-placement="bottom" title="Tambah data"><i class="glyphicon glyphicon-plus"></i> Tambah Baru</a>';
			elseif($state == 'edit')
				return '<a class="btn btn-primary btn-xs" href="'.base_url().'index.php/'.$uri_string.'/edit?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit data"><i class="fa fa-pencil-square-o"></i></a>';
			elseif($state == 'delete')
				if($id == '0' OR empty($id)){
					return '<button class="btn btn-default btn-xs delete" href="#" data-toggle="tooltip" data-placement="bottom" title="Hapus data" disabled="disabled"><i class="fa fa-trash"></i></button>';
				}else{
					return '<a class="btn btn-danger btn-xs delete" href="'.base_url().'index.php/'.$uri_string.'/delete?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Hapus data"><i class="fa fa-trash"></i></a>';
				}
				
			elseif($state == 'print_data' )
				return '<a class="btn btn-default" href="'.base_url().'index.php/'.$uri_string.'/print_data?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Print data" target="_blank"><i class="fa fa-print"></i></a>';
			elseif($state == 'export_data' ){
				if($report_type == 'excel'){
					$btn_class = 'btn-success';
					$icon = 'fa-file-excel-o';
				}elseif($report_type == 'pdf'){
					$btn_class = 'btn-danger';
					$icon = 'fa-file-pdf-o';
				}else{
					$btn_class = 'btn-default';
					$icon = 'fa-file-text-o';
				}
				return '<a class="btn btn-export '.$btn_class.'" href="'.base_url().'index.php/'.$uri_string.'/export_data?to='.$report_type.'" data-toggle="tooltip" data-placement="bottom" title="Export data"><i class="fa '.$icon.'"></i></a>';
			}
				
		}

		return '';
	}
}

if ( ! function_exists('money_format_ext')){
	function money_format_ext($value = 0, $symbol = 'Rp. '){
		return $symbol.number_format($value);
	}
}