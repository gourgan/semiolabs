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
        'dsn' => 'mysql:host=db550818469.db.1and1.com;dbname=db550818469',
        'user' => 'dbo550818469',
        'password' => 'elhydaya',
      ),
    ),
    'default' => 'semio',
  ),
  'generator_version' => '1.6.7',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-semiolabs-conf.php');
return $conf;