<?php
/**
 * VoteFixture
 *
 */
class VoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'confirm' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'vote_plus' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'vote_minus' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'vote_abuse' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'anonymous' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
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
			'created' => '2013-01-19 14:12:36',
			'modified' => '2013-01-19 14:12:36',
			'user_id' => 1,
			'confirm' => 1,
			'vote_plus' => 1,
			'vote_minus' => 1,
			'vote_abuse' => 1,
			'anonymous' => 1,
			'type' => 1
		),
	);

}
