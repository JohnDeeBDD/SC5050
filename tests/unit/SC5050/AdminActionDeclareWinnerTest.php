<?php

namespace SC5050;

class AdminActionDeclareWinnerTest extends \Codeception\TestCase\WPTestCase{
    
    /**
     * @test
     * it should be instantiatable
     */
    public function it_should_be_instantiatable(){
        $AdminActionDeclareWinner = new AdminActionDeclareWinner();
    }
    
    /**
     * @test
     * it should stop selling tickets
     */
    public function itShouldStopSellingTickets(){
        $AdminActionDeclareWinner = new AdminActionDeclareWinner();
    }
    
    /**
     * @test
     * it should change the meta box
     */
    public function itShouldChangeTheMetaBox(){
        $AdminActionDeclareWinner = new AdminActionDeclareWinner();
    }
    
}