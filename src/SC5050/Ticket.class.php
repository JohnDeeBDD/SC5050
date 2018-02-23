<?php

namespace SC5050;

class Ticket{

    // 0 for unsold. Otherwise it's the user ID
	public $owner;
	
	public $ticketNumber;
	
	public $raffleID;

	public function r3(){
	    return 3;
	}
}