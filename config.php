<?php

    date_default_timezone_set('UTC');
    
    if ($app->request->getHost() == 'digitalx.com') {
    
        $fig = array(
            'user' => 'digitalx-com',
            'pass' => 'FEdpwkJWiC4t',
            'host' => '127.0.0.1',
            'db' => 'digitalx-com',
            'captcha_public' => '6LftPvkSAAAAAEK2TLm0O4k-tY1uLHn_aUtE1zpa',
            'captcha_private' => '6LftPvkSAAAAALH-K0DTE-Q6swDWETAnVkzJ3JNG'
        );
    
    } else {
        
        $fig = array(
            'user' => 'root',
            'pass' => 'root',
            'host' => 'localhost',
            'db' => 'digitalx',
            'captcha_public' => '6LfuPvkSAAAAAI-4FdIeRwd_r_nHBoZpPQoevrSL',
            'captcha_private' => '6LfuPvkSAAAAAAi5HndIo9gvnllXfG7x3XMTk5P8'
        );
        
    }