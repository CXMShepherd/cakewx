<?php
class ZzScoreline extends CakeMigration {

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
				'zzscoreline' => array(
					'Id' => array(
						'type' => 'string', 
						'null' => false, 
						'length' => 38, 
						'key' => 'primary'
					),
					'FSchool' => array(
						'type' => 'string', 
						'length' => 38, 
						'null' => false
					),
					'FSpecialty' => array(
						'type' => 'string', 
						'length' => 38
					),
					'FYear' => array(
						'type' => 'integer', 
						'length' => 11
					),
					'FCourseType' => array(
						'type' => 'string', 
						'length' => 100
					),
					'FBatchName' => array(
						'type' => 'string', 
						'length' => 100
					),
					'FScoreline' => array(
						'type' => 'integer', 
						'length' => 11
					),
					'FMemo' => array(
						'type' => 'text'
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
				'zzscoreline'
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
