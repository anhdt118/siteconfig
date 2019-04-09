<?php

function format_date_time($str) {
	$segments = explode(',', $str);
	$date_parts = explode('/', trim($segments[0]));
	return strtotime($date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0] . ' ' . $segments[1]);
}

function render_to_alias($str)
{
	$str = str_replace(array('à', 'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ậ', 'ẳ', 'ẵ', 'á', 'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ'), 'a', $str);
	$str = str_replace(array('è', 'é', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', 'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ'), 'e', $str);
	$str = str_replace(array('ì', 'í', 'í', 'ị', 'ỉ', 'ĩ', 'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ'), 'i', $str);
	$str = str_replace(array('ò', 'ò', 'ó', 'ó', 'ọ', 'ọ', 'ỏ', 'ờ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', 'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ'), 'o', $str);
	$str = str_replace(array('ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ư', 'ữ', 'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', 'ứ'), 'u', $str);
	$str = str_replace(array('ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', 'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ'), 'y', $str);
	$str = str_replace(array('đ', 'Đ'), 'd', $str);
	$str = str_replace(array("'", '"', '®', '--', '...', '“', '”', '‘', '(', '"', ')', '&', '!', '?', ':', '.', '…', '[', ']', '+', '*', '@', '^', '#', '$', '=', '~', '`', '’', '♥'), '-', $str);
	$str = str_replace('%', '-phan-tram-', trim($str));
	$str = str_replace(array('----', '---', '--', '- ', ' -', '/', ',', '  ', ' ', ';', ','), '-', $str);
	if ($str[0] == '-') {
		$str = substr($str, 1);
	}
	$str_len = strlen($str);
	if ($str[$str_len - 1] == '-') {
		$str = substr($str, 0, ($str_len - 1));
	}
	return url_title(strtolower($str));
}

function render_file_name($str)
{
	$str = str_replace(array('à', 'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ậ', 'ẳ', 'ẵ', 'á', 'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ'), 'a', $str);
	$str = str_replace(array('è', 'é', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', 'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ'), 'e', $str);
	$str = str_replace(array('ì', 'í', 'í', 'ị', 'ỉ', 'ĩ', 'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ'), 'i', $str);
	$str = str_replace(array('ò', 'ò', 'ó', 'ó', 'ọ', 'ọ', 'ỏ', 'ờ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', 'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ'), 'o', $str);
	$str = str_replace(array('ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ư', 'ữ', 'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', 'ứ'), 'u', $str);
	$str = str_replace(array('ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', 'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ'), 'y', $str);
	$str = str_replace(array('đ', 'Đ'), 'd', $str);
	$str = str_replace(array("'", '"', '®', '--', '...', '“', '”', '‘', '(', '"', ')', '&', '!', '?', ':', '…', '[', ']', '+', '*', '@', '^', '#', '$', '=', '~', '`', '’', '♥'), '-', $str);
	$str = str_replace('%', '-phan-tram-', trim($str));
	$str = str_replace(array('----', '---', '--', '- ', ' -', '/', ',', '  ', ' ', ';', ','), '-', $str);
	return strtolower($str);
}

function render_src($file)
{
	return str_replace('./', base_url(), $file);
}

function sort_by_field($item1, $item2)
{
	$a = get_field($item1, 'sort_order');
	$b = get_field($item2, 'sort_order');
	if ($a == $b) {
		return 0;
	}
	return ($a < $b) ? -1 : 1;
}

function render_url($url)
{
	if ($url[strlen($url) - 1] != '/') {
		$url .= '/';
	}
	$url = str_replace(array('®', '--', '...', '“', '”', '‘', '&', '!', '?', '[', ']', '@', '^', '#', '$', '~', '`', '’', '♥'), '', $url);
	return $url;
}

function get_field($item, $field, $default = null)
{
	if (is_object($item) && isset($item->$field)) {
		return $item->$field;
	}
	if (is_array($item) && isset($item[$field])) {
		return $item[$field];
	}
	if (isset($default)) {
		return $default;
	}
	return null;
}

function get_filter($item, $path, $default = null)
{
	if (!empty($item->$path)) {
		return $item->$path;
	}
	if (!empty($item[$path])) {
		return $item[$path];
	}
	$segments = explode('/', $path);
	$key = array_shift($segments);
	$path = implode('/', $segments);
	if (!empty($item[$key])) {
		return get_filter($item[$key], $path, $default);
	}
	if (!empty($item->$key)) {
		return get_filter($item->$key, $path, $default);
	}
	if (isset($default)) {
		return $default;
	}
	return null;
}

function render_paginate($current_page, $record_per_page, $count_results, $page_range)
{
	$pag = array();
	if ($current_page <= 1) {
		$current_page = 1;
	}
	$pag['start'] = ($current_page - 1) * $record_per_page;
	if ($pag['start'] < 0) {
		$pag['start'] = 0;
	}
	$count_pages = ceil($count_results / $record_per_page);
	$pag['total'] = $count_pages;
	$delta = ceil($page_range / 2);
	if ($current_page - $delta > $count_pages - $page_range) {
		$pag['lower'] = $count_pages - $page_range;
		$pag['upper'] = $count_pages;
	} else {
		if ($current_page - $delta < 0) {
			$delta = $current_page;
		}
		$offset = $current_page - $delta;
		$pag['lower'] = $offset + 1;
		$pag['upper'] = $offset + $page_range;
	}
	if ($pag['lower'] <= 1) {
		$pag['lower'] = 1;
	}
	if ($pag['upper'] >= $count_pages) {
		$pag['upper'] = $count_pages;
	}
	if ($pag['upper'] <= 1) {
		$pag['upper'] = 1;
	}
	return $pag;
}

function render_sorter($sorter, $field)
{
	if (get_field($sorter, 'name') == $field) {
		return '<span class="fa ' . ((get_field($sorter, 'value') == 'ASC') ? 'fa-angle-up' : 'fa-angle-down') . '"></span>';
	}
	return null;
}

function analyze_filters($filters)
{
	$conditions = array();
	foreach ($filters as $key => $field) {
		if (count($field) < 2 || !isset($field['value']) || empty($field['value'])) {
			continue;
		}
		if (!is_array($field['value'])) {
			$value = trim($field['value']);
			if (isset($field['exclude']) && $value == $field['exclude']) {
				continue;
			}
		} else {
			$value = array_unique($field['value']);
		}
		switch ($field['type']) {
			case 'equal':
				if (is_numeric($value)) {
					$conditions[$key] = (int)$value;
				} else {
					$conditions[$key] = $value;
				}
				break;
			case 'text':
				$conditions[$key] = array('$regex' => $value . ".*");
				break;
			case 'in':
				$conditions[$key] = array('$in' => $value);
				break;
			default:
				break;
		}
	}
	if (count($conditions) == 0) {
		$conditions = array();
	}
	return $conditions;
}

function no_image_src()
{
	return BASE_URL . DEFAULT_NO_IMAGE;
}
