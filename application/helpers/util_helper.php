<?php

function check_parameters($data) {
	if (!$data) return FALSE;
	foreach ($data as $val) {
		if (is_array($val)) { 
			if (checkParameters($val)) {
				continue;
			} else {
				return FALSE;
			}
		} else if ($val === '' || $val === NULL) {
			return FALSE;
		}
	}
	return TRUE;
}

function hex16to64($m, $len = 0) {
	$code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
	$hex2 = array();
	for($i = 0, $j = strlen($m); $i < $j; ++$i) {
		$hex2[] = str_pad(base_convert($m[$i], 16, 2), 4, '0', STR_PAD_LEFT);
	}
	$hex2 = implode('', $hex2);
	$hex2 = str_rsplit($hex2, 6);
	foreach($hex2 as $one) {
		$hex64[] = $code[bindec($one)];
	}
	$short = preg_replace('/^0*/', '', implode('', $hex64));
	if($len) {
		$clen = strlen($short);
		if($clen >= $len) {
			return $short;
		}
		else {
			return str_pad($short, $len, '0', STR_PAD_LEFT);
		}
	}
	return $short;
}

function str_rsplit($str, $len = 1) {
	if($str == null || $str == false || $str == '') return false;
	$strlen = strlen($str);
	if($strlen <= $len) return array($str);
	$headlen = $strlen % $len;
	if($headlen == 0) {
		return str_split($str, $len);
	}
	$tmp = array(substr($str, 0, $headlen));
	return array_merge($tmp, str_split(substr($str, $headlen), $len));
}

function uuid() {  
	$chars  = md5(uniqid(mt_rand(), true));  
	$uuid   =  substr($chars ,0,8);
	$uuid  .=  substr($chars ,8,4);
	$uuid  .=  substr($chars ,12,4); 
	return $uuid;  
}

function gen_random_password($pswd_len) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	
	$password = '';
	for ($i = 0; $i < $pswd_len; $i++) {
		$password .= $chars[mt_rand(0, 61)];
	}
	
	return $password;
}

function gen_student_serial($student_id) {
	$student_id -= 1;
	$range = '0123456789abcdefghijklmnopqrstuvwxyz';
	$serial = '000000_wg';
	for ($i = 5; $i >= 0; $i --) {
		$left = $student_id % 36;
		$serial[$i] = strval($range[$left]);
		$student_id = intval($student_id / 36);
		if ($student_id === 0) break;
	}
	return $serial;
}

function gen_pagination($base_url, $uri_segment, $total_rows, $per_page = 15, $num_links = 5) {
	$CI = & get_instance();
	
	$CI->load->library('pagination');
	$config = array();
	$config['base_url'] = $base_url;
	$config['uri_segment'] = $uri_segment;
	$config['total_rows'] = $total_rows;
	$config['num_links'] = $num_links;
	$config['per_page'] = $per_page;
	$config['use_page_numbers'] = TRUE;
	
	if (count($_GET) > 0) {
		$config['suffix'] = '?'.http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'/1?'.http_build_query($_GET, '', "&");
	} else {
		$config['first_url'] = $config['base_url'].'/1';
	}
	
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['first_link'] = '<span class="glyphicon glyphicon-backward"></span>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['last_link'] = '<span class="glyphicon glyphicon-forward"></span>';

	$CI->pagination->initialize($config);
	return $CI->pagination->create_links();
}

/* End of file */