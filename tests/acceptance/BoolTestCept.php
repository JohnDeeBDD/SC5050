<?php

//Using a Codeception action to branch the flow of the script
//This Cept will always pass because the exception is caught



try{
    $I = new AcceptanceTester($scenario);
    $I->amOnUrl("http://wordpress-bdd.com");
    $I->see("Never for mccconey, always for love.");
    echo('This happens if the $I->see works');
}
catch(Exception $e){
    echo('This happens if the $I->see fails');
    
    //Passes the exception up the ladder (optional):
    //throw new Exception($e);
}