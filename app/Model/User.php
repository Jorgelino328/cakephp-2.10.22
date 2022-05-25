<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
	public $name = 'User';
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório!'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório!'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'author')),
				'message' => 'Por favor escolha uma opção válida!',
				'allowEmpty' => false
			)
		)
	);

	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

}
