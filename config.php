<?php

    
    date_default_timezone_set('UTC');
    
    if ($app->request->getHost() == 'digitalx.com') {
    
        $fig = array(
            'user' => 'digitalx-com',
            'pass' => 'FEdpwkJWiC4t',
            'host' => '127.0.0.1',
            'db' => 'digitalx-com'
        );
    
    } else {
        
        $fig = array(
            'user' => 'root',
            'pass' => 'root',
            'host' => 'localhost',
            'db' => 'digitalx'
        );
        
    }