<?php
    
    session_cache_limiter(false);
    session_start();

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
    
    // Routes:
    // Home
    $app->get('/', function () use ($app) {
        $app->render('home.html');
    });
    
    $app->get('/home', function () use ($app) {
        $app->render('home.html');
    });
    
    $app->post('/home', function () use ($app) {
        $post = $app->request->post();
        $user = new User();
        $user->first_name = $post['first_name'];
        $user->last_name = $post['last_name'];
        $user->email = $post['email'];
        $user->save();
        $_SESSION['digitalx_hash'] = $user->hash;
        $app->response->redirect('/refer');
    });
    
    // Refer
    $app->get('/refer', function () use ($app) {
        $app->render('refer.html');
    });
    
    $app->post('/refer', function () use ($app) {
    
        $friends = explode(',', $app->request->post('friends'));
        $user = User::find_by_hash($_SESSION['digitalx_hash']);
        
        if (!is_numeric($user->id)) {
            exit('user hash not found');
        } else {
            foreach ($friends as $friend) {
                $friend = new Friend(array(
                    'user_id' => $user->id,
                    'friend_email' => trim($friend)
                ));
                $friend->save();
            }
            
        }
        //$app->response->redirect('/social');
    });
    
    $app->get('/confirm/:hash', function ($hash) use ($app) {
    
        $user = User::find_by_hash($hash);
        if (is_object($user)) {
            $user->email_confirmed = 1;
            $user->save();
        }
        //$app->response->redirect('/social');
    });
    
    $app->run();