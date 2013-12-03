<?php
/**
 * Chair Controller
 *
 * Responsible for Chair portion of project
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html
 */
 
class ChairController extends AppController	{

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
	
	//Generates Printable Survey
	public function printable()
	{
         if("COMMITTEE CHAIR" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		
		$this->loadmodel('Section');
		$conditions = array('recursive' => 1);
		$this->set('sections', $this->Section->find('all', $conditions));
		$this->loadmodel('Choice');
		$conditions = array('recursive' => 1);
		$this->set('choices', $this->Choice->find('all', $conditions));
		
		$layout = $this->layout; 
		$this->layout = null; 
		$this->render("printable"); 
		$this->layout = $layout;
		
		
	}
}
