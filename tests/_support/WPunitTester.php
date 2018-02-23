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
class WPunitTester extends \Codeception\Actor
{
    use _generated\WPunitTesterActions;

    /**
     * @Given there is a CPT called :arg1
     */
    public function thereIsACPTCalled($arg1){
    	$all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );
    	// there are no custom post types:
    	if ( empty ( $all_custom_post_types ) ){
    		return FALSE;
    	}
    
    	$custom_types = array_keys($all_custom_post_types);	
    	$bool = in_array($arg1, $custom_types);
    	
    	$this->assertEquals(TRUE, $bool);
    }
    
    /**
     * @When I create a new :arg1 CPT
     */
    public function iCreateANewCPT($arg1){
    	add_action('new_to_publish', 'your_function');
    	add_action('draft_to_publish', 'your_function');
    	add_action('pending_to_publish', 'your_function');
    	//throw new \Codeception\Exception\Incomplete("Step `I create a new :arg1 CPT` is not defined");
    }
    
    /**
     * @Then I should create a new WooCommerce product
     */
    public function iShouldCreateANewWooCommerceProduct()
    {
    	//throw new \Codeception\Exception\Incomplete("Step `I should create a new WooCommerce product` is not defined");
    }
    
    /**
     * @Given there is a WooCommerce product
     */
    public function thereIsAWooCommerceProduct()
    {
    	//throw new \Codeception\Exception\Incomplete("Step `there is a WooCommerce product` is not defined");
    }
    
    /**
     * @Given there is a raffle
     */
    public function thereIsARaffle()
    {
    	//throw new \Codeception\Exception\Incomplete("Step `there is a raffle` is not defined");
    }
    
    /**
     * @When the publish status of the raffle changes
     */
    public function thePublishStatusOfTheRaffleChanges()
    {
    	//throw new \Codeception\Exception\Incomplete("Step `the publish status of the raffle changes` is not defined");
    }
    
    /**
     * @Then the Woo product should reflect that
     */
    public function theWooProductShouldReflectThat()
    {
    	//throw new \Codeception\Exception\Incomplete("Step `the Woo product should reflect that` is not defined");
    }
    
}

