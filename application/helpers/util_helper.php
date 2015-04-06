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

/* End of file */