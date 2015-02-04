<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxFeedback extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'feedback';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
	    'FName' => array(
			'rule' => "alphaNumeric",
			'message' => "必须填写",
			'required' => true
	    ),
		'FEMail' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FPhone' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FMessage' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
}
