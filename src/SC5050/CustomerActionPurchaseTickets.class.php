<?php

namespace SC5050;

class CustomerActionPurchaseTickets{
    
    
    
    public function doPurchaseTickets(){
        

        $order_id = $this->getOrderIdFromUrl();
        
        //if it's not a ticket product order:
        if(!($order_id)){return FALSE;}
        
        $order = new \WC_Order($order_id);
        // Get the custumer ID
        $customerID = $order->get_user_id();
        $order_data = $order->get_data(); 
        foreach ($order->get_items() as $item_key => $item_values){
            $item_data = $item_values->get_data();
            $product_id = $item_data['product_id'];
            if( get_post_meta( $product_id, 'raffleID', true ) ) {
                $raffleID = get_post_meta( $product_id, 'raffleID', true );
                $quantity = $item_data['quantity'];
             }else{
                return false;
            }
        }
        
        $TicketBin = new TicketBin();
        $TicketBin->getBinFromDB($raffleID);
        $binOfTickets = $TicketBin->binOfTickets;
        $arrayOfTicketIDs = array();
        $newBin = array();
        foreach($binOfTickets as $Ticket){
            if (!($quantity == 0)){
                if ($Ticket->owner == 0){
                    $Ticket->owner = $customerID;
                    array_push($arrayOfTicketIDs, ($Ticket->ticketNumber));
                    $quantity = $quantity - 1;
                }
           }
           array_push($newBin, $Ticket);
        }
        $TicketBin->binOfTickets = $newBin;
        $TicketBin->putBinInDB($raffleID);
        $note = "Raffle ID: $raffleID<br />Ticket #s: ";
        foreach($arrayOfTicketIDs as $ticketID){
            $note = $note . "$ticketID, ";
        }
        
        
        $order->add_order_note( $note );
        
        update_post_meta( $order_id,  'arrayOfTicketIDs', "hi there");
    }
    
    private function getOrderIdFromUrl(){
        $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $template_name = strpos($url,'/order-received/') === false ? '/view-order/' : '/order-received/';
        if (strpos($url,$template_name) !== false) {
            $start = strpos($url,$template_name);
            $first_part = substr($url, $start+strlen($template_name));
            $order_id = substr($first_part, 0, strpos($first_part, '/'));
            return $order_id;
        }else{
            return FALSE;
        }

    }

    public function isProductRaffleTicket($ID){
            return TRUE;
    }
}