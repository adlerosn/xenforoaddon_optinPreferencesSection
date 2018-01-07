<?php

class optinPreferencesSection_Extend {
	public static function getExtensions(){
		return [
			['XenForo_ControllerPublic_Account', 'optinPreferencesSection_Extend_XfCpAccount'],
			['XenForo_Model_UserField'         , 'optinPreferencesSection_Extend_XfMdlUserField'],
			['XenForo_DataWriter_UserField'    , 'optinPreferencesSection_Extend_XfDwUserField'],
		];
	}
	public static function callback($class, array &$extend){
		$xtds = static::getExtensions();
		foreach($xtds as $xtd){
			$baseClass = $xtd[0];
			$toExtend = $xtd[1];
			if($class==$baseClass && !in_array($toExtend, $extend)){
				$extend[]=$toExtend;
			}
		}
	}
}
