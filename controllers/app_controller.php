<?php
class AppController extends Controller{
	var $components = array('Auth', 'RequestHandler');
	var $helpers = array('Html', 'Session', 'Form', 'SheetFormat', 'Javascript', 'Xml');
	
	function beforeFilter() {
		$this->Auth->allow('*');
		$this->set('title_for_layout', false);
	
		if (!empty($this->params['named']['format'])) {
			$this->view = 'Theme';
			switch ($this->params['named']['format']) {
				case 'xml':
					$this->layout = 'xml';
					$this->theme = 'xml';
					break;
				case 'json':
					$this->RequestHandler->setContent('json');
					$this->RequestHandler->respondAs('application/json; charset=UTF-8');
					$this->layout = 'json';
					$this->theme = 'json';
					break;
			}
		}
	}
	function beforeRender() {
		$this->set('Self', $this->Auth->user());
	}
	function forceCreate($model) {
		$this->data[$model]['id'] = null;
		$this->$model->id = false;
	}
}
