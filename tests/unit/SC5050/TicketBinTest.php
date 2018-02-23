<?php

namespace SC5050;

class TicketBinTest extends \Codeception\TestCase\WPTestCase{

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_be_instantiatable(){
		$TicketBin = new TicketBin();
	}
	
	/**
	 * @test
	 * it should overide a duplicate added ticket
	 */
	public function itShouldOverwriteADuplicateAddedTicket(){
	    $raffleID = wp_insert_post(array('post_type'=>'raffle', 'post_title'=>'TEST POST1'));
	    
	    $SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct;
	    $SystemActionCreateTicketProduct->doCreateTicketProduct($raffleID);
	    $TicketBin = new TicketBin();
	    $TicketBin->getBinFromDB($raffleID);
	    
	    $Ticket1 = new Ticket;
	    $Ticket1->owner = 666;
	    $Ticket1->ticketNumber = 123;
	    $TicketBin->addTicket($Ticket1);
	    
	    $Ticket2 = new Ticket;
	    $Ticket2->owner = 777;
	    $Ticket2->ticketNumber = 123;
	    $TicketBin->addTicket($Ticket2);
	    
	    $binOfTickets = $TicketBin->binOfTickets;
	    $count = count($binOfTickets);
	    
	    $this->assertEquals(1, $count, "The count is $count");
	}
	    
	    /**
	     * @test
	     * it should pull(return) a ticket from the bin hmmm
	     */
	    public function itShouldPullTicketFromBin(){
	    $raffleID = wp_insert_post(array('post_type'=>'raffle', 'post_title'=>'TEST POST1'));
	    
	    $SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct;
	    $SystemActionCreateTicketProduct->doCreateTicketProduct($raffleID);
	    $TicketBin = new TicketBin();
	    $TicketBin->getBinFromDB($raffleID);
	    
	    $Ticket1 = new Ticket;
	    $Ticket1->owner = 666;
	    $Ticket1->ticketNumber = 123;
	    $TicketBin->addTicket($Ticket1);
	    
	    $Ticket2 = new Ticket;
	    $Ticket2->owner = 777;
	    $Ticket2->ticketNumber = 321;
	    $TicketBin->addTicket($Ticket2);
	    
	    $returnedTicket = $TicketBin->pullTicketByNumber(321);
	    
	    $binOfTickets = $TicketBin->binOfTickets;
	    $count = count($binOfTickets);
	    
	    $this->assertEquals(1, $count);
	    
	    $this->assertEquals($returnedTicket, $Ticket2);
	}
	
	/**
	 * @test
	 * it should count the unsold tickets
	 */
	public function itShouldCountTheUnsoldTickets(){
	    
	    $raffleID = wp_insert_post(array('post_type'=>'raffle', 'post_title'=>'TEST POST1'));
	    
	    $SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct;
	    $SystemActionCreateTicketProduct->doCreateTicketProduct($raffleID);
	    $TicketBin = new TicketBin();
	    
	    $Ticket1 = new Ticket;
	    $Ticket1->ticketNumber = 666;
	    $Ticket1->owner = 666;
	    $TicketBin->addTicket($Ticket1);
	    
	    $Ticket2 = new Ticket;
	    $Ticket2->ticketNumber = 777;
	    $Ticket2->owner = 777;
	    $TicketBin->addTicket($Ticket2);
	    
	    $Ticket3 = new Ticket;
	    $Ticket3->ticketNumber = 222;
	    $Ticket3->owner = 0;
	    $TicketBin->addTicket($Ticket3);
	    
	    $Ticket4 = new Ticket;
	    $Ticket4->ticketNumber = 231;
	    $Ticket4->owner = 0;
	    $TicketBin->addTicket($Ticket4);
	    
	    $Ticket5 = new Ticket;
	    $Ticket5->ticketNumber = 123123;
	    $Ticket5->owner = 0;
	    $TicketBin->addTicket($Ticket5);
	    
	    $unSoldTickets = $TicketBin->countUnSoldTickets;
	    	    
	    $this->assertEquals(3, $unSoldTickets, "Expecting 3 unSoldTickets: $unSoldTickets");
	}
	
	/**
	 * @test
	 * it should be able to add tickets to the bin
	 */
	public function it_should_add_tickets_to_the_bin(){
		$TicketBin = new TicketBin();
		$id = wp_insert_post(array('post_type'=>'raffle'));
		$TicketBin->getBinFromDB($id);
	
		$ticket = new Ticket;
		$ticket->owner = 666;
		$ticket->ticketNumber = 666;
		$TicketBin->addTicket($ticket);

		$numOfTickets= count($TicketBin->binOfTickets);
		$this->assertSame($numOfTickets, 1);
		
		$ticket2 = new Ticket;
		$ticket2->owner = 777;
		$ticket2->ticketNumber = 777;
		$TicketBin->addTicket($ticket2);
		
		$numOfTickets= count($TicketBin->binOfTickets);
		$this->assertSame($numOfTickets, 2);
	}
		
	/**
	 * @skip
	 * should render HTML output
	 */
	public function shouldRenderHtmlOutput(){
	    $TicketBin = new TicketBin();
	    $id = wp_insert_post(array('post_type'=>'raffle'));
	    $TicketBin->getBinFromDB($id);
	    
	    $ticket = new Ticket;
	    $ticket->owner = 123;
	    $ticket->ticketNumber = 444;
	    $TicketBin->addTicket($ticket);
	    
	    $HTML = $TicketBin->getHTML();
	    $this->assertNotEquals("There are no tickets in the bin.", $HTML, "It is replying: $HTML");
	}
	
	/**
	 * @skip
	 * should render HTML output when there are no tickets
	 */
	public function shouldRenderHtmlOutputWhenThereAreNoTickets(){
	    $TicketBin = new TicketBin();
	    $id = wp_insert_post(array('post_type'=>'raffle'));
	    $TicketBin->getBinFromDB($id);
    
	    $HTML = $TicketBin->getHTML();
	    $this->assertEquals("There are no tickets in the bin.", $HTML, "It is replying: $HTML");
	}

	/**
	 * @test
	 * it should be able to store and retreive bin from DB
	 */
	public function shouldStoreAndRetreiveBinFromDB(){
	    $TicketBin = new TicketBin();
	    $id = wp_insert_post(array('post_type'=>'raffle', 'post_title'=>'test title'));
	    $TicketBin->getBinFromDB($id);
	    
	    $ticket = new Ticket;
	    $ticket->owner = 666;
	    $ticket->ticketNumber = 666;
	    $TicketBin->addTicket($ticket);
	    
	    $numOfTickets= count($TicketBin->binOfTickets);
	    $this->assertSame($numOfTickets, 1);
	    
	    $ticket2 = new Ticket;
	    $ticket2->owner = 777;
	    $ticket2->ticketNumber = 777;
	    $TicketBin->addTicket($ticket2);
	    
	    $numOfTickets= count($TicketBin->binOfTickets);
	    $this->assertSame($numOfTickets, 2);
	    
	    $TicketBin->putBinInDB($id);
	    unset($TicketBin);
	    
	    $TicketBin = new TicketBin();
	    $TicketBin->getBinFromDB($id);
	    $numOfTickets= count(get_post_meta($id, "ticketData", TRUE));
	    //$numOfTickets= count(($TicketBin->binOfTickets));
	    
	    $x = var_export(($TicketBin->binOfTickets), TRUE);
	    $this->assertSame($numOfTickets, 2, "Var export $x");
	}


	/**
	 * @test
	 * it should sort the bin before it stores it
	 */
	public function shouldSortTheBin(){
	    $TicketBin = new TicketBin();
	    $id = wp_insert_post(array('post_type'=>'raffle', 'post_title'=>'test title'));
	    $TicketBin->getBinFromDB($id);
	    
	    //put tickets in in random order:
	    $ticket = new Ticket;
	    $ticket->ticketNumber = 666;
	    $TicketBin->addTicket($ticket);
	    
	    $ticket2 = new Ticket;
	    $ticket2->ticketNumber = 777;
	    $TicketBin->addTicket($ticket2);
	    
	    $ticket2 = new Ticket;
	    $ticket2->ticketNumber = 444;
	    $TicketBin->addTicket($ticket2);
	    
	    $TicketBin->putBinInDB($id);
	    unset($TicketBin);
	    
	    //now retreive them:
	    
	    $TicketBin = new TicketBin();
	    $TicketBin->getBinFromDB($id);
	    
	    $binOfTickets = $TicketBin->binOfTickets;
	    $ticket0 = $binOfTickets[0];
	    $ticket1 = $binOfTickets[1];
	    $ticket2 = $binOfTickets[2];
	    $this->assertEquals(444, ($ticket0->ticketNumber));
	    $this->assertEquals(666, ($ticket1->ticketNumber));
	    $this->assertEquals(777, ($ticket2->ticketNumber));
	}
}