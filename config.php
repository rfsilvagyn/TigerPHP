<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define('BASE_URL', 'http://localhost/tiger/');
	define('TOKEN_HUB', 'INFORME AQUI');
	define('SMTP_AUTH', 'true');
	define('SMTP_HOST', 'INFORME AQUI');
	define('SMTP_USER', 'INFORME AQUI');
	define('SMTP_PASS', 'INFORME AQUI');
	define('SMTP_PORT', 'INFORME AQUI');

	date_default_timezone_set('America/Sao_Paulo');
	$config['dbname'] = 'tiger';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';

	$config['dbname-radius'] = 'radius';
	$config['host-radius'] = 'localhost';
	$config['dbuser-radius'] = 'root';
	$config['dbpass-radius'] = 'root';
} else {
	define('BASE_URL', 'http://localhost/tiger/');
	define('TOKEN_HUB', 'INFORME AQUI');
	define('SMTP_AUTH', 'true');
	define('SMTP_HOST', 'INFORME AQUI');
	define('SMTP_USER', 'INFORME AQUI');
	define('SMTP_PASS', 'INFORME AQUI');
	define('SMTP_PORT', 'INFORME AQUI');

	date_default_timezone_set('America/Sao_Paulo');
	$config['dbname'] = 'tiger';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';

	$config['dbname-radius'] = 'radius';
	$config['host-radius'] = 'localhost';
	$config['dbuser-radius'] = 'root';
	$config['dbpass-radius'] = 'root';
}

//DB TIGER
$db = new PDO("mysql:dbname=".$config['dbname'].";charset=utf8;host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//DB RADIUS
$dbradius = new PDO("mysql:dbname=".$config['dbname-radius'].";charset=utf8;host=".$config['host-radius'], $config['dbuser-radius'], $config['dbpass-radius']);
$dbradius->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
