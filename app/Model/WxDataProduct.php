<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataProduct extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_product';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'Id';
	
	/**
	 * undocumented variable
	 *
	 * @var string
	 */
	public $validate = array(
	    'FName' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    )
	);
	
	public $type = array('0' => "单店铺");
	public $storeType = array(
							'cy001' => "餐饮店",
							'gs001' => "果蔬店",
							'cs001' => "超市店",
							'00' => "其它店铺",
						);
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($data, $id)
	{	
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		if (!$this->id) $this->set('FWebchat', $id);
		$this->set('Id', $this->id ? $this->id : String::uuid());
		$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		$this->set('FStatus', 1);
		$this->set('FIsActive', 1);
		$this->set($data);
		unset($this->data[$this->name]['FPay']);
		// echo '<pre>'; print_r($this->data);exit;
		$query = $this->save($this->data);
		if ($query) return $this->id;
	}
	
	/**
	 * Overridden paginate method - group by week, away_team_id and home_team_id
	 */
	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) 
	{
	    $recursive = -1;
		$data = $this->find(
	        'all',
	        compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive', 'group')
	    );
		foreach ($data as $key => &$vals)
		{	
			$vals[$this->name]['C_FStore'] = $this->storeType[$vals[$this->name]['FStore']];
		}
	    return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getOptionsStores($id)
	{
		$data = $this->find('list', array('fields' => array("FName"), 'conditions' => array('FWebchat' => $id), 'order' => "FCreatedate desc", 'recursive' => 0));
		// echo '<pre>'; print_r($data);exit;
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getCategories($id, $baseurl) {
		$newarr = array();
		$conditions['FWebchat'] = $id;
		foreach ($this->type as $key => $vals) {
			switch ($key)  {
				default:
					$conditions['FType']  = $key;
			}
			$count = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
			$newarr[] = array('key' => $key, 'name' => $vals, 'count' => $count, 'link' => "{$baseurl}?_val={$key}");
			$count = 0;
		}
		return $newarr;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id, $cid = 'NULL')
	{	
		if ($cid != 'NULL')
		{
			$data = $this->find('first', array('conditions' => array('Id' => $cid, 'FWebchat' => $id), 'recursive' => 0));
			if (is_array($data)) {
				$data['WxDataKds']['FTwj'] = unserialize($data['WxDataKds']['FTwj']);
				$data['WxDataKds']['FPreTwj'] = implode(',', $data['WxDataKds']['FTwj']);
			}
		}
		else
		{
			$data['datalist'] = $this->find('all', array('conditions' => array('FWebchat' => $id), 'order' => "FCreatedate desc", 'recursive' => 0));
			$data['count'] = $this->find('count', array('conditions' => array('FWebchat' => $id), 'recursive' => 0));
			foreach ($data['datalist'] as $key => &$vals)
			{	
				$vals['WxDataKds']['C_FType'] = $this->type[$vals['WxDataKds']['FType']];
				$vals['WxDataKds']['FTwj'] = unserialize($vals['WxDataKds']['FTwj']);
			}
			// echo '<pre>';print_r($data);exit;
		}
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function checkId($id, $cid)
	{
		$conditions = array('FWebchat' => $id, 'Id' => $cid);
		$count = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
		if ($count) return TRUE;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getWxType($webchat, $keywords) {
		$data = $this->find('first', array('conditions' => array('FKey' => $keywords, 'FWebchat' => $webchat, 'AND' => array('OR' => array(array('FKeyMacth' => null), array('FKeyMacth' => 0)))), 'recursive' => 0));
		if (!$data) {		// 模糊匹配			
			$data = $this->find('first', array('conditions' => array("LOCATE(`Fkey`, '{$keywords}') >" => "0", 'FWebchat' => $webchat, 'FKeyMacth' => "1"), 'recursive' => 0));
		}
		$type = isset($data['FType']) ? $data['FType'] : FALSE;
		return $type;
	}

}
