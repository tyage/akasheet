<?php
class SheetsController extends AppController {
	var $helpers = array('Text');
	var $components = array('Search.Prg', 'Security', 'Securimage');
	var $presetVars = array(
		array('field' => 'text', 'type' => 'value')
	);
	var $paginate = array(
		'limit' => 5,
		'order' => 'Sheet.created DESC',
		'fields' => array('Sheet.*', 'User.id', 'User.username')
	);
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Security->requireAuth('add');
		$this->Auth->deny('delete', 'edit');
	}
	
    function captcha() {
        $this->Securimage->render();
    }

	function add() {
		if (!empty($this->data)) {
			if (!$this->Securimage->checkCaptcha($this->data['Sheet']['captcha'])) {
				$this->flash('Captchaが間違っています', '/');
				return;
			}
			
			$userId = $this->Auth->user('id');
			if ($userId) {
				$this->data['Sheet']['user_id'] = $userId;
			}
			
			$this->forceCreate('Sheet');
			if ($this->Sheet->save($this->data, true, $this->Sheet->fields['add'])) {
				$id = $this->Sheet->getLastInsertID();
				$this->redirect('/sheets/view/'.$id);
			}
		}
		
		$methods = $this->Sheet->methods;
		$this->set(compact('methods'));
	}
	function fork($id) {
		$this->data = $this->Sheet->findById($id);
		$this->data['Sheet']['title'] = 'フォーク - '.$this->data['Sheet']['title'];
		$methods = $this->Sheet->methods;
		$this->set(compact('methods'));
		$this->render('/sheets/add/');
	}
	function delete($id) {
		$sheet = $this->Sheet->findById($id);
		if ($sheet['User']['id'] === $this->Auth->user('id') and 
			$this->Sheet->delete($id)) {
			$this->redirect('/');
		}
	}
	function edit($id) {
		if (empty($id)) {
			$id = $this->data['Sheet']['id'];
		}
		
		$sheet = $this->Sheet->findById($id);
		if ($sheet['User']['id'] !== $this->Auth->user('id')) {
			$this->redirect('/sheets/view/'.$id);
		}
		
		if (!empty($this->data)) {
			$this->Sheet->id = $id;
			if ($this->Sheet->save($this->data, true, $this->Sheet->fields['edit'])) {
				$this->redirect('/sheets/view/'.$id);
			}
		} else {
			$this->data = $sheet;
		}
		
		$methods = $this->Sheet->methods;
		$title_for_layout = 'シートの編集';
		$this->set(compact('methods', 'title_for_layout'));
	}
	function view($id) {
		$condition = array(
			'conditions' => array(
				'Sheet.id' => $id
			),
			'fields' => array('Sheet.*', 'User.id', 'User.username')
		);
		$sheet = $this->Sheet->find('first', $condition);
		if (empty($sheet)) {
			$this->redirect('/');
		}
		
		$data = array(
			'Sheet' => array('view' => ++$sheet['Sheet']['view'])
		);
		$this->Sheet->save($data);
		
		$title_for_layout = $sheet['Sheet']['title'];
		$this->set(compact('sheet', 'title_for_layout'));
	}
	function index() {
		if (!empty($this->passedArgs['tags'])) {
			$title_for_layout = 'タグ検索 - '.$this->passedArgs['tags'];
		} elseif (!empty($this->passedArgs['text'])) {
			$title_for_layout = '本文検索 - '.$this->passedArgs['text'];
		} else {
			$title_for_layout = '最近の投稿';
		}
		
		$this->Prg->commonProcess();
		$conditions = $this->Sheet->parseCriteria($this->passedArgs);
		$sheets = $this->paginate('Sheet', $conditions);
		if (!empty($this->data['Sheet']['text'])) {
			$search = $this->data['Sheet']['text'];
		}
		$this->set(compact('sheets', 'title_for_layout', 'search'));
	}
}
