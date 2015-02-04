<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataTwProduct extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'wcdata_tw_product';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
		'FAddress' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FPrice' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
}
