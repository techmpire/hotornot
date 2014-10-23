<?php
    
    session_cache_limiter(false);
    session_start();
    require_once 'vendor/autoload.php';
    $app = new \Slim\Slim();
    
    require_once 'config.php';

    ActiveRecord\Config::initialize(function($cfg) use($conf) {
        $cfg->set_model_directory('models');
        $cfg->set_connections(array(
            'development' => 'mysql://' . $conf['user'] . ':' . $conf['pass'] . '@' . $conf['host'] . '/' . $conf['db']
        ));
    });
    
    $app->config(array(
        'debug' => true,
        'templates.path' => 'templates/'
    ));
    
    $app->get('/', function () use ($app) {
        $app->render('home.html', array(
            'title' => 'Welcome'
        ));
    });
    
    // To implement...
    $app->get('/track/cid/:cid/aid/:aid/sid/:sid', function () use ($app) {

        $thankyou_template = 'http://devtest.local/thankyou/camp/[-cid-]/aff/[-aid-]/pub/[-sid-]';

    });
    
    // To implement...
    $app->get('/thankyou', function () use ($app) {
        
    });
    
    $app->run();