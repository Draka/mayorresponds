<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

    public $helpers = array ('CreateQuestions');
    public $uses = array ('Question', 'City');

    /**
 * index method
 *
 * @return void
 */
	public function index() {

		$result = $this->City->query("SELECT *,
            (
            SELECT COUNT(*) FROM questions Question
            WHERE Question.city_id = City.id
            ) as num
            FROM cities as City ORDER BY num DESC LIMIT 20;");
		$this->set('cities', $result);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $city = $this->City->find('first', array(
            'conditions' => array(
                'City.name' => $id,
            )));
        if (!$city) {
            throw new NotFoundException(__('Invalid city'));
        }

        $title_for_layout = __('%s\'s questions', $id);

        $questions=$this->Question->findCity($city['City']['id']);
		$this->set(compact('title_for_layout', 'city', 'questions'));
	}

}
