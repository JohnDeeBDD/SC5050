<?php

namespace SC5050;

class AdminActionAddTicketsTest extends \Codeception\TestCase\WPTestCase{

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_be_instantiatable(){
		$AdminActionAddTickets = new AdminActionAddTickets();
	}
	
	/**
	 * @test
	 * BOOL should work
	 */
	public function bool_should_fire_under_correct_conditions(){
		$AdminActionAddTickets = new AdminActionAddTickets();

		//nothing there:
		$this->assertFalse($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-one'] = "asd";
		$this->assertFalse($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-one'] = "5";
		$this->assertTrue($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		unset($_POST['SC5050-ticket-one']);
		
		$_POST['SC5050-ticket-range-min'] = "3";
		$_POST['SC5050-ticket-range-max'] = "10";
		$this->assertTrue($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-range-min'] = "1";
		$_POST['SC5050-ticket-range-max'] = "10";
		$this->assertTrue($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-range-min'] = "12";
		$_POST['SC5050-ticket-range-max'] = "12313123";
		$this->assertTrue($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-range-min'] = "10";
		$_POST['SC5050-ticket-range-max'] = "4";
		$this->assertFalse($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-range-min'] = "asd";
		$_POST['SC5050-ticket-range-max'] = "4";
		$this->assertFalse($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		unset($_POST['SC5050-ticket-range-min']);
		$_POST['SC5050-ticket-range-max'] = "4";
		$this->assertFalse($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
		$_POST['SC5050-ticket-range-min'] = "5";
		$_POST['SC5050-ticket-range-max'] = "5";
		$this->assertFalse($AdminActionAddTickets->addTicketsListenerConditionalBoolean());
		
	}



}