<?php
class ZzLocation extends CakeMigration {

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
				'zzlocation' => array(
					'Id' => array(
						'type' => 'integer', 
						'null' => false, 
						'length' => 11, 
						'key' => 'primary'
					),
					'FCode' => array(
						'type' => 'string', 
						'length' => 100, 
						'null' => false
					),
					'FName' => array(
						'type' => 'string', 
						'length' => 100, 
						'null' => false
					),
					'FType' => array(
						'type' => 'string', 
						'length' => 100
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
				'zzlocation'
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
