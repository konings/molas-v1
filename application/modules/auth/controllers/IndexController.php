<?php

class Auth_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	 // disable layouts for this action:
        $this->_helper->layout->disableLayout();
        
        //show form
     	$form = new Auth_Form_Login;
		$this->view->form = $form;
    }


}

