<?php

class Auth_UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    public function loginAction()
	{
		$this->_helper->layout()->setLayout('login');
	 	$request = $this->getRequest();  
		$this->view->assign('action', $request->getBaseURL()."/auth/user/auth");  
		$this->view->assign('title', 'Login Form');
		$this->view->assign('username', 'User');	
		$this->view->assign('password', 'Password');	
 	}
 	
	public function authAction(){
		$request 	= $this->getRequest();
		$registry 	= Zend_Registry::getInstance();
		$auth		= Zend_Auth::getInstance(); 
	
		$DB = $registry['DB'];
		
		$authAdapter = new Zend_Auth_Adapter_DbTable($DB);
		$authAdapter->setTableName('users')
	               ->setIdentityColumn('username')
	               ->setCredentialColumn('password');    
	
		// Set the input credential values
		$uname = $request->getParam('username');
		$paswd = $request->getParam('password');
		   $authAdapter->setIdentity($uname);
		   $authAdapter->setCredential(md5($paswd));
		
		   // Perform the authentication query, saving the result
		   $result = $auth->authenticate($authAdapter);
	
	   if($result->isValid()){
		  $data = $authAdapter->getResultRowObject(null,'password');
		  $auth->getStorage()->write($data);
		  $this->_redirect('auth/user/page');
		}else{
		  $this->_redirect('auth/user/login');
		}
	}
	
	public function pageAction(){
	    $auth		= Zend_Auth::getInstance(); 
		
		if(!$auth->hasIdentity()){
		  $this->_redirect('/auth/user/login');
		}
	  
	    $request = $this->getRequest(); 
		$user		= $auth->getIdentity();
		$real_name	= $user->real_name;
		$username	= $user->username;
		$logoutUrl  = $request->getBaseURL().'/auth/user/logout';
	
		$this->view->assign('username', $real_name);
		$this->view->assign('urllogout',$logoutUrl);
	}
	
	public function logoutAction()
	{
	  	$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		$this->_redirect('/auth/user/login');
	}
 
}

