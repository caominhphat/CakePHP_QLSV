<?php
    App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	public function login() {
		if ( $this->request->is('post') ) {
			if ( $this->Auth->login() ) {
				return $this->redirect(array('controller'=>'students','action'=>'index'));
				$this->Flash->success(__('Dang nhap thanh cong'));
			} else {
				$this->Flash->error(__('Invalid username or password, try again'));
			}
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if ( !$this->User->exists($id) ) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array(
			     'conditions' => array(
			     	     'User.' . $this->User->primaryKey => $id
				 )
		);
		$this->set( 'user', $this->User->find('first', $options) );
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		// Use Username model in User model to manipulate Username table in User model
		$username = ClassRegistry::init('Username');
		if ( $this->request->is('post') ) {
			// initial transaction
			$dataSource = $this->User->getDataSource();
			$dataSource->begin();
			$this->User->create();
			$userSave = $this->User->save( $this->request->data );
			$name = $this->request->data['User']['username'];
			$userNamesSave = $username->query("INSERT INTO usernames (name) VALUES ('$name') ");
            // Commit if all true, Rollback if one of conditions false
			if ($userSave && !$userNamesSave) {
				$this->Flash->success(__('The user has been saved.'));
				$dataSource->commit();
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
				$dataSource->rollback();
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($iUserId = null) {
		if ( !$this->User->exists($iUserId) ) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ( $this->request->is(array('post', 'put')) ) {
			if ( $this->User->save($this->request->data) ) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array(
				     'conditions' => array(
				     	 'User.' . $this->User->primaryKey => $iUserId
					 )
			);
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($iUserId = null) {
		if ( !$this->User->exists($iUserId) ) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');

		// Check if role of want-to-delete user is admin, so cannot delete
		$aCheckUserRole = $this->User->find('all',array('conditions'=>array('User.id' => $iUserId)));
		if($aCheckUserRole[0]['User']['role'] == 'admin'){
			$this->Flash->error(__('You do not have authorization to delete another admin'));
		} elseif ($this->User->delete($iUserId)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
