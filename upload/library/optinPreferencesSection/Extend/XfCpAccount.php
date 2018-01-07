<?php

class optinPreferencesSection_Extend_XfCpAccount extends XFCP_optinPreferencesSection_Extend_XfCpAccount {
	public function actionOptins(){
		//optinPreferencesSection_Install::install();
		//optinPreferencesSection_Install::uninstall();
		$viewParams = [
			'customFields' => $this->_getFieldModel()->prepareUserFields($this->_getFieldModel()->getUserFields(
				array('display_group' => 'optins'),
				array('valueUserId' => XenForo_Visitor::getUserId())
			), true)
		];

		return $this->_getWrapper(
			'account', 'optins',
			$this->responseView('XenForo_ViewPublic_Base', 'account_optins', $viewParams)
		);
	}
	
	public function actionOptinsSave(){
		$this->_assertPostOnly();
		
		$settings = [];
		
		$customFields = $this->_input->filterSingle('custom_fields', XenForo_Input::ARRAY_SIMPLE);
		$customFieldsShown = $this->_input->filterSingle('custom_fields_shown', XenForo_Input::STRING, array('array' => true));

		$writer = XenForo_DataWriter::create('XenForo_DataWriter_User');
		$writer->setExistingData(XenForo_Visitor::getUserId());
		$writer->bulkSet($settings);
		$writer->setCustomFields($customFields, $customFieldsShown);
		$writer->preSave();

		if ($dwErrors = $writer->getErrors())
		{
			return $this->responseError($dwErrors);
		}

		$writer->save();

		
		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::SUCCESS,
			XenForo_Link::buildPublicLink('account/optins')
		);
	}
}
