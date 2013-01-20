<?php

App::uses('AppController', 'Controller');

/**
 * Answers Controller
 *
 * @property Answer $Answer
 */
class AnswersController extends AppController {

    public $helpers = array('CreateAnswers');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        throw new NotFoundException();
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        throw new NotFoundException();
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            //find user
            $user = $this->Answer->User->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'email' => $this->request->data['Answer']['email']
                    )));
            if (!$user) {
                $user = array();
                $user['name'] = $this->request->data['Answer']['name'];
                $user['email'] = $this->request->data['Answer']['email'];
                $this->Answer->User->create();
                $user = $this->Answer->User->save($user);
                if (!$user) {
                    $array = $this->Answer->User->invalidFields();
                    foreach ($array as $key => $value) {
                        $this->Session->setFlash($value[0]);
                    }
                    $this->redirect(array('action' => 'add'));
                }
            }
            //find question

            $question = $this->Answer->User->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'id' => $this->request->data['Answer']['question_id']
                    )));
            if (!$question) {
                $this->Session->setFlash(__('The question does not exist or has been disabled'));
                $this->redirect('/');
            }

            $this->request->data['Answer']['user_id'] = $user['User']['id'];

            $this->Answer->create();
            if ($this->Answer->save($this->request->data)) {
                $this->Session->setFlash(__('The answer has been saved'));
                $this->redirect('/questions/' . $this->request->data['Answer']['question_id']);
            } else {
                $this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
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
    public function edit($id = null) {
        throw new NotFoundException();
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        throw new NotFoundException();
    }

}
