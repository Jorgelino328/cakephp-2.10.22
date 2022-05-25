<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController
{

	public function beforeFilter()
	{
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow('add', 'logout');
	}

	public function login()
	{
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Seu nome de usuário e/ou senha estão incorretos!'));
		}
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}

	public function index()
	{
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null)
	{
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->findById($id));
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('Usuário registrado com sucesso!'));
				return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
			}
			$this->Flash->error(
				__('O Usuário não pôde ser registrado! Por favor tente novamente.')
			);
		}
	}

	public function edit($id = null)
	{
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(
				__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null)
	{
		// Prior to 2.5 use
		// $this->request->onlyAllow('post');

		$this->request->allowMethod('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Flash->success(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Flash->error(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
	

}
