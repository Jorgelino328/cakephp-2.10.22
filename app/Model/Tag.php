<?php

App::uses('AppModel', 'Model');

class Tag
{
	public $name = 'Tag';

	public $hasAndBelongsToMany =array(
		'Post' => array(
			'className' => 'Post',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'post_id'
		)
	);
}
