<?php

App::uses('AppModel', 'Model');

class Post extends AppModel
{
	public $name = 'Post';

	public $hasAndBelongsToMany =array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'tag_id'
		)
	);
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'post_id'
		)
	);

	public $validate = array(
		'title' => array(
			'rule' => 'notBlank'
		),
		'body' => array(
			'rule' => 'notBlank'
		),
		'tag_list' => array(
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
