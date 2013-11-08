<?php
class MembersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		
		
	}
	
	public $helpers = array('Html', 'Form');
	
	public function index() {
		if(!$this->Session->check('Member.MemberID'))
		{
			$this->redirect(array('controller' => 'members', 'action' => 'select'));
		}
		else
		{
			$this->redirect(array('controller' => 'members', 'action' => 'survey'));
		}
	}

	public function add() {

	}

	public function survey() {
		$this->set('memberID', $this->Session->read('Member.MemberID'));
		
		$this->loadmodel('Section');
		
		$conditions = array('recursive' => 1);
		$this->set('sections', $this->Section->find('all', $conditions));
		
		$this->loadmodel('Choice');
		
		$conditions = array('recursive' => 1);
		$this->set('choices', $this->Choice->find('all', $conditions));
		
		$this->loadmodel('Member');
		
		$conditions = array('memberID' => $this->Session->read('Member.MemberID'));
		$this->set('members', $this->Member->find('all', $conditions));
		
		$this->loadmodel('SurveyAnswer');
		
		$conditions = array('memberID' => $this->Session->read('Member.MemberID'));
		$this->set('answers', $this->SurveyAnswer->find('all', $conditions));
	}
	
	/**
	 * Controller for member select form.
	 */
	public function select() {
		if($this->request->is('post')) 
		{
			$firstName = $this->request->data('Member.FName');
			$lastName = $this->request->data('Member.LName');
			$memberID = $this->request->data('Member.MemberID');
			
			// If the page was submitted with name information
			// Attempt to find the proper ueser
			if($lastName != null and $firstName != null)
			{
				$member = $this->Member->find('all', array('recursive' => 0, 'conditions' => array('Member.LName' => $lastName, 'Member.FName' => $firstName)));

				if(count($member) == 1)
				{
					// A single member was found with that name.
					// Sets the proper session variables
					$this->Session->write('Member.MemberID', $member[0]['Member']['MemberID']);
					$this->redirect(array('controller'=>'members', 'action' => 'survey'));
				}
				elseif(count($member) > 1)
				{
					// More than one member was found with that name.
					// Return a list for them to select against.
					$this->set('members', $member);
				}
				else
				{
					// The name wasn't found.
					// Display a message to that effect
					//
					// TODO: Create a add member page and link to it here.
					$this->Session->setFlash(__('Unknown member.'));
				}
			}
			elseif($memberID != null)
			{
				// If we have a memberID, set the session
				// and redirect them to the survey.
				$this->Session->write('Member.MemberID', $memberID);
				$this->redirect(array('controller'=>'members', 'action' => 'survey'));
			}
		}
	}
}