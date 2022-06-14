<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController
{
	public $helpers = array('Html', 'Form');
	public $name = 'Posts';
	function busca_avancada()
	{
		$data=$this->request->data;
		if(!empty($data['Tags'])){
			if (empty($data['Search']['key'])) {
				$tag_ids=$data['Tags'];
				$post_ids=array();
				foreach($tag_ids as $tag_id){
					array_push($post_ids,array_values($this->Post->query("SELECT post_id FROM posts_tags WHERE tag_id=$tag_id")));
				}
				echo json_encode($post_ids);
				//$posts=$this->Post->findById($post_ids);

				//echo json_encode($posts);
				if($data['SearchType']==1){
					//$this->set('posts', $this->Post->query("SELECT * FROM posts WHERE "));
				}else{
					//$this->set('posts', $this->Post->query("SELECT * FROM posts "));
				}
			}
		}else {
			if (empty($data['Search']['key'])) {
				$this->set('posts', $this->Post->query("SELECT * FROM posts "));
			} else {
				$key = $data['Search']['key'];
				$this->set('posts', $this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%'"));
			}
		}
		$this->set('posts_tags', $this->Post->query("SELECT * FROM posts_tags"));
		$this->set('tags', $this->Post->Tag->query("SELECT * FROM tags"));
	}

	function index()
	{
		$data=$this->request->data;
		if (empty($data['Search']['key'])) {
        			$this->set('posts', $this->Post->query("SELECT * FROM posts "));
		} else {
        			$key = $data['Search']['key'];
        			$this->set('posts', $this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%'"));
		}
		$this->set('posts_tags', $this->Post->query("SELECT * FROM posts_tags"));
		$this->set('tags', $this->Post->Tag->query("SELECT * FROM tags"));
	}
	function my_posts()
	{
		$user_id=$this->Auth->User('id');
		if (empty($data['Search']['key'])) {
			$this->set('posts', $this->Post->query("SELECT * FROM posts WHERE user_id=$user_id"));
		} else {
			$key = $this->request->data['Search']['key'];
			$this->set('posts', $this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%' AND user_id=$user_id"));
		}

		$this->set('posts_tags', $this->Post->query("SELECT * FROM posts_tags"));
        $this->set('tags', $this->Post->Tag->query("SELECT * FROM tags"));
	}

	public function view($id = null)
	{

		if (!$id) {
			throw new NotFoundException(__('Post inválido'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Post inválido'));
		}
		$this->set('post', $post);
	}

	public function isAuthorized($user)
	{
		// All registered users can add posts
		if ($this->request->action === 'add') {
			return true;
		}

		// The owner of a post can edit and delete it
		if (in_array($this->request->action, array('edit', 'delete'))) {
			$postId = (int)$this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}

	public function add()
	{
		$this->set('tags', $this->Post->Tag->query("SELECT * FROM tags "));
		if ($this->request->is('post')) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('Post salvo com sucesso!'));
				$tags_id = $this->request->data['Post']['tags'];
				$post_id = $this->Post->id;
				foreach ($tags_id as $tag_id){
					$this->Post->query("INSERT INTO posts_tags (post_id,tag_id) VALUES ($post_id,$tag_id);");
				}
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	function edit($id = null)
	{
		$this->set('tags', $this->Post->Tag->query("SELECT * FROM tags "));
		if ($this->request->is('get')) {
			$this->request->data = $this->Post->findById($id);
		} else {
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success('Seu post foi atualizado.');
				$tags_id = $this->request->data['Post']['tags'];
				$post_id = $id;
				$this->Post->query("DELETE FROM posts_tags WHERE post_id=$post_id;");
				foreach ($tags_id as $tag_id){
					$this->Post->query("INSERT INTO posts_tags (post_id,tag_id) VALUES ($post_id,$tag_id);");
				}
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	function delete($id)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Post->delete($id)) {

			$this->Post->query("DELETE FROM posts_tags WHERE post_id=$id");
			$this->Flash->success('O post com o id: ' . $id . ' foi deletado.');
			$this->redirect(array('action' => 'index'));
		}
	}
}
