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
class FunctionalTester extends \Codeception\Actor{
	
    use _generated\FunctionalTesterActions;
    public function createTestRaffleCPT(){
    	$I = $this;
    	$I->wantTo('Create a new raffle CPT');
    	$I->loginAsAdmin();
    	$id = wp_insert_post(array('post_title'=>'Test Raffle', 'post_type'=>'raffle', 'post_content'=>'demo text'));
    	$I->seePostInDatabase(array('post_title' => 'Test Raffle'));
    	return $id;
    }    
}
