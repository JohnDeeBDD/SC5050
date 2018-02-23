<?php

namespace SC5050;

//This class checks if something is coming out of the meta boxes
class AdminActionAddTickets{

	public function listenToDateTime(){
		$ListenerDateTime = new ListenerDateTime;
	}
	
	public function listenToAddTickets(){
		if (isset($_POST['SC5050-ticket-one']) && is_numeric($_POST['SC5050-ticket-one'])){

			$Bin = new TicketBin();
			$ID = $_POST['post_ID'];
			$Bin->getBinFromDB($ID);
			$Ticket = new Ticket;
			$Ticket->raffle = $_POST['post_ID'];
			$Ticket->ticketNumber = $_POST['SC5050-ticket-one'];
            $Ticket->owner = 0;
            $Bin->addTicket($Ticket);
            $Bin->putBinInDB($ID);
            unset($Bin);
            unset($Ticket);
			unset($_POST['SC5050-ticket-one']);
		}
		if (isset($_POST['SC5050-ticket-range-min']) && is_numeric ($_POST['SC5050-ticket-range-min'])){
			$minTicket= $_POST['SC5050-ticket-range-min'];
			$maxTicket= $_POST['SC5050-ticket-range-max'];
			$Bin = new TicketBin();
			$ID = $_POST['post_ID'];
			$Bin->getBinFromDB($ID);
			while($minTicket <= $maxTicket){
			    $Ticket = new Ticket;
			    $Ticket->raffle = $_POST['post_ID'];
			    $Ticket->ticketNumber = $minTicket;
			    $Ticket->owner = 0;
			    //$Ticket->status = "U";
			    $Bin->addTicket($Ticket);
			    unset($Ticket);
			    $minTicket++;
			}
			$Bin->putBinInDB($ID);
			unset($Bin);
		}
	}
	
	public function dateTimeListenerConditionalBoolean(){
		if(isset($_POST['SC5050-raffle-date'])){
			if(isset($_POST['SC5050-hidden-post-id'])){
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
	
	public function addTicketsListenerConditionalBoolean(){
		$PASS = FALSE;
		if (isset($_POST['SC5050-ticket-range-min'])){
			$min = $_POST['SC5050-ticket-range-min'];
			if(is_numeric($min)){
				if (isset($_POST['SC5050-ticket-range-max'])){
					$max = $_POST['SC5050-ticket-range-max'];
					if(is_numeric($max)){
						if($max>$min){
							$PASS = TRUE;
						}
					}
				}
			}
		}
		
		if (isset($_POST['SC5050-ticket-one'])){
			$one = $_POST['SC5050-ticket-one'];
			if(is_numeric($one)){
				$PASS = TRUE;
			}
		}
		return $PASS;
	}
	
}