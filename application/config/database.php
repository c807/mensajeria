<?php
defined('BASEPATH') or exit('No direct script access allowed');
//require dirname(dirname(dirname(FCPATH))) . '/entorno.php';

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'port'     => $DB_PORT,
	'hostname' => $DB_HOSTNAME,
	'password' => $DB_PASSWORD,
	'username' => $DB_USERNAME,
	'port'     => '3306',
	// 'hostname' => '192.168.168.27',
	// 'username' => 'elmersv',
	// 'password' => '3lm3r.19',
	'database' => 'mensajeria',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
