<?php

App::uses('AppController', 'Controller');

/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

    public $helpers = array('CreateQuestions');

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
        $this->Question->id = $id;
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }
        pr($this->Question->read(null, $id));die;
        $this->set('question', $this->Question->read(null, $id));
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

            $this->Question->create();
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash(__('The question has been saved'));
                $this->redirect(array('action' => 'view/' . $this->Question->id));
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
        $this->Question->id = $id;
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash(__('The question has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Question->read(null, $id);
        }
        $users = $this->Question->User->find('list');
        $cities = $this->Question->City->find('list');
        $this->set(compact('users', 'cities'));
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
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Question->id = $id;
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }
        if ($this->Question->delete()) {
            $this->Session->setFlash(__('Question deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Question was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
