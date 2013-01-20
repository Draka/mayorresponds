<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Answers Controller
 *
 * @property Answer $Answer
 */
class AnswersController extends AppController {

    public $helpers = array('CreateQuestions');
    public $uses = array('Answer', 'Question', 'Vote');

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
    public function view($key = null) {
        if ($key) {
            $answer = $this->Answer->find('first', array(
                'conditions' => array(
                    'Answer.key_confirm' => $key,
                    )));
            if ($answer) {
                unset($answer['Answer']['modified']);
                $answer['Answer']['confirm'] = true;
                $answer['Answer']['key_confirm'] = null;
                $this->Answer->save($answer);
                $this->Session->setFlash(__('The Answer has been confimed'));
                $this->redirect('/questions/' . $answer['Answer']['question_id']);
            } else {
                $this->Session->setFlash(__('The answer does not exist or has been confirmed'));
                $this->redirect('/');
            }
        }
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
            $answer = $this->Answer->save($this->request->data);
            if ($answer) {
                $email = new CakeEmail();
                $email->from(array('alert@' . DOMAIN => 'Mayor Responds'));
                $email->replyTo('no-reply@' . DOMAIN, 'Mayor Responds - No reply');
                $email->to($user['User']['email'], $user['User']['name']);
                $email->subject('Confirm answer, please');
                $email->send('Please confirm your answer in the url: ' . SITE . 'answer/' . $answer['Answer']['key_confirm']);

                $this->Session->setFlash(__('The answer has been saved, please check your email to confirm.'));
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

    public function plus($id = null) {
        $this->vote($id, 1, 0);
    }

    public function minus($id = null) {
        $this->vote($id, 0, 1);
    }

    private function vote($id = null, $plus = 1, $minus = 0) {
        $answer = $this->Answer->find('first', array(
            'conditions' => array(
                'Answer.id' => $id,
                'Answer.active' => true,
                'Answer.confirm' => true,
                )));
        if (!$answer) {
            $this->Session->setFlash(__('The answer does not exist or has been disabled'));
            $this->redirect('/');
        }
        $question = $this->Question->find('first', array(
            'conditions' => array(
                'Question.id' => $id,
                'Question.active' => true,
                'Question.confirm' => true,
                )));
        if (!$question) {
            $this->Session->setFlash(__('The question does not exist or has been disabled'));
            $this->redirect('/');
        }

        $this->set('answer', $answer['Answer']);
        $this->set('question', $question);

        if ($this->request->is('post')) {
            //find user
            $user = $this->Question->User->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'email' => $this->request->data['Vote']['email']
                    )));
            if (!$user) {
                $user = array();
                $user['name'] = $this->request->data['Vote']['name'];
                $user['email'] = $this->request->data['Vote']['email'];
                $this->Question->User->create();
                $user = $this->Question->User->save($user);
                if (!$user) {
                    $array = $this->Question->User->invalidFields();
                    foreach ($array as $key => $value) {
                        $this->Session->setFlash($value[0]);
                    }
                    $this->redirect(array('action' => 'add'));
                }
            }
            $vote = $this->Vote->find('first', array(
                'conditions' => array(
                    'Vote.answer_id' => $id,
                    'Vote.user_id' => $user['User']['id'],
                    )));
            if ($vote) {
                $this->Session->setFlash(__('You already vote this answer.'));
                $this->redirect('/' . ($plus ? 'plus' : 'minus') . '/' . $id);
            }

            $this->request->data['Vote']['user_id'] = $user['User']['id'];
            $this->request->data['Vote']['answer_id'] = $id;
            if ($plus) {
                $this->request->data['Vote']['vote_plus'] = 1;
            }else{
                $this->request->data['Vote']['vote_minus'] = 1;
            }

            $this->Vote->create();
            $vote = $this->Vote->save($this->request->data);
            if ($vote) {
                if (empty($vote['Question']['confirm'])) {
                    $email = new CakeEmail();
                    $email->from(array('alert@' . DOMAIN => 'Mayor Responds'));
                    $email->replyTo('no-reply@' . DOMAIN, 'Mayor Responds - No reply');
                    $email->to($user['User']['email'], $user['User']['name']);
                    $email->subject('Confirm vote, please');
                    $email->send('Please confirm your vote in the url: ' . SITE . 'vote/' . $vote['Vote']['key_confirm']);

                    $this->Session->setFlash(__('The vote has been received, check your email to confirm.'));
                    $this->redirect('/questions/' . $answer['Answer']['question_id']);
                } else {
                    if ($plus) {
                        $this->Answer->updateAll(
                                array('Answer.vote_plus' => 'Answer.vote_plus + 1', 'Answer.modified' => 'NOW()'), array('Answer.id' => $id)
                        );
                    } else {
                        $this->Answer->updateAll(
                                array('Answer.vote_minus' => 'Answer.vote_minus + 1', 'Answer.modified' => 'NOW()'), array('Answer.id' => $id)
                        );
                    }
                    $this->Session->setFlash(__('The vote has been saved.'));
                    $this->redirect('/' . ($plus ? 'plus' : 'minus') . '/' . $id);
                }
            } else {
                $this->Session->setFlash(__('The support could not be saved. Please, try again.'));
            }
        }
    }

    public function vote_key($key = null) {
        if ($key) {
            $vote = $this->Vote->find('first', array(
                'conditions' => array(
                    'Vote.key_confirm' => $key,
                    )));
            if ($vote) {
                unset($vote['Vote']['modified']);
                $vote['Vote']['confirm'] = true;
                $vote['Vote']['key_confirm'] = null;
                $this->Vote->save($vote);
                if ($vote['Vote']['vote_plus']) {
                    $this->Answer->updateAll(
                            array('Answer.vote_plus' => 'Answer.vote_plus + 1', 'Answer.modified' => 'NOW()'), array('Answer.id' => $vote['Vote']['answer_id'])
                    );
                } else {
                    $this->Answer->updateAll(
                            array('Answer.vote_minus' => 'Answer.vote_minus + 1', 'Answer.modified' => 'NOW()'), array('Answer.id' => $vote['Vote']['answer_id'])
                    );
                }
                $this->Session->setFlash(__('The vote has been confimed'));
                $this->redirect('/questions/' . $vote['Answer']['question_id']);
            } else {
                $this->Session->setFlash(__('The vote does not exist or has been confirmed'));
                $this->redirect('/');
            }
        }
        throw new NotFoundException();
    }

}
