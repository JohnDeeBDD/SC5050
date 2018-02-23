<?php

namespace SC5050;

trait AbilityToLoginWordpressAs_role{

	public function loginWordpressAs($role) {
		$I = $this;
		//$I->wantToTest('Login Wordpress');
		global $CRG_loginPageURL; //This variable is set in the tests/_bootstrap.php file
		$I->amOnUrl($CRG_loginPageURL);
		$I->see('Lost your password?');
		switch ($role) {
			case "admin":
				global $CRG_adminRoleUserName; //This variable is set in the tests/_bootstrap.php file
				$I->fillField('#user_login', $CRG_adminRoleUserName);
				global $CRG_adminRoleUserPassword; //This variable is set in the tests/_bootstrap.php file
				$I->fillField('pwd', $CRG_adminRoleUserPassword);
				$I->click('Log In');
				$I->see('Howdy');
				break;
			default:
				throw new \Exception('login role not recognized');
				break;
		}
	}
}
