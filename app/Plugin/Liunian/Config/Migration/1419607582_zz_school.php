<?php
class ZzSchool extends CakeMigration {

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
				'zzschool' => array(
					'Id' => array(
						'type' => 'string', 
						'length' => 38, 
						'null' => false, 
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
					'FIcon' => array(
						'type' => 'string', 
						'length' => 1000
					),
					'FBanner' => array(
						'type' => 'string', 
						'length' => 1000
					),
					'FAddress' => array(
						'type' => 'string', 
						'length' => 1000
					),
					'FStuTotal' => array(
						'type' => 'string', 
						'length' => 100
					),
					'FWebLink' => array(
						'type' => 'string', 
						'length' => 500
					),
					'FLocation' => array(
						'type' => 'boolean', 
						'length' => 1
					),			
					'FProv' => array(
						'type' => 'string', 
						'length' => 200
					),
					'FCity' => array(
						'type' => 'string', 
						'length' => 200
					),	
					'FType' => array(					
						'type' => 'integer',
						'length' => 11
					),			
					'FStuLength' => array(				
						'type' => 'integer',
						'length' => 11
					),				
					'FNatureOfPlan' => array(				
						'type' => 'integer',
						'length' => 11
					),			
					'FBatchName' => array(				
						'type' => 'integer',
						'length' => 11,
					),			
					'FWeibo' => array(
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
				'zzschool'
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
