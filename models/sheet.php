<?php
class Sheet extends AppModel {
	var $belongsTo = array('User');
	var $actsAs = array('Search.Searchable', 'Tags.taggable');
	
	var $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'タイトルを入力してください。'
			)
		)
	);
	
	var $displayField = 'text';
	var $filterArgs = array(
		array('name' => 'text', 'type' => 'like'),
		array('name' => 'tags', 'type' => 'subquery', 'method' => 'findByTags', 'field' => 'Sheet.id')
	);

	var $fields = array(
		'add' => array('user_id', 'title', 'text', 'method', 'tags'),
		'edit' => array('title', 'text', 'method', 'tags')
	);
	var $methods = array('標準', 'はてな記法', 'Wiki記法', 'Markdown記法');
	
	function findByTags($data = array()) {
		$this->Tagged->Behaviors->attach('Containable', array('autoFields' => false));
		$this->Tagged->Behaviors->attach('Search.Searchable');
		$query = $this->Tagged->getQuery('all', array(
			'conditions' => array('Tag.name'  => $data['tags']),
			'fields' => array('foreign_key'),
			'contain' => array('Tag')
		));
		return $query;
	}
}