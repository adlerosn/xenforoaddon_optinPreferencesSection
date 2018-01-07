<?php

class optinPreferencesSection_Extend_XfDwUserField extends XFCP_optinPreferencesSection_Extend_XfDwUserField {
	protected function _getFields(){
		$flds = parent::_getFields();
		$flds['xf_user_field']['display_group']['allowedValues'][] = 'optins';
		return $flds;
	}
}
