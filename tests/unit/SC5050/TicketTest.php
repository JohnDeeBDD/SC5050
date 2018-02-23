<?php

namespace SC5050;

class TicketTest extends \Codeception\TestCase\WPTestCase{

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_be_instantiatable(){
		$Ticket = new Ticket();
	}
}