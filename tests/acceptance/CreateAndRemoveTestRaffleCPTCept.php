<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('Create and remove test CPT');
$I->dontHavePostInDatabase(array('post_title' => 'testraffle'));
$I->dontSeePostInDatabase(array('post_title' => 'testraffle'));
$I->createTestRaffleCPT();
$I->SeePostInDatabase(array('post_title' => 'testraffle'));


$I->destroyTestRaffleCPT();
$I->dontSeePostInDatabase(array('post_title' => 'testraffle'));