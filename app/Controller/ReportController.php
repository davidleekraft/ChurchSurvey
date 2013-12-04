<?php
class ReportController extends AppController
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
		$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
		if(!in_array($this->Session->read('User.UserType'), $users_allowed))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		
	}
	//This function loads information of all users for use in view to report by user name
	public function findMember()
	{
		$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
		if(!in_array($this->Session->read('User.UserType'), $users_allowed))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		$this ->loadModel('Member');
		
		$this->set('title_for_layout', 'Find Member');
		$this->set('members', $this->Member->find('all'));
		
	}
	//This function loads information of all users for use in view to report by user name
	public function skillsReport()
	{
		$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
		if(!in_array($this->Session->read('User.UserType'), $users_allowed))
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		$this ->loadModel('Choice');
		$this ->loadModel('Status');
		
		$this->set('title_for_layout', 'Report By Skills');
		$this->set('choices', $this->Choice->find('all'));
		
		$this->set('memberTypes', $this->Status->find('list'));
		
		
	}

	//Function loads the page with report by skills	
	public function report_by_skills()
	{
			$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
			if(!in_array($this->Session->read('User.UserType'), $users_allowed))
			{
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			
			$this->loadModel('Member');
			$this->loadModel('Choice');
			$this->loadModel('SurveyAnswer');
			
			$this->set('title_for_layout', 'Report By Skills');
			
			//get chosen skills
			$gifts = $this->params['url']['gifts'];
			$compSkills = $this->params['url']['compSkills'];
			$others = $this->params['url']['Others'];
			
			//get constituents
			$constituents =  $this->params['url']['Constituents'];
			
			//get date, when report was changed
			$updated =  $this->params['url']['updated'];
			$show_date = $updated; //store user friendly format of date in $show_date
			
			//formate $updated to match the format of database
			if($updated)
			{
				list($month, $day, $year) = split("/", $updated);
				$updated = $year . "-" . $month . "-" . $day . " 00:00:00";
			}
			
			//Check if user selected any skills in three lists
			if($gifts || $compSkills || $others)
			{
				//if no skills were chosen,  to previous page and show error message
				if(!($constituents))
				{
					$this->Session->setFlash('You should chose constituent(s) to get a report');
					$this->redirect(array('action' => 'skillsReport'));
				}
				
				//merge arrays of params which we GOT to this function
				$result = array_merge((array)$gifts, (array)$compSkills);
				$result = array_merge((array)$result, (array)$others);
				
				//get full info about chosen skills
				$skills = $this->Choice->find('all', array('conditions' => array('Choice.ChoiceID' => $result)));
				$choices = $this->SurveyAnswer->find('all');
				
				//find members who posses chosen skills
				$membersWithSkills = array();
				foreach ($choices as $choice)
				{
					if(!in_array($choice['SurveyAnswer']['MemberID'],  $membersWithSkills) && in_array($choice['SurveyAnswer']['ChoiceID'], $result))
					$membersWithSkills[] = $choice['SurveyAnswer']['MemberID'];	
				}
				
				//Create a user readable list of skills chosed by user
				$sklills_text = "<h4>Members with skills: ";
				for ($i = 0;$i < count($skills);$i++)
				{
					$sklills_text .= $skills[$i]['Choice']['Text'];
					if($i != (count($skills) - 1))
						$sklills_text .= ", ";
				}
				$sklills_text .= "</h4>";
				if($updated)
				{
					$sklills_text .=  "<h4>Surveys since: " . $show_date . "</h4>";
					$members = $this->Member->find('all', array('conditions' => array('Member.MemberID' => $membersWithSkills, 
																					  'Member.StatusID' => $constituents,
																					  'Member.SurveyUpdated >=' => $updated), 
																	 'order' => array('Member.SurveyUpdated' => 'asc')));
				}
				else
				{
					$members = $this->Member->find('all', array('conditions' => array('Member.MemberID' => $membersWithSkills, 'Member.StatusID' => $constituents), 
																	   'order' => array('Member.SurveyUpdated' => 'asc')));
				}
				//if no members with chosen skills were found, show the error message and redirect to previous page
				if(!$members)
				{
					$this->Session->setFlash('Nobody was found with chosen skill(s): ' . $sklills_text);
					$this->redirect(array('action' => 'skillsReport'));
				}
				
				$this->set('members', $members);
				$this->set('chosen_skills', $result); 				//set all id's of chosen skills in order to highlite them in report
				$this->set('choices', $this->SurveyAnswer->find('all', array('conditions' => array('SurveyAnswer.MemberID' => $membersWithSkills))));
				$this->set('skills', $sklills_text);                //send the formatted list of skills  to the view
				
				//variables which will be used in the view to be passed as "GET" arguments
				//we need to serialize it here in order to save data of arrays to pass them in generate pdf
				$gift = serialize($gifts);
				$comp = serialize($compSkills);
				$other = serialize($others);
				$cons = serialize($constituents);
				$uptd = serialize($updated);
				$this->set('gift', $gift);
				$this->set('comp', $comp);
				$this->set('other', $other);
				$this->set('cons', $cons);
				$this->set('uptd', $uptd);
			}
			else
			{
				$this->Session->setFlash('You should chose skill(s), you would like to get report for');
				$this->redirect(array('action' => 'skillsReport'));
			}
	}

	
	//Function loads the page with report by skills	
	public function view_skills_pdf()
	{
			$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
			if(!in_array($this->Session->read('User.UserType'), $users_allowed))
			{
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			$this->loadModel('Member');
			$this->loadModel('Choice');
			$this->loadModel('SurveyAnswer');
			
			$this->set('title_for_layout', 'Report By Skills');
			
			
		//get chosen skills
			$gift = $this->params['url']['gift'];
			$comp = $this->params['url']['comp'];
			$other = $this->params['url']['other'];
			
			$gifts = unserialize($gift);
			$compSkills = unserialize($comp);
			$others = unserialize($other);
			//get constituents
			$cons =  $this->params['url']['cons'];
			//get date, when report was changed
			$uptd =  $this->params['url']['uptd'];
			
			$constituents = unserialize($cons);
			$updated = unserialize($uptd);
			$show_date = $updated; //store user friendly format of date in $show_date
			//formate $updated to match the format of database
			/*if($updated)
			{
				list($month, $day, $year) = split("/", $updated);
				$updated = $year . "-" . $month . "-" . $day . " 00:00:00";
			}*/
			
			//Check if user selected any skills in three lists
			if($gifts || $compSkills || $others)
			{
				//if no skills were chosen, redirect to previous page and show error message
				if(!($constituents))
				{
					$this->Session->setFlash('You should chose constituent(s) to get a report');
					$this->redirect(array('action' => 'skillsReport'));
				}
				
				//merge arrays of params which we GOT to this function
				$result = array_merge((array)$gifts, (array)$compSkills);
				$result = array_merge((array)$result, (array)$others);
				
				//get full info about chosen skills
				$skills = $this->Choice->find('all', array('conditions' => array('Choice.ChoiceID' => $result)));
				$choices = $this->SurveyAnswer->find('all');
				
				//find members who posses chosen skills
				$membersWithSkills = array();
				foreach ($choices as $choice)
				{
					if(!in_array($choice['SurveyAnswer']['MemberID'],  $membersWithSkills) && in_array($choice['SurveyAnswer']['ChoiceID'], $result))
					$membersWithSkills[] = $choice['SurveyAnswer']['MemberID'];	
				}
				
				//Create a user readable list of skills chosed by user
				$sklills_text = '<h2 style="text-align:center">Members with skills:</h2>';
				for ($i = 0;$i < count($skills);$i++)
				{
					$sklills_text .= "<span>" . $skills[$i]['Choice']['Text'];
					if($i != (count($skills) - 1))
						$sklills_text .= ", </span>";
				}
				$sklills_text .= "</h2>";
				if($updated)
				{
					$sklills_text .=  '<h2 style="text-align:center">Surveys since: ' . $show_date . "</h2>";
					$members = $this->Member->find('all', array('conditions' => array('Member.MemberID' => $membersWithSkills, 
																					  'Member.StatusID' => $constituents,
																					  'Member.SurveyUpdated >=' => $updated), 
																	 'order' => array('Member.SurveyUpdated' => 'asc')));
				}
				else
				{
					$members = $this->Member->find('all', array('conditions' => array('Member.MemberID' => $membersWithSkills, 'Member.StatusID' => $constituents), 
																	   'order' => array('Member.SurveyUpdated' => 'asc')));
				}
				//if no members with chosen skills were found, show the error message and redirect to previous page
				if(!$members)
				{
					$this->Session->setFlash('Nobody was found with chosen skill(s): ' . $sklills_text);
					$this->redirect(array('action' => 'skillsReport'));
				}
				$this->set('members', $members);
				$this->set('chosen_skills', $result); 				//set all id's of chosen skills in order to highlite them in report
				$this->set('choices', $this->SurveyAnswer->find('all', array('conditions' => array('SurveyAnswer.MemberID' => $membersWithSkills))));
				$this->set('skills', $sklills_text);                //send the formatted list of skills  to the view
				
				//veriables which will be used in the view to be passed as "GET" arguments
				//we need to serialize it here in order to save data of arrays
				$gift = serialize($gifts);
				$comp = serialize($compSkills);
				$other = serialize($others);
				$this->set('gift', $gift);
				$this->set('comp', $comp);
				$this->set('other', $other);
			}
			else
			{
				$this->Session->setFlash('You should chose skill(s), you would like to get report for');
				$this->redirect(array('action' => 'skillsReport'));
			}
			
			//This part is required to create pdf for the individual report
			Configure::write('debug',0); // Otherwise we cannot use this method while developing

			$this->layout = 'pdf'; //this will use the pdf.ctp layout
			$this->render();
	}
	
	//Generates a report for chosen person
	public function individual_report()
	{
			$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
			if(!in_array($this->Session->read('User.UserType'), $users_allowed))
			{
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			$id = $this->params['url']['selected_person'];
			$this->set('title_for_layout', 'Individual Report');
			$this->loadModel('Member');
			$this->loadModel('Section');
			$this->loadModel('SurveyAnswer');
			
			list($id) = split ('--',$id);
			
			$this->set('members', $this->Member->find('all', array('conditions' => array('Member.MemberID' => $id))));
			$choices = $this->SurveyAnswer->find('all', array('conditions' => array('SurveyAnswer.MemberID' => $id)));
			$sections = $this->Section->find('all');
			$this->set('choices', $choices); 
			$this->set('sections', $sections); 
	}
	
	//function that generates individual report in pdf Format
   function viewPdf()
    {
			$users_allowed = array("ADMIN", "COMMITTEE CHAIR");
			if(!in_array($this->Session->read('User.UserType'), $users_allowed))
			{
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			$id = $this->params['url']['selected_person'];
			$this->set('title_for_layout', 'Individual Report');
			$this->loadModel('Member');
			$this->loadModel('Section');
			$this->loadModel('SurveyAnswer');
			
			list($id) = split ('--',$id);
			
			$this->set('members', $this->Member->find('all', array('conditions' => array('Member.MemberID' => $id))));
			$choices = $this->SurveyAnswer->find('all', array('conditions' => array('SurveyAnswer.MemberID' => $id)));
			$sections = $this->Section->find('all');
			$this->set('choices', $choices); 
			$this->set('sections', $sections);

			//This part is required to create pdf for the individual report
			Configure::write('debug',0); // Otherwise we cannot use this method while developing

			$this->layout = 'pdf'; //this will use the pdf.ctp layout
			$this->render();
    } 
}
?>