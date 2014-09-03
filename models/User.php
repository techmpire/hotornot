<?php

class User extends ActiveRecord\Model {
   	
    static $has_many = array(
        array('friends')
    );
	
	 public function before_create() {
        $this->assign_attribute('signup_ip_address', $_SERVER['REMOTE_ADDR']);
        $this->assign_attribute('hash', md5(microtime().$this->email));
    }
	
}