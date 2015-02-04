<?php
App::uses('AppModel', 'Model');
/**
 * Zzschool Model
 *
 */
class Zenumitem extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'zzenumitem';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
	    'FEnumName' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
	    'FEnumType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
	);
}
