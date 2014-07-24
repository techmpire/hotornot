<?php

class Friend extends ActiveRecord\Model {
   	
    static $belongs_to = array(
        array('user')
    );
    	
}