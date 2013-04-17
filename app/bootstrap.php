<?php

use Silex\Provider\FormServiceProvider;

require_once __DIR__ . '/../vendor/autoload.php';
$app = new Silex\Application();
$app['debug'] = true;


$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider(array(
            'session.storage.save_path' => sys_get_temp_dir())
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));


$app->register(new Propel\Silex\PropelServiceProvider(), array(
    'propel.config_file' => __DIR__ . '/../config/semiolabs-conf.php',
    'propel.model_path' => __DIR__ . '/../src',
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider(), array(
    'swiftmailer.options' => array(
        'host' => 'mx1.hostinger.fr',
        'port' => 2525,
        'username' => 'gourgan.hicham@nos-projets.pusku.com',
        'password' => 'agadir',
        'encryption' => 'ssl',
        'auth_mode' => 'login')
));

return $app;
