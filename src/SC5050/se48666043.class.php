<?php

namespace SC5050;

class foo{

    public function someMethod() {
        ...
        if ($this->otherMethod($lorem, $ipsum)) {
            ...
        }
        ...
    }
        
    public function otherMethod($lorem, $ipsum){
        return TRUE;
    }
}