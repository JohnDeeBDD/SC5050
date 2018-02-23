<?php
$I = new AcceptanceTester($scenario);

$testRaffle = "testraffle";
$wooTicket= "Tickets for testraffle";

$I->wantTo('check that tickets are for sale when raffle is made');
$I->dontHavePostInDatabase(array('post_title' => $testRaffle));
$I->dontSeePostInDatabase(array('post_title' => $testRaffle));
$I->createTestRaffleCPT($testRaffle);
$I->SeePostInDatabase(array('post_title' => $testRaffle));
$I->SeePostInDatabase(array('post_title' => $wooTicket));

$I->destroyTestRaffleCPT();