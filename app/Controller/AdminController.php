<?php
/**
 * Admin Controller
 *
 * Responsible for Admin portion of project
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html
 */
 
class AdminController extends AppController
	{
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
	
	}
	
	//Generates Printable Survey
	public function printable()
	{
 
		
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
	
	//Report section page, main console for generating reports
	public function reports()
		{
			//Insert code for report controller
		}
	
	//Admin section page, simply loads Section information from database for use in view
    public function sections()
		{  		
		$this->loadModel('Section');
		$this->loadModel('Status');		
		
		$conditions = array('recursive' => 1);
		$this->set('sections', $this->Section->find('all', $conditions));
		$conditions = array('recursive' => 0);
		$this->set('statuses', $this->Status->find('all', $conditions));						
		
		}
	
	//Whenever a section is editted from admin/sections, it redirects to admin/editSections to processes and store the new information
	public function editSections()
		{
				
		
		if ($this->request->is('post') && isset($this->request->data['Section']))
			{
			$this->loadModel('Section');
			$this->loadModel('StatusOfSection');
			
			$statusData = array();
			$statuses = $this->request->data['StatusOfSection'];
			
			//Data based back from Status Checkboxes has to be formatted properly to be put in the database
			foreach($statuses as $status)
				{
				$sectionID = $status['SectionID'];				
				
				if(!empty($status['StatusID']))
					{
					foreach($status['StatusID'] as $statusID)
						{
						array_push($statusData, array('SectionID' => $sectionID, 'StatusID' => $statusID));
						}		
					}
				}
			
			//All statuses are deleted
			$deleteStatus = $this->StatusOfSection->deleteAll(array('1 = 1'), false);
			//All statues are stored
			$saveStatus = 	$this->StatusOfSection->saveAll($statusData);
			//All new section information is saved
			$saveSection = 	$this->Section->saveAll($this->request->data['Section']);			
			
			if ($deleteStatus && $saveStatus && $saveSection)
				{
				$this->Session->setFlash('Sections have been updated');
				$this->redirect(array('action' => 'sections'));
				}			
			}
		else
			{
			$this->redirect(array('action' => 'sections'));
			}
	}
	
	//Action for adding new sections
	public function addSections()
		{
		if ($this->request->is('post') && isset($this->request->data))
			{
			$this->loadModel('Section');
			$saveSection = 	$this->Section->save($this->request->data['Section']);
			
			if ($saveSection)
				{
				$this->Session->setFlash('New Section has been added');
				$this->redirect(array('action' => 'sections'));
				}
			}
		}
	
	//Admin choices page, simply loads Choice information from database for use in view
	//Which coices are displayed depend upon which Section they belong to
	public function choices($sectionID)
		{
		$this->set('sectionID', $sectionID);		
		$this->loadModel('Choice');		
		$choices = $this->Choice->find('all', array('conditions' => array('Choice.SectionID' => $sectionID)));
		$this->set('choices', $choices);	
		
		$this->loadModel('Status');			
		$conditions = array('recursive' => 0);
		$this->set('statuses', $this->Status->find('all', $conditions));
		}
	
	
	//This action is almost identical to admin/editSections
	//Choices of a certain Section are editted, so a SectionID is required
	public function editChoices($sectionID)
		{		
		
		if ($this->request->is('post') && isset($this->request->data['Choice']))
			{
			$this->loadModel('Choice');
			$this->loadModel('StatusOfChoice');			
			
			$statusData = array();
			$statuses = $this->request->data['StatusOfChoice'];
			
			foreach($statuses as $status)
				{
				$choiceID = $status['ChoiceID'];				
				
				if(!empty($status['StatusID']))
					{
					foreach($status['StatusID'] as $statusID)
						{
						array_push($statusData, array('ChoiceID' => $choiceID, 'StatusID' => $statusID));
						}		
					}
				}
				
			$deleteStatus = $this->StatusOfChoice->deleteAll(array('1 = 1'), false);
			$saveStatus = 	$this->StatusOfChoice->saveAll($statusData);
			$saveChoice = 	$this->Choice->saveAll($this->request->data['Choice']);
			
			
			if ($deleteStatus && $saveStatus && $saveChoice)
				{
				$this->Session->setFlash('Choices have been updated');
				$this->redirect(array('action' => 'choices', $sectionID));
				}
			
			}		
		else
			{
			$this->redirect(array('action' => 'choices', $sectionID));
			}
		}
	
	//Action for adding new choices to a specific section
	public function addChoices($sectionID)
		{
		if ($this->request->is('post') && isset($this->request->data))
			{
			$this->loadModel('Choice');
			$saveSection = 	$this->Choice->save($this->request->data['Choice']);
			
			if ($saveSection)
				{
				$this->Session->setFlash('New Choice has been added');
				$this->redirect(array('action' => 'choices', $sectionID));
				}
			}
		}	
	}