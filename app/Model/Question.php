<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property User $User
 * @property City $City
 * @property Answer $Answer
 */
class Question extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'questions';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
             ),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city_id' => array(
            'notempty' => array(
				'rule' => array('notempty'),
             ),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'questions' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Answer' => array(
			'className' => 'Answer',
			'foreignKey' => 'question_id',
			'dependent' => false,
			'conditions' => array('Answer.active' => true, 'Answer.confirm' => true),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public function beforeSave($options = array()) {
        if (empty($this->data['Question']['id']) && empty($this->data['Question']['confirm'])) {
            $this->data['Question']['key_confirm'] = substr(md5(time()), 0, 16);
        }

        return true;
    }

    public function findLast($limit = 10){
        return $this->find('all',array(
            'recursive' => 1,
            'conditions' => array(
                'Question.confirm' => true,
                'Question.active' => true,
            ),
            'limit' => $limit,
            'order' => 'Question.id DESC'
        ));
    }
    public function findCity($city_id, $limit = 20){
        return $this->find('all',array(
            'recursive' => 1,
            'conditions' => array(
                'Question.confirm' => true,
                'Question.active' => true,
                'Question.city_id' => $city_id,
            ),
            'limit' => $limit,
            'order' => 'Question.id DESC'
        ));
    }

}
