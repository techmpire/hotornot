<?php

    require_once 'config.php';
    require_once 'vendor/autoload.php';
    
    // ActiveRecord
    ActiveRecord\Config::initialize(function($cfg) {
        global $fig;
        $cfg->set_model_directory('models');
        $cfg->set_connections(array(
            'development' => 'mysql://' . $fig['user'] . ':' . $fig['pass'] . '@' . $fig['host'] . '/' . $fig['db']
        ));
    });
    
    // Slim
    $app = new \Slim\Slim();
    
    // Set the template path
    $app->config(array(
        'debug' => true,
        'templates.path' => 'templates/'
    ));
    
    // Prepare view
    $app->view(new \Slim\Views\Twig());
    $app->view->parserOptions = array(
        'charset'             => 'utf-8',
        'cache'               => false, //'templates/cache',
        'auto_reload'         => true,
        'strict_variables'    => false,
        'autoescape'          => true
    );
    //$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());
    
    // Routes
    $app->get('/home', function () use ($app) {
        $app->render('home.html', array(
            'test' => 'ok'
        ));
    });
    
    $app->run();