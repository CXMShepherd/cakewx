<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxInvite extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'invite';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'Id';
	
	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public $webchatId;
	
	/**
	 * undocumented variable
	 *
	 * @var string
	 */
	public $validate = array(
	    'FInvCode' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    )
	);
	
	public $type = array('0' => "未使用", '1' => "已使用");
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData()
	{	
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$query = $this->save($this->data);
		if ($query) return $this->id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function saveInvCode($invCode, $data) {
		
		$id = $this->find('list', array('conditions' => array('FInvCode' => $invCode), 'recursive' => 0));
		$id = reset($id);
		
		if ($id) {
			$this->id = $id;
			$this->data[$this->name]['FPerson'] = $data['TPerson']['Id'];
			$this->data[$this->name]['FullName'] = $data['TPerson']['FullName'];
			$this->data[$this->name]['FMobileNumber'] = $data['TPerson']['FMobileNumber'];
			$this->data[$this->name]['FEMail'] = $data['TPerson']['FEMail'];
			$this->data[$this->name]['FUser'] = serialize($data['TPerson']);
			$this->data[$this->name]['FIsUsed'] = 1;
			$this->data[$this->name]['FUseddate'] = date('Y-m-d H:i:s');
			$this->data[$this->name]['FInvCode'] = $invCode;
			$query = $this->saveData();
			if ($query) return TRUE;
		}
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
			$start = ($page == 1) ? 0 : ($page - 1) * $limit;
			$vals[$this->name]['FNumberId'] = $start + $key + 1;
			$vals[$this->name]['C_FIsUsed'] = $this->type[$vals[$this->name]['FIsUsed']];
		}
	    return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function checkInvCode($code) {
		$count = $this->find("count", array('conditions' => array('FInvCode' => $code), 'recursive' => 0));
		if ($count) return TRUE;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id, $cid = 'NULL', $type = '', $product = 0)
	{	
		if ($cid != 'NULL')
		{
			$conditions = $type == 'md5' ? array('md5(`Id`)' => $cid) : array('Id' => $cid);
			$data = $this->find('first', array('conditions' => $conditions, 'recursive' => 0));
			$data['count'] = count($data[$this->name]['Id']);
			if (is_array($data)) {
				$storeId = md5($data[$this->name]['Id']);
				$data[$this->name]['fontendUrl'] = Router::url("/mob/store/{$storeId}", TRUE);
				$data[$this->name]['FTwj'] = unserialize($data[$this->name]['FTwj']);
				$data[$this->name]['FPreTwj'] = implode(',', $data[$this->name]['FTwj']);
			}
		}
		else
		{
			$data['datalist'] = $this->find('all', array('conditions' => array('FWebchat' => $id), 'order' => "FCreatedate desc", 'recursive' => 0));
			$data['count'] = $this->find('count', array('conditions' => array('FWebchat' => $id), 'recursive' => 0));
			foreach ($data['datalist'] as $key => &$vals)
			{	
				$storeId = md5($vals[$this->name]['Id']);
				$vals[$this->name]['fontendUrl'] = Router::url("/mob/store/{$storeId}", TRUE);
				$vals[$this->name]['C_FType'] = $this->type[$vals[$this->name]['FType']];
				$vals[$this->name]['FTwj'] = unserialize($vals[$this->name]['FTwj']);
			}
			// echo '<pre>';print_r($data);exit;
		}
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getStoreProdcut($webchatId, $id, $type = '') {
		$conditions = ($type == 'md5') ? array('MD5(WxDataStore.Id)' => $id) : array('WxDataStore.Id' => $id);
		$attr = array(
			'conditions' => array(
			),
			'joins' => array(
				array(
					'table' => "{$this->tablePrefix}wcdata_cates",
		            'alias' => 'WxDataCate',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'WxDataStore.Id = WxDataCate.FOwnerId',
						'WxDataCate.FType' => 3
		            )
				)
			),
			'fields' => array(
				"WxDataCate.Id", 
				"WxDataCate.FName",
				"WxDataCate.FTwj",
				"WxDataCate.FCreatedate",
				"WxDataCate.FOrder"
				//"WxDataStore.*",
			),
			'group' => array('WxDataCate.Id'),
			'order' => array('WxDataCate.FOrder DESC')
		);
		if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
		$data = $this->find('all', $attr);
		foreach ($data as $key => &$value) {
			$value['WxDataCate']['products'] = '';
			$cids = unserialize($value['WxDataCate']['FTwj']);
			if ($cids) {
				$twdata = ClassRegistry::init('WxDataTw')->getDataList($webchatId, null, $cids, null, 'product');
				$value['WxDataCate']['products'] = $twdata['datalist'];
			}
			$value = $value['WxDataCate'];		// 调整数组
		}
		// echo $this->getLastQuery();
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
