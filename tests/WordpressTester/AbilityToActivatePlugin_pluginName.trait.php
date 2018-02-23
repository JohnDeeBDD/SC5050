<?php

namespace SC5050;

trait AbilityToActivatePlugin_pluginName{

	public function activatePlugin($pluginName) {

		//activate the plugin
		$execCommand = "wp plugin activate $pluginName";
		$execReturnString = shell_exec($execCommand);

		//check status, and then return true or false if the plugin was infact activated
		$execCommand = "wp plugin status $pluginName";
		$execReturnString = shell_exec($execCommand);

		if (strpos($execReturnString, 'Active') !== FALSE){
			//the plugin has indeed been activated:
			return TRUE;
		}else{
			//the plugin has not been activated:
			return FALSE;
		}
	}
}