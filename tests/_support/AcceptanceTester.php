<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor{
  
	use _generated\AcceptanceTesterActions;

	public function createTestRaffleCPT($testRaffleTitle= "testraffle"){
    	$I = $this;
    	$I->wantTo('Create a new raffle CPT');
    	$I->maximizeWindow();
    	$I->loginAsAdmin();
    	$I->amOnPage('/wp-admin/post-new.php?post_type=raffle');
 
    	
    	$I->fillField('post_title', $testRaffleTitle);
    	$I->click('#publish');
    	$buttonValue = $I->grabAttributeFrom('#publish', 'value');
    	$I->assertEquals("Update", $buttonValue);
    }
    
    public function destroyTestRaffleCPT(){
    	$I = $this;
    	$I->wantTo('Create a new raffle CPT');
    	$I->amOnPage('/raffle/testraffle/');
    	$I->click('Edit Raffle');
    	$I->click('Move to Trash');
    	$I->amOnPage('/wp-admin/edit.php?post_status=trash&post_type=raffle');
    	$I->click("#delete_all");
    	
    	$I->amOnPage('/product/tickets-for-testraffle/');
    	$I->click('Edit product');
    	$I->click('Move to Trash');
    	$I->amOnPage('/wp-admin/edit.php?post_status=trash&post_type=product');
    	$I->click("#delete_all");
    	
    }
}
