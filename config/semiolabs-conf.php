<?php
// This file generated by Propel 1.6.7 convert-conf target
// from XML runtime conf file C:\wamp\www\semiolabs\runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'semio' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=localhost;dbname=semio',
        'user' => 'root',
        'password' => '',
      ),
    ),
    'default' => 'semio',
  ),
  'generator_version' => '1.6.7',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-semiolabs-conf.php');
return $conf;