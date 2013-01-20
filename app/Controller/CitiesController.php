<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

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
		$this->set('cities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->set('city', $this->City->read(null, $id));
	}

}
