<?php

class optinPreferencesSection_Install {
	public static function install(){
		//Checking if 'optins' is a valid enumerable
		$q = "SHOW COLUMNS FROM xf_user_field WHERE Field = 'display_group';";
		$currentEnum = XenForo_Application::getDb()->query($q)->fetchAll()[0]['Type'];
		preg_match_all("/'(.*?)'/" , $currentEnum, $enum_array);
		$currentFields = $enum_array[1];
		if(!in_array('optins',$currentFields)){
			//it isn't: changing schema to make it be
			$wantedFields = array_merge($currentFields,['optins']);
			$nq = "ALTER TABLE xf_user_field MODIFY COLUMN display_group ENUM('".implode("', '",$wantedFields)."') not null default 'personal';";
			XenForo_Application::getDb()->query($nq);
		}
	}
	public static function uninstall(){
		//Checking if 'optins' is a valid enumerable
		$q = "SHOW COLUMNS FROM xf_user_field WHERE Field = 'display_group';";
		$currentEnum = XenForo_Application::getDb()->query($q)->fetchAll()[0]['Type'];
		preg_match_all("/'(.*?)'/" , $currentEnum, $enum_array);
		$currentFields = $enum_array[1];
		if(in_array('optins',$currentFields)){
			// it is: puutting everything inside preferences
			XenForo_Application::getDb()->update('xf_user_field',['display_group'=>'preferences'],['display_group = ?'=>'optins']);
			// it is: changing schema to make it not be
			$wantedFields = array_diff($currentFields,['optins']);
			$nq = "ALTER TABLE xf_user_field MODIFY COLUMN display_group ENUM('".implode("', '",$wantedFields)."') not null default 'personal';";
			XenForo_Application::getDb()->query($nq);
		}
	}
}
