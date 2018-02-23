<?php

namespace SC5050;

class SystemActionListenForDeclareWinner{
    
    public function listen(){
        //die('listen');
        
        if (isset($_POST['SC5050-winner'])){
            $winner = $_POST['SC5050-winner'];
            if (!($winner == "")){
                //if($this->validateWinner($winner)){
                    if((\wp_verify_nonce( $_POST['SC5050-winner-nonce-field'], 'AdminActionDeclareWinner' ))){
                        //die("listen");
                        $raffleID = $_POST['SC5050-hidden-post-id'];
                        $AdminActionDeclareWinner = new AdminActionDeclareWinner;
                        $AdminActionDeclareWinner->declareWinner($winner, $raffleID);
                    }
               // }
            }
        }
    }
    
    public function validateWinner($winner){
        return true;
        if(!(is_numeric($winner))){
            //die('validateWinner');
            echo ("
                <div class='notice notice-success is-dismissible'>
                    <p>This is not a number.</p>
                </div>
            ");
            return FALSE;
        }
        return true;
    }
    
}
