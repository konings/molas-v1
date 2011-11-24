<?php

class Auth_Form_Login extends Zend_Form
{

    public function init()
    {
    // initialize form
		$this->setAction('/sandbox/example/form')
			->setMethod('post');
		
	// create text input for name
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('First name:')
			->setOptions(array('id' => 'fname'));
			
	// create password input
		$pass = new Zend_Form_Element_Password('pass');
		$pass->setLabel('Password:')
			->setOptions(array('id' => 'upass'));
		
	// attach elements to form
		$this->addElement($name)
			->addElement($pass);

    }


}

