<?php

namespace WooCommerceTester;

class WooCommerceTester implements WooCommerceTesterInterface{
	//use AbilitToPurchaseWooProduct;
	use AbilityToConfirmWooCommerceDefaultPagesExist;
}

interface WoocommerceTesterInterface{
    //public function purchaseWooProduct($productURL);
    public function confirmWooCommerceDefaultPagesExist();
}