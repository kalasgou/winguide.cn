<?php

function checkParameters($data) {
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

/* End of file */