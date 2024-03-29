<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	protected function _initNavigation() 
	{
	
	$this->bootstrap("layout");
	$layout = $this->getResource('layout');
	$view = $layout->getView();
	
	$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml','nav');
	$navigation = new Zend_Navigation($config);
	
	$view->navigation($navigation);
	
	}



}

