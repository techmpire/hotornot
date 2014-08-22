<?php
    
    session_cache_limiter(false);
    session_start();
    require_once 'vendor/autoload.php';
    $app = new \Slim\Slim();
    
    require_once 'config.php';
    
    ActiveRecord\Config::initialize(function($cfg) {
        global $fig;
        $cfg->set_model_directory('models');
        $cfg->set_connections(array(
            'development' => 'mysql://' . $fig['user'] . ':' . $fig['pass'] . '@' . $fig['host'] . '/' . $fig['db']
        ));
    });
    
    $app->config(array(
        'debug' => true,
        'templates.path' => 'templates/'
    ));
    
    $app->view(new \Slim\Views\Twig());
    $app->view->parserOptions = array(
        'charset'             => 'utf-8',
        'cache'               => false, 
        'auto_reload'         => true,
        'strict_variables'    => false,
        'autoescape'          => true
    );
    
    $app->get('/', function () use ($app) {
        $app->render('home.html');
    });
    
    $app->get('/home', function () use ($app) {
        $app->render('home.html');
    });
    
    $app->post('/home', function () use ($app) {
        
        $post = $app->request->post();
        $user = User::find_by_email($post['email']);
        
        // make sure no fields are blank
        if ($post['first_name'] == '' || $post['last_name'] == '' || $post['email'] == '') {
            
            $app->render('home.html', array(
                'post' => $post,
                'error' => 'Please fill out all mandatory fields'
            ));
        
        // make sure email is valid
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            
            $app->render('home.html', array(
                'post' => $post,
                'error' => 'Please enter a valid email'
            ));
        
        // make sure user hasn't been signed up already
        } elseif (is_object($user)) {
            
            $app->render('home.html', array(
                'post' => $post,
                'error' => 'A user with that email has already registered'
            ));
            
        } else {
            
            $user               = new User();
            $user->first_name   = ucwords(trim($post['first_name']));
            $user->last_name    = ucwords(trim($post['last_name']));
            $user->email        = trim($post['email']);
            $user->phone        = trim($post['phone']);
            $user->save();
            
            $_SESSION['digitalx_hash'] = $user->hash;
            
            // Add to campaign monitor
            require_once 'vendor/campaignmonitor/createsend-php/csrest_subscribers.php';
            $auth = array('api_key' => 'd76e1c1b93ddb38142686f0d03167314');
            $wrap = new CS_REST_Subscribers('20ce29e6f724dbfe2f8a092fade79374', $auth);
            
            $result = $wrap->add(array(
                'EmailAddress' => $user->email,
                'Name' => $user->first_name . ' ' . $user->last_name,
                'CustomFields' => array(
                    array(
                        'Key' => 'Phone',
                        'Value' => $user->phone
                    ),
                    array(
                        'Key' => 'Sign up IP',
                        'Value' => $user->signup_ip_address
                    )
                ),
                'Resubscribe' => false
            ));       
    
            $app->response->redirect('/refer');
        
        }
        
    });
    
    $app->get('/refer', function () use ($app) {
        
        if (empty($_SESSION['digitalx_hash'])) 
            $app->response->redirect('/home');
        else
            $app->render('refer.html', array(
                'page' => 'refer'
            ));
            
    });
    
    $app->post('/refer', function () use ($app) {
        
        if (empty($_SESSION['digitalx_hash'])) {
            $app->response->redirect('/home');
            exit;
        }
        
        $names = array_filter($app->request->post('names'));
        $emails = array_filter($app->request->post('emails'));
        
        if (sizeof($names) == 0 || sizeof($emails) == 0) {
            
            $app->render('refer.html', array(
                'error' => 'Please enter at least one name and email to proceed'
            ));
            
        } else {
        
            $user = User::find_by_hash($_SESSION['digitalx_hash']);
            
            if (!is_numeric($user->id)) {
                exit('user hash not found');
            } else {
            
                foreach ($names as $key => $name) {
                    
                    $email = $emails[$key];
                    
                    if ($name != '' and $email != '') {
                    
                        $friend = new Friend(array(
                            'user_id' => $user->id,
                            'name' => trim($name),
                            'email' => trim($email)
                        ));
                        
                        $friend->save();
                        
                        // Add to campaign monitor
                        require_once 'vendor/campaignmonitor/createsend-php/csrest_subscribers.php';
                        $auth = array('api_key' => 'd76e1c1b93ddb38142686f0d03167314');
                        $wrap = new CS_REST_Subscribers('96de291d473755eb0495f6c2faa09666', $auth);
                        
                        $result = $wrap->add(array(
                            'EmailAddress' => trim($email),
                            'Name' => trim($name),
                            'CustomFields' => array(
                                array(
                                    'Key' => 'Friend ID',
                                    'Value' => $user->id
                                ),
                                array(
                                    'Key' => 'Friend name',
                                    'Value' => $user->first_name . ' ' . $user->last_name
                                ),
                                array(
                                    'Key' => 'Friend email',
                                    'Value' => $user->email
                                )
                            ),
                            'Resubscribe' => false
                        ));
                    
                    }
                    
                }
                
                $app->response->redirect('/thankyou');
                    
            }
        
        }
        
    });
    
    $app->get('/thankyou', function () use ($app) {
        $_SESSION['digitalx_hash'] = '';
        $app->render('thankyou.html', array(
                'page' => 'thankyou'
            ));
    });
    
    $app->run();