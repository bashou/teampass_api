<?php

require_once('config.php');
require_once('functions.php');

if (count($ip_whitelist) > 0 && !in_array($_SERVER['REMOTE_ADDR'], $ip_whitelist)) {
	rest_error('IPWHITELIST');
}

parse_str($_SERVER['QUERY_STRING']);
$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

header('Content-Type: application/json');

switch ($method) {
  case 'GET':
    rest_get();
    break;
  case 'POST':
    rest_post();
    break;
  case 'HEAD':
    rest_head();
    break;
  default:
    rest_error('UNKNOWN');
    break;
}

?>
