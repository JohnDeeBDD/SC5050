<?php

namespace SC5050;


class AdminActionDeclareWinner{
    
    public function declareWinner($winner, $raffleID){
        update_post_meta( $raffleID, "raffleWinner", $winner );
    }
    
}