<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	// var $useDbConfig = '_170';
	
	public function getLastQuery()
	{
	    $dbo = $this->getDatasource();
	    $logs = $dbo->getLog();
	    $lastLog = end($logs['log']);
	    return $lastLog['query'];
	}
	
	public function wrLog()
	{
	    $dbo = $this->getDatasource();
	    $logs = $dbo->getLog();
		$this->log($logs, 'sql');
	  	return TRUE;
	}
	
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	public function afterSave() {
		
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	public function afterDelete() {
		
	}
	
	// =========================== V2 2015年 1月 4日 星期日 03时37分21秒 CST 
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveByGuid($data)
	{
		$data = &$this->data[$this->name];
		if (!$this->id) {
			$data['Id'] = String::uuid();
			$data['FCreateTime'] = time();
			$data['FUpdateTime'] = time();
		} else {
			$data['FUpdateTime'] = time();
		}
		$query = $this->save($data);
		if ($query) return $this->id;
	}
	
	// /**
	//  * undocumented function
	//  *
	//  * @return void
	//  * @author niancode
	//  **/
	// public function beforeSave($options = array()) {
	// 	$data = &$this->data[$this->name];
	// 	if (!$this->id) {
	// 		$data['FCreateTime'] = time();
	// 		$data['FUpdateTime'] = time();
	// 	} else {
	// 		$data['FUpdateTime'] = time();
	// 	}
	// 	return TRUE;
	// }
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	public function afterFind($results, $primary = false) {
		$results = $this->convDateFormat($results);
		return $results;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 */
	public function convDateFormat($results)
	{
		foreach ($results as $key => &$val) {
			if (isset($val[$this->name]['FCreateTime'])) 
			{
				$val[$this->name]['FCreateTime'] = $this->dateFormatAfterFind($val[$this->name]['FCreateTime']);
			}
			
			if (isset($val[$this->name]['FUpdateTime'])) 
			{
				$val[$this->name]['FUpdateTime'] = $this->dateFormatAfterFind($val[$this->name]['FUpdateTime']);
			}
		}
		return $results;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 */
	public function dateFormatAfterFind($dateString) {
		$dateString = is_numeric($dateString) ? $dateString : strtotime($dateString);
	    return date('Y-m-d H:i:s', $dateString);
	}
	
}
