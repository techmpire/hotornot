<?php

class User extends ActiveRecord\Model {
   	
    static $has_many = array(
        array('friends')
    );
	
	public function before_create() {
        $this->assign_attribute('signup_ip_address', $_SERVER['REMOTE_ADDR']);
        $this->assign_attribute('hash', md5(microtime().$this->email));
    }
    
	/*function getAge($date) {
		$birthDate = explode("-", $date);
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
		return $age;	
	}
	
	public function before_destroy() {
    	Program::delete_all(array('conditions' => array('client_id' => $this->id)));
      	NutritionPlan::delete_all(array('conditions' => array('client_id' => $this->id)));
      	WeightAssessment::delete_all(array('conditions' => array('client_id' => $this->id)));
      	GirthAssessment::delete_all(array('conditions' => array('client_id' => $this->id)));
      	SkinfoldAssessment::delete_all(array('conditions' => array('client_id' => $this->id)));
      	Token::delete_all(array('conditions' => array('client_id' => $this->id)));
    }*/
	
}