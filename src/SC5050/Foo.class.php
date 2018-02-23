<?php

namespace SC5050;

class foo{
    
    public function someMethod() {
        $lorem = ""; 
        $ipsum = "";
        if($this->otherMethod($lorem, $ipsum)) {
            return "someMethodYeah!";
        }
        return "BOO!";
    }
    
    public function otherMethod($lorem, $ipsum){
        return false;
    }
}