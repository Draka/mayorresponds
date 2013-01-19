<?php
/**
 * QuestionFixture
 *
 */
class QuestionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modifield' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'questions' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'vote_plus' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'vote_minus' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'vote_abuse' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'trusted' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'confirm' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'actived' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'created' => '2013-01-19 14:08:49',
			'modifield' => '2013-01-19 14:08:49',
			'user_id' => 1,
			'city_id' => 1,
			'questions' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'vote_plus' => 1,
			'vote_minus' => 1,
			'vote_abuse' => 1,
			'trusted' => 1,
			'confirm' => 1,
			'actived' => 1
		),
	);

}
