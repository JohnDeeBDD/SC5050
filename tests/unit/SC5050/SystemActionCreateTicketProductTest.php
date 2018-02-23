<?php

namespace SC5050;

class SystemActionCreateTicketProductTest extends \Codeception\TestCase\WPTestCase{

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_be_instantiatable(){
		$SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct();
	}
	
	/**
	 * @test
	 * it should create a WooProduct
	 */
	public function it_should_create_a_woo_product(){
		$SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct();
		$raffleName = "Hiho raffle";
		$expectedTicketName= "Tickets for $raffleName";
		$productCost = 123;

		$id= wp_insert_post(array('post_title'=>$raffleName, 'post_type'=>'raffle', 'post_content'=>'demo text'));		
		$ID= $SystemActionCreateTicketProduct->doCreateTicketProduct($id);
		
		$returnedTitle = get_the_title($ID);
		$this->assertEquals($returnedTitle, $expectedTicketName);
	}
	
	/**
	 * @test
	 * it should set the inventory
	 */
	public function it_should_set_inventory(){
		$SystemActionCreateTicketProduct = new SystemActionCreateTicketProduct();
		$raffleName = "Hiho raffle";
		$expectedTicketName= "Tickets for $raffleName";
		$productCost = 123;
		
		$id= wp_insert_post(array('post_title'=>$raffleName, 'post_type'=>'raffle', 'post_content'=>'demo text'));
		$ID= $SystemActionCreateTicketProduct->doCreateTicketProduct($id);
		
		$returnedTitle = get_the_title($ID);
		$this->assertEquals($returnedTitle, $expectedTicketName);
	}



}