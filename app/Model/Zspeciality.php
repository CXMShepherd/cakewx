<?php
App::uses('AppModel', 'Model');
/**
 * Zzschool Model
 *
 */
class Zspeciality extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'zzspeciality';

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
	);
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 */
	public function afterFind($results)
	{
		$results = parent::afterFind($results);
		foreach ($results as $key => &$val) {
			if (isset($val[$this->name]['FIsMiner'])) 
			{
				$val[$this->name]['FIsMiner'] = $this->_convEnumItem('miner', $val[$this->name]['FIsMiner']);
			}
			
			if (isset($val[$this->name]['FMemo'])) {
				$val[$this->name]['FMemo'] = $this->_convEnumItem('memo', $val[$this->name]['FMemo']);
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
	public function _convEnumItem($type = 'miner', $data)
	{
		switch ($type) {
			case 'miner':
				$return = intval($data) ? '是' : '否';
				break;
			case 'memo':
				$return = $data ? $data : '暂无';
				break;
		}
		return $return;
	}
	
}
