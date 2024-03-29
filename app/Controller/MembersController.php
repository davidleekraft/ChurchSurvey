<?php
class MembersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		
		
	}
	
	public $helpers = array('Html', 'Form');
	
	public function index() {
	
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	
		if(!$this->Session->check('Member.MemberID'))
		{
			$this->redirect(array('controller' => 'members', 'action' => 'select'));
		}
		else
		{
			$this->redirect(array('controller' => 'members', 'action' => 'display'));
		}
	}

	public function add() {
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		
		$this->loadmodel('Member');
		
		if($this->request->is('post'))
		{	
					$dateTime = date("Y-m-d H:i:s");
					
					$FName = $this->data['MemberAdd']['FName'];
					$LName = $this->data['MemberAdd']['LName'];
					$ParentFName = $this->data['MemberAdd']['ParentFName'];
					$ParentLName = $this->data['MemberAdd']['ParentLName'];
					$Address = $this->data['MemberAdd']['Address'];
					$CellPhone = $this->data['MemberAdd']['CellPhone'];
					$HomePhone = $this->data['MemberAdd']['HomePhone'];
					$WorkPhone = $this->data['MemberAdd']['WorkPhone'];
					$Text = $this->data['MemberAdd']['TextMessage'];
					$Email = $this->data['MemberAdd']['Email'];
					$Gender = $this->data['MemberAdd']['Gender'];
					$StatusID = $this->data['MemberAdd']['Status'];
					
					$insertQuery = $this->Member->query("INSERT INTO Members(FName, LName, 
							ParentFName, ParentLName, Address, CellPhone, HomePhone, WorkPhone,
							Text, Email, Gender, StatusID, SurveyUpdated)
								VALUES ('$FName', '$LName',
								'$ParentFName', '$ParentLName',
								'$Address', '$CellPhone',
								'$HomePhone', '$WorkPhone',
								'$Text', '$Email',
								'$Gender', '$StatusID',
								'$dateTime') ");
					
				
			
			
			$this->redirect(array('controller' => 'members', 'action' => 'select'));	
		}
		
	}
	
	public function thanks() {
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}
	
	//Confirm identity page
	public function confirmIdentity($firstName, $lastName)
	{
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		
		$this->loadModel('Member');
		$conditions = array('recursive' => 1);
		$member = $this->Member->find('all', array('recursive' => 1, 'conditions' => array('Member.LName' => $lastName, 'Member.FName' => $firstName)));
		if($this->request->is('post')) 
		{
			$memberID = $this->request->data('Member.MemberID');
			
			if($this->request->data('Member.MemberID') != null)
			{
				$this->Session->write('Member.MemberID', $this->request->data('Member.MemberID'));
				$this->redirect(array('controller'=>'members', 'action' => 'survey'));
			}

		}
		$this->set('members', $member);
		
		if(count($member) < 1)
		{
			$this->redirect(array('controller'=>'members', 'action' => 'add'));
		}
		
		
	}
	
	public function display() {
	
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	
		$mID = $this->Session->read('Member.MemberID');
		$this->loadmodel('Member');
		$this->set('member', $this->Member->find('first', array('conditions' =>
			array('MemberID' => $mID))));
		
	
	}

	public function survey() {
	
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		
		$this->set('memberID', $this->Session->read('Member.MemberID'));
		$this->loadmodel('SurveyAnswer');
		$this->loadmodel('Section');
		$mID = $this->Session->read('Member.MemberID');
		$conditions = array('recursive' => 1);
		$this->set('sections', $this->Section->find('all', $conditions));
		$sectionIDs[] = $this->set('sections', $this->Section->find('all', $conditions));
		
		if($this->request->is('post'))
		{
				$deleteQuery = $this->SurveyAnswer->query("DELETE FROM SurveyAnswers
				WHERE MemberID='$mID'");
				
				if(ISSET($_POST['survey']))
				{	
					foreach($_POST['survey'] as $answers)
					{
						if(ISSET($answers))
						{
							$insertQuery = $this->SurveyAnswer->query("INSERT INTO SurveyAnswers(ChoiceID, MemberID)
								VALUES ('$answers', '$mID')");
						}
					}
					
					$dateTime = date("Y-m-d H:i:s");
					$updateTime = $this->Member->query("UPDATE Members
						SET SurveyUpdated='$dateTime'
						WHERE MemberID = $mID");
				}
			
			$this->redirect(array('action' => 'thanks'));
		
		}
		else
		{
			
			$this->loadmodel('Choice');
		
			$conditions = array('recursive' => 1);
			$this->set('choices', $this->Choice->find('all', $conditions));
		
			$this->loadmodel('Member');
		
			$conditions = array('memberID' => $this->Session->read('Member.MemberID'));
			$this->set('members', $this->Member->find('all', $conditions));
		
			
		
			$conditions = array('memberID' => $this->Session->read('Member.MemberID'));
			$this->set('answers', $this->SurveyAnswer->find('all', $conditions));
			
		}
		
	}
	
	/**
	 * Controller for member select form.
	 */
	public function select() {
	
		if("CHURCH MEMBER" != $this->Session->read('User.UserType'))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}

		if($this->request->is('post')) 
		{
			$firstName = $this->request->data('Member.FName');
			$lastName = $this->request->data('Member.LName');
			$memberID = $this->request->data('Member.MemberID');
			
			// If the page was submitted with name information, redirect to confirmIdentity
			if($lastName != null and $firstName != null)
			{
				$this->redirect(array('controller'=>'members', 'action'=>'confirmIdentity', $firstName, $lastName));
			}
			else
			{
				$this->Session->setFlash('Must enter first and last name');
			}
		}
	}
}