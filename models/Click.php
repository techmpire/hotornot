<?php

class Click extends ActiveRecord\Model {
   	


    public function before_create() {
        $this->assign_attribute('cid', $this->cid);
        $this->assign_attribute('aid', $this->aid);
        $this->assign_attribute('sid', $this->sid);     
    }
    
}