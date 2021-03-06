<?php

App::uses('AppController', 'Controller');

class TagsController extends AppController
{
	public $helpers = array('Html', 'Form');
	public $name = 'Tags';

	function index()
	{
		if (empty($this->request->data)) {
			$this->set('tags', $this->Tag->query("SELECT * FROM tags"));
		} else {
			$key = $this->request->data['Search']['key'];
			$this->set('tags', $this->Tag->query("SELECT * FROM tags WHERE nome ILIKE '%$key%'"));
		}
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
				$this->Flash->success(__('Tag salva com sucesso!'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	function delete($id)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$tag = $this->Tag->findById($id);
		if ($this->Tag->delete($id)) {
			$this->Tag->query("DELETE FROM posts_tags WHERE tag_id=$id");
			$this->Flash->success('A tag ' . $tag['Tag']['nome'] . ' foi deletada.');
			$this->redirect(array('action' => 'index'));
		}
	}

}
