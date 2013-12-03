<?php
/**
 * Admin Controller
 *
 * Responsible for Admin portion of project
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html
 */
 
class AdminController extends AppController	{

	//Helpers used throughout controller
    public $helpers = array('Html', 'Form');	
	
	//Must call parent::beforeFilter() for authentication purposes
	public function beforeFilter()
		{
			parent::beforeFilter();
		}
	
	//Index page exists, but no logic is yet necessary
	public function index()
	{
	    if("COMMITTEE CHAIR" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}
	
	
	//Report section page, main console for generating reports
	public function reports()
		{
			//Insert code for report controller
		}
