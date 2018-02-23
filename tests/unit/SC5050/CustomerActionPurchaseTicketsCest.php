<?php

namespace SC5050;

class CustomerActionPurchaseTicketCest{

    public function testingCeptinCest(\AcceptanceTester $I){
        $I->amOnUrl('https://wordpress-bdd.com/');
        $I->see('Never for money');
        //$I->see('Lorum Ipsum');
    }

}