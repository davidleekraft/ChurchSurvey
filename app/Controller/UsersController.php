<?php
class UsersController extends AppController {
	public function beforeFilter() {
		// Overloads the AppController but doesn't call it
		// to avoid infinit loop. The UserController
		// needs no authenticaiton because that is what it does.
	}

	public function index() {
		if($this->Session->check('User.UserType'))
		{
			parent::redirectToHome();
		}
		else
		{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}

	public function login() {
		if($this->request->is('post')) {
			$password = $this->request->data('User.password');
			

			$user = $this->User->find('first', array('conditions' => array('User.Password' => $password)));
			

			if(!$user)
			{
				$this->Session->setFlash(__('Invalid password, please try again.'));
			}
			else
			{
				$userType = $user['User']['UserType'];
				$this->Session->write('User.UserType', $userType);
				
				if(strcmp('CHURCH MEMBER', $userType) == 0)
				{
					$this->redirect(array('controller' => 'members', 'action' => 'index'));
				}
				elseif(strcmp('ADMIN', $userType) == 0)
				{
					$this->redirect(array('controller' => 'admin', 'action' => 'index'));
				}
				elseif(strcmp('COMMITTEE CHAIR', $userType) == 0)
				{
					$this->redirect(array('controller' => 'chair', 'action' => 'index'));
				}
				else
				{
					$this->redirect($this->referer(array('action' => 'index')));
				}
			}
		}
	}

	public function logout()
	{
		$this->Session->delete('User.UserType');
		if ($this->Session->check('Member.MemberID') == true){
			$this->Session->delete('Member.MemberID');
		}
		
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}



}
