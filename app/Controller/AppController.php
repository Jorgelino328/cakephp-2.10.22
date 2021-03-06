<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	public $components = array(
		'Flash',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'posts',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'posts',
				'action' => 'index',
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			),
			'authorize' => array('Controller'),
		)
	);

	public function beforeFilter()
	{
		$this->Auth->allow('index','busca_avancada');
	}

	public function beforeRender()
	{

		/*if (!$this->request->is('post')) {
			// restore autosave data for the current url if no form is posted
			$this->request->data = $this->AutosaveComponent->restore($this->request->here);
		} else {
			// form is posted; flush the autosave data for the current URL
			$this->AutosaveComponent->flush($this->request->here);
		}*/

		$this->loadModel('Tag');
        $this->set('tags', $this->Tag->query("SELECT * FROM tags"));
	}

	public function isAuthorized($user)
	{
		// Admin can access every action
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}


		// Default deny
		return false;
	}


}
