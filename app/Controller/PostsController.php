<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController
{
	public $helpers = array('Html', 'Form');
	public $name = 'Posts';
	function busca_avancada($id=null)
	{
		$user_id=$this->Auth->User('id');
		if($id){
			$tag=$this->Post->Tag->findAllById($id);
			$posts=$tag[0]['Post'];
			$this->set('posts', $posts);
		}else {
			$data = $this->request->data;
			if (empty($data)) {
				$posts = [];
				$this->set('posts', $posts);
			} else if (!empty($data['Tags'])) {
				$tags = $this->Post->Tag->findAllById($data['Tags']);
				$posts = array();
				if(!empty($data['myposts'])) {
					foreach ($tags as $tag) {
						foreach ($tag['Post'] as $tagged_post) {
							if ($tagged_post['user_id'] == $user_id) {
								$posts[] = $tagged_post;
							}
						}
					}
				}else {
					foreach ($tags as $tag) {
						$posts = array_merge($posts, $tag['Post']);
					}
				}
				$inclusive = [];
				$exclusive = [];
				foreach ($posts as $v) {
					if (!isset($inclusive[$v['id']])) {
						$inclusive[$v['id']] = $v;
					} else {
						$exclusive[$v['id']] = $v;
					}
				}
				if ($data['SearchType'] == 1) {
					$posts = array_values($inclusive);

				} else {
					$posts = array_values($exclusive);
				}
				if (empty($data['Search']['key'])) {
					$result = [];
					$c = 0;
					foreach ($posts as $p) {
						if (date("Y-m-d", strtotime($data['before'])) <= date("Y-m-d", strtotime($p['created'])) && date("Y-m-d", strtotime($p['created'])) <= date("Y-m-d", strtotime($data['after']))) {
							$result[] = $p;
						}
						$c++;
					}
					$this->set('posts', $result);
				} else {
					$key = $data['Search']['key'];
					$search = $this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%'");
					$result = [];
					foreach ($search as $s) {
						foreach ($posts as $p) {
							if (!empty($p) && $s[0]['id'] == $p['id'] && date("Y-m-d", strtotime($data['before'])) <= date("Y-m-d", strtotime($s[0]['created'])) && date("Y-m-d", strtotime($s[0]['created'])) <= date("Y-m-d", strtotime($data['after']))) {
								$result[] = $s;

							}
						}
					}
					$this->set('posts', array_column($result, 0));
				}
			} else {
				if (empty($data['Search']['key'])) {
					$search = $this->Post->query("SELECT * FROM posts ");
				} else {
					$key = $data['Search']['key'];
					$search = $this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%'");
				}
				$result = [];
				$result = $this->getPosts($data, $search, $user_id, $result);
				$this->set('posts', array_column($result, 0));
			}
		}
		$this->set('posts_tags', $this->Post->query("SELECT * FROM posts_tags"));
		$this->set('tags', $this->Post->Tag->query("SELECT * FROM tags"));
	}

	function index($id=null)
	{
		if($id){
			$tag=$this->Post->Tag->findAllById($id);
			$posts=$tag[0]['Post'];
			$this->set('posts', $posts);
		}else {
			$data = $this->request->data;
			if (empty($data['Search']['key'])) {
				$posts=$this->Post->query("SELECT * FROM posts");
				$this->set('posts', array_column($posts,0) );
			} else {
				$key = $data['Search']['key'];
				$posts = $this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%'");
				$this->set('posts', array_column($posts,0) );
			}

		}
		$this->set('posts_tags', $this->Post->query("SELECT * FROM posts_tags"));
		$this->set('tags', $this->Post->Tag->query("SELECT * FROM tags"));
	}
	function posted($id=null)
	{
		$user_id=$this->Auth->User('id');
		if($id){
			$tag=$this->Post->Tag->findAllById($id);
			$posts=$tag[0]['Post'];
			$this->set('posts', $posts);
		}else {
			if (empty($data['Search']['key'])) {
				$posts=$this->Post->query("SELECT * FROM posts WHERE user_id=$user_id");
				$this->set('posts', array_column($posts,0) );
			} else {
				$key = $this->request->data['Search']['key'];
				$posts=$this->Post->query("SELECT * FROM posts WHERE title ILIKE '%$key%' AND user_id=$user_id");
				$this->set('posts', array_column($posts,0));
			}
		}
		$this->set('posts_tags', $this->Post->query("SELECT * FROM posts_tags"));
        $this->set('tags', $this->Post->Tag->query("SELECT * FROM tags"));
	}

	public function isAuthorized($user)
	{
		// All registered users can add posts
		if ($this->request->action === 'add' || $this->request->action === 'posted') {
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
		$post = $this->Post->findById($id);
		if ($this->Post->delete($id)) {
			$this->Post->query("DELETE FROM posts_tags WHERE post_id=$id");
			$this->Flash->success('O post ' . $post['Post']['title']  . ' foi deletado.');
			$this->redirect(array('action' => 'index'));
		}
	}

	/**
	 * @param array $data
	 * @param $search
	 * @param $user_id
	 * @param array $result
	 * @return array
	 */
	public function getPosts(array $data, $search, $user_id, array $result): array
	{

		if (!empty($data['myposts'])) {
			foreach ($search as $s) {
				if ($s[0]['user_id'] == $user_id) {
					$result[] = $s;
				}
			}
		} else {
			foreach ($search as $s) {

				if (date("Y-m-d", strtotime($data['before'])) <= date("Y-m-d", strtotime($s[0]['created'])) && date("Y-m-d", strtotime($s[0]['created'])) <= date("Y-m-d", strtotime($data['after']))) {
					$result[] = $s;
				}
			}
		}
		return $result;
	}
}
