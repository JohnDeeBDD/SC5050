<?php

namespace WooCommerceTester;

trait AbilityToConfirmWooCommerceDefaultPagesExist{
    
    public function confirmWooCommerceDefaultPagesExist(){
        $I = $this;
        $I->wantTo('Confirm the default WooCommerce pages exist.');
        
		global $CRG_homePageURL; //This variable is set in the tests/_bootstrap.php file
		
		$checkoutPageURL = $CRG_homePageURL . "/checkout/";
		$I->amOnUrl($checkoutPageURL);
		$I->dontSee('Not Found');
		
		$cartPageURL = $CRG_homePageURL . "/cart/";
		$I->amOnUrl($cartPageURL);
		$I->dontSee('Not Found');
		$I->see('Cart');
    }
}
