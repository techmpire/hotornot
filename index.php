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
    $app->get('/track/cid/:cid/aid/:aid/sid/:sid', function ($cid, $aid, $sid) use ($app) {

        //$thankyou_template = 'http://devtest.local/thankyou/camp/[cid]/aff/[aid]/pub/[sid]';
        $thankyou_template = "http://devtest.local/thankyou/camp/$cid/aff/$aid/pub/$sid";
        
        $attributes = array('cid' => $cid, 'aid' => $aid, 'sid' => $sid);
        $click = new Click($attributes);
        $click->save();        

        $app->redirect('/thankyou');
    });
    
    // To implement...
    $app->get('/thankyou', function () use ($app) {
        $app->render('thankyou.html', array(
            'title' => 'Thank you'
        ));
        $posts = Click::find('all');
        
        foreach ($posts as $post) {
            foreach ($post as $key => $value) {
                echo $post->cid . ' ' . $post->aid . ' '. $post->sid . '<br />';      
            }
        }
        //

    });
    
    $app->run();