<?php
class ZzTeacher extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'zzteacher' => array(
					'Id' => array(
						'type' => 'string', 
						'null' => false, 
						'length' => 38, 
						'key' => 'primary'
					),
					'FName' => array(
						'type' => 'string', 
						'length' => 200, 
						'null' => false
					),
					'FMemo' => array(
						'type' => 'text'
					),
					'FJobTitle' => array(
						'type' => 'string', 
						'length' => 100
					),
					'FIsStar' => array(
						'type' => 'boolean', 
						'length' => 1
					),
					'FSchool' => array(
						'type' => 'string', 
						'length' => 38
					),
					'FPic' => array(
						'type' => 'string', 
						'length' => 1000
					),
					'FWeibo' => array(
						'type' => 'string', 
						'length' => 1000
					),
					'FWebLink' => array(
						'type' => 'string', 
						'length' => 1000
					),
					'FCreateTime' => array(
						'type' => 'integer', 
						'length' => 11,
						'default' => 0
					),
					'FUpdateTime' => array(
						'type' => 'integer', 
						'length' => 11,
						'default' => 0
					),
					'indexes' => array(
						'PRIMARY' => array(
							'column' => 'Id', 
							'unique' => 1
						)
					),
					'tableParameters' => array(
						'charset' => 'utf8', 
						'collate' => 'utf8_general_ci', 
						'engine' => 'InnoDB'
					)
				)
			)
		),
		'down' => array(
			'drop_table' => array(
				'zzteacher'
			)
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
