<?php
class UsersController extends AppController {

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Usuário invalido'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Salvo com sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('O usuário não pôde ser salvo . Por favor, tente novamente.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Salvo com sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('O usuário não pôde ser salvo . Por favor, tente novamente.'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário invalido'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('Excluído'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Não foi excluído'));
        $this->redirect(array('action' => 'index'));
    }


    public function login() {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Flash->error(__('Acesso Restrito'));
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }

}
?>