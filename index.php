<?php

error_reporting(E_ALL & ~E_STRICT);
ini_set('default_charset', 'utf-8');
ini_set('display_errors', 'on');

define('DS', DIRECTORY_SEPARATOR);
date_default_timezone_set('America/Sao_Paulo');

if(file_exists('vendor/autoload.php')) {
  require_once 'vendor/autoload.php';
}

if(!file_exists('conf/config.php')) {
  echo "Não existe arquivo de configuração da base de dados\nVerifique se o arquivo existe, bem como suas permissões";
  exit;
}

require_once 'conf/config.php';

use System\App;
App::getInstance()->init();

