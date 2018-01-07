<?php

class optinPreferencesSection_Extend_XfMdlUserField extends XFCP_optinPreferencesSection_Extend_XfMdlUserField {
	public function getUserFieldGroups(){
		return parent::getUserFieldGroups()+[
			'optins' => [
				'value' => 'optins',
				'label' => new XenForo_Phrase('optins'),
				'hint' => new XenForo_Phrase('these_fields_will_never_be_displayed_on_users_profile')
			]
		];
	}
}
