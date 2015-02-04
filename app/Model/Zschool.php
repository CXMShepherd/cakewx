<?php
App::uses('AppModel', 'Model');
/**
 * Zzschool Model
 *
 */
class Zschool extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'zzschool';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
	    'FName' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FProv' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FAddress' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
}
