<?php

namespace SC5050;

trait AbilityToSeePluginIsActivated_pluginName{
	public function seePluginIsActivated($pluginName){
		$I = $this;
		$x = "wp plugin status $pluginName";
		$str = shell_exec($x);
		if (strpos($str, 'Active') !== FALSE){
		 }else{
		 	$x = "The plugin $pluginName is not activated";
    			throw new \Exception($x);
		 }
	}
}