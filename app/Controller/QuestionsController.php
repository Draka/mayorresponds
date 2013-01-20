<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

    public $helpers = array('CreateQuestions');
    public $uses = array('Question', 'Support');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Question->recursive = 0;
        $this->set('questions', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $question = $this->Question->find('first', array(
            'conditions' => array(
                'Question.id' => $id,
                'Question.active' => true,
                'Question.confirm' => true,
            ),
                ));
        if (!$question) {
            $this->Session->setFlash(__('The question does not exist or has been disabled'));
            $this->redirect('/');
        }
        $this->set('question', $question);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
//find user
            $user = $this->Question->User->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'email' => $this->request->data['Question']['email']
                    )));
            if (!$user) {
                $user = array();
                $user['name'] = $this->request->data['Question']['name'];
                $user['email'] = $this->request->data['Question']['email'];
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
//find city
            $d_city = json_decode($this->request->data['Question']['city'], true);
//pr($d_city)
            if (!is_array($d_city) || empty($d_city['geonameId'])) {
                $this->Session->setFlash(__('Invalid city'));
                $this->redirect(array('action' => 'add'));
            }

            $city = $this->Question->City->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'geoname_id' => $d_city['geonameId']
                    )));
            if (!$city) {
                $city = array();
                $city['country_name'] = $d_city['countryName'];
                $city['country_code'] = $d_city['countryCode'];
                $city['lat'] = $d_city['lat'];
                $city['lng'] = $d_city['lng'];
                $city['name'] = $d_city['name'];
                $city['fcode'] = $d_city['fcode'];
                $city['geoname_id'] = $d_city['geonameId'];
                $city['admin_name'] = $d_city['adminName1'];
                $city['population'] = $d_city['population'];

                $this->Question->City->create();
                $city = $this->Question->City->save($city);
                if (!$city) {
                    $array = $this->Question->User->invalidFields();
                    foreach ($array as $key => $value) {
                        $this->Session->setFlash($value[0]);
                    }
                    $this->redirect(array('action' => 'add'));
                }
            }

            $this->request->data['Question']['user_id'] = $user['User']['id'];
            $this->request->data['Question']['city_id'] = $city['City']['id'];

//pr ($this->request->data);die;
            $this->Question->create();
            $question = $this->Question->save($this->request->data);
            if ($question) {

                if (empty($question['Question']['confirm'])) {
                    $email = new CakeEmail();
                    $email->from(array('alert@' . DOMAIN => 'Mayor Responds'));
                    $email->replyTo('no-reply@' . DOMAIN, 'Mayor Responds - No reply');
                    $email->to($user['User']['email'], $user['User']['name']);
                    $email->subject('Confirm question, please');
                    $email->send('Please confirm your question in the url: ' . SITE . 'confirm/' . $question['Question']['key_confirm']);

                    $this->Session->setFlash(__('The question has been saved, check your email to confirm.'));
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash(__('The question has been saved.'));
                    $this->redirect('/questions/' . $question['Question']['id']);
                }
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'));
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

    public function support_key($key = null) {
        if ($key) {
            $support = $this->Support->find('first', array(
                'conditions' => array(
                    'Support.key_confirm' => $key,
                    )));
            if ($support) {
                unset($support['Support']['modified']);
                $support['Support']['confirm'] = true;
                $support['Support']['key_confirm'] = null;
                $this->Support->save($support);
                $this->Question->updateAll(
                        array('Question.vote_plus' => 'Question.vote_plus + 1', 'Question.modified' => 'NOW()'), array('Question.id' => $support['Support']['question_id'])
                );
                $this->Session->setFlash(__('The support has been confimed'));
                $this->redirect('/questions/' . $support['Support']['question_id']);
            } else {
                $this->Session->setFlash(__('The support does not exist or has been confirmed'));
                $this->redirect('/');
            }
        }
        throw new NotFoundException();
    }

    public function confirm($key = null) {

        if ($key) {
            $question = $this->Question->find('first', array(
                'conditions' => array(
                    'Question.key_confirm' => $key,
                    )));
            if ($question) {
                unset($question['Question']['modified']);
                $question['Question']['confirm'] = true;
                $question['Question']['key_confirm'] = null;
                $this->Question->save($question);
                $this->Session->setFlash(__('The question has been confimed'));
                $this->redirect('/questions/' . $question['Question']['id']);
            } else {
                $this->Session->setFlash(__('The question does not exist or has been confirmed'));
                $this->redirect('/');
            }
        }
        throw new NotFoundException();
    }

    public function support($id = null) {
        $question = $this->Question->find('first', array(
            'conditions' => array(
                'Question.id' => $id,
                'Question.active' => true,
                'Question.confirm' => true,
            ),
                ));
        if (!$question) {
            $this->Session->setFlash(__('The question does not exist or has been disabled'));
            $this->redirect('/');
        }
        $this->set('question', $question);

        if ($this->request->is('post')) {
//find user
            $user = $this->Question->User->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'email' => $this->request->data['Support']['email']
                    )));
            if (!$user) {
                $user = array();
                $user['name'] = $this->request->data['Support']['name'];
                $user['email'] = $this->request->data['Support']['email'];
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
            $support = $this->Support->find('first', array(
                'conditions' => array(
                    'Support.question_id' => $id,
                    'Support.user_id' => $user['User']['id'],
                    )));
            if ($support) {
                $this->Session->setFlash(__('You already supported this question.'));
                $this->redirect('/questions/' . $id);
            }

            $this->request->data['Support']['user_id'] = $user['User']['id'];
            $this->request->data['Support']['question_id'] = $id;

            $this->Support->create();
            $support = $this->Support->save($this->request->data);
            if ($support) {
                if (empty($support['Support']['confirm'])) {
                    $email = new CakeEmail();
                    $email->from(array('alert@' . DOMAIN => 'Mayor Responds'));
                    $email->replyTo('no-reply@' . DOMAIN, 'Mayor Responds - No reply');
                    $email->to($user['User']['email'], $user['User']['name']);
                    $email->subject('Confirm Support, please');
                    $email->send('Please confirm your support in the url: ' . SITE . 'support/' . $support['Support']['key_confirm']);

                    $this->Session->setFlash(__('The support has been received, check your email to confirm.'));
                    $this->redirect('/questions/' . $id);
                } else {
                    $this->Question->updateAll(
                            array('Question.vote_plus' => 'Question.vote_plus + 1', 'Question.modified' => 'NOW()'), array('Question.id' => $id)
                    );
                    $this->Session->setFlash(__('The support has been saved.'));
                    $this->redirect('/questions/' . $id);
                }
            } else {
                $this->Session->setFlash(__('The support could not be saved. Please, try again.'));
            }
        }
    }

}
