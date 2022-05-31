<?php

App::uses('AppModel', 'Model');

class Post extends AppModel
{
	public $name = 'Post';

	public $validate = array(
		'title' => array(
			'rule' => 'notBlank'
		),
		'body' => array(
			'rule' => 'notBlank'
		),
		'tags' => array(
			'notEmpty' => array(
				'rule' => array('multiple', array('min' => 1)),
				'required' => true,
				'message'  => 'Por favor escolha pelo menos uma tag!'
			))
	);

	public function isOwnedBy($post, $user)
	{
		return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
	}
}
