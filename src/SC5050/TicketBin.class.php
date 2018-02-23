<?php

namespace SC5050;

class TicketBin{
	
	public $binOfTickets;
	
	protected $values = array();
	
	public function pullTicketByNumber($PRTN){
	    $binOfTickets = $this->binOfTickets;
	    $index = 0;
	    foreach($binOfTickets as $Ticket){
	        if($Ticket->ticketNumber == $PRTN){
	            array_splice($binOfTickets, $index, 1);
	            $this->binOfTickets = $binOfTickets;
	            return $Ticket;
	        }
	        $index++;
	    }
	    return FALSE;
	}
	
	public function assignOwnerToTickets($ownerID, $quantity){
	    
	}
	
	public function __get( $key ){
	    if ($key == "countUnSoldTickets"){
	        return ($this->countUnSoldTickets());
	    }
	    return $this->values[ $key ];
	}
	
	public function countUnSoldTickets(){
	    $binOfTickets = $this->binOfTickets;
	    $c = count($binOfTickets);
	    if(($c == null) or ($c == 0)){
	        return 0;
	    }
	    
	    $x = 0;
	    foreach($binOfTickets as $Ticket){
	        if($Ticket->owner == 0){
	            $x = $x + 1;
	        }
	    }
	    return $x;
	}
	
	public function __set( $key, $value ){
	    $this->values[ $key ] = $value;
	}

	public function getBinFromDB($ID){
		$ticketData = get_post_meta($ID, "ticketData", true);
		$this->binOfTickets = $ticketData;
		if(!(metadata_exists('post', $ID, 'wooTicketProduct'))){
		    $SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct;
		    $SystemActionCreateTicketProduct->doCreateTicketProduct($ID);
		}
		return TRUE;
	}
	
	public function putBinInDB($ID){
	    $this->doSortBinOfTickets();
		update_post_meta( $ID, "ticketData", ($this->binOfTickets));
		$wooTicketProduct = get_post_meta($ID, "wooTicketProduct", TRUE);
		$stock = $this->countUnSoldTickets();
		update_post_meta( $ID, "unsoldStocko", $stock);
		wc_update_product_stock( $wooTicketProduct, $stock);
		update_post_meta( $wooTicketProduct, '_sale_price', 1);
		//update_post_meta( $wooTicketProduct, 'stocko', $stock);
		update_post_meta( $wooTicketProduct, '_price', 1);
		return TRUE;
	}
	
	public function doSortBinOfTickets(){
	    if (($this->binOfTickets) > 1){
	        usort(($this->binOfTickets), array($this, "sortBin"));
	    }
	}
	
	public function sortBin($a, $b){
	    if($a->ticketNumber == $b->ticketNumber){ return 0 ; }
	    return ($a->ticketNumber < $b->ticketNumber) ? -1 : 1;
	}
	
	public function addTicket(Ticket $ticket){
	    if($ticket->ticketNumber == NULL){throw new \Exception("Ticket has no number");}
	    
		$binOfTickets = $this->binOfTickets;
		if ($binOfTickets == NULL){$binOfTickets = array();}
		$newArray = array();

		foreach($binOfTickets as $xticket){
		    if($xticket->ticketNumber != $ticket->ticketNumber){
		        array_push($newArray, $xticket);
		    }
		}

		array_push($newArray, $ticket);
		$this->binOfTickets = $newArray;
		$this->doSortBinOfTickets();
		
	}	
}