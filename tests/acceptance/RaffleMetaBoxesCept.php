<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('Create and remove test CPT');
$I->dontHavePostInDatabase(array('post_title' => 'testraffle'));
$I->dontSeePostInDatabase(array('post_title' => 'testraffle'));
$I->wantTo('Create a new raffle CPT');
$I->maximizeWindow();
$I->loginAsAdmin();
$I->amOnPage('/wp-admin/post-new.php?post_type=raffle');
$I->fillField('post_title', 'testraffle');
$I->fillField("SC5050-ticket-range-min",'1');
$I->fillField("SC5050-ticket-range-max",'10');

$I->see('There are no tickets in the bin.');

$I->click('#publish');
$buttonValue = $I->grabAttributeFrom('#publish', 'value');
$I->assertEquals("Update", $buttonValue);

$I->SeePostInDatabase(array('post_title' => 'testraffle'));

$I->dontSee('There are no tickets in the bin.');
$I->destroyTestRaffleCPT();

$I->dontSeePostInDatabase(array('post_title' => 'testraffle'));