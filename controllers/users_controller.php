<?php
class UsersController extends AppController {
	var $uses = array('User', 'Sheet');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('edit', 'delte');
	}
	
	function login() {
		$title_for_layout = 'ログイン';
		$this->set(compact('title_for_layout'));
	}
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	function add() {
		if (!empty($this->data)) {
			$this->forceCreate('User');
			if ($this->User->save($this->data, true, $this->User->fields['add'])) {
				$this->Auth->login($this->data);
				$this->redirect('/');
			}
			$this->data['User']['password'] = '';
		}
		
		$title_for_layout = '新規登録';
		$this->set(compact('title_for_layout'));
	}
	function edit() {
		$id = $this->Auth->user('id');
		if (!empty($this->data)) {
			if (!empty($this->data['User']['password'])) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
			}
			$this->User->id = $id;
			$this->User->save($this->data);
			
			$this->data = $this->User->findById($id);
			$this->Auth->logout();
			$this->Auth->login($this->data);
		} else {
			$this->data = $this->User->findById($id);
		}
		$this->data['User']['password'] = null;
		
		$title_for_layout = '編集';
		$this->set(compact('title_for_layout'));
	}
	function delete() {
		if ($this->User->delete($this->Auth->user('id'), true)) {
			$this->redirect('/');
		}
		$this->redirect($this->Auth->logout());
	}
	function view($id) {
		$this->paginate = array(
			'Sheet' => array(
				'conditions' => array(
					'Sheet.user_id' => $id
				),
				'limit' => 5,
				'order' => 'Sheet.created DESC',
				'fields' => array('Sheet.*', 'User.id', 'User.username')
			)
		);
		$sheets = $this->paginate('Sheet');
		
		$user = $this->User->findById($id);
		$title_for_layout = h($user['User']['username']).'さんのシート';
		
		$this->set(compact('sheets', 'title_for_layout'));
	}
}