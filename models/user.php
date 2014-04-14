<?php
class User extends AppModel {
	var $fields = array(
		'add' => array('username', 'password')
	);
	var $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '名前を入力してください。'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'その名前は既に使われています。'
			)
		)
	);
}