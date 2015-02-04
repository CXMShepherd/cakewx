<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataOrder extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_orders';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'Id';
	
	public $status = array('0' => "无效订单", '1' => "未处理", '2' => "已确认", '3' => "成功订单");
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($data, $uid, $id)
	{	
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		// 推荐数据的处理
		if (isset($this->data[$this->name]['FIsTop'])) {
			if (is_array($this->data[$this->name]['FIsTop'])) {
				foreach ($this->data[$this->name]['FIsTop'] as $value) {
					switch ($value) {
						case '0':
							$this->data[$this->name]['FStatus'] = 0;
							break;
						case '2' :
							$this->data[$this->name]['FStatus'] = 2; 
							break;
						default:
							$this->data[$this->name]['FStatus'] = 1;
							break;
					}
				}
			} else {
				$this->data[$this->name]['FStatus'] = 1;
			}
			unset($this->data[$this->name]['FIsTop']);
		} 
		$query = $this->save($this->data);
		if ($query) return $this->id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function saveOrder($data) {
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set($data);
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
			$storeList = ClassRegistry::init('WxDataStore')->getDataList("", $vals[$this->name]['FOwnerId'], 'md5');
			$vals[$this->name]['C_Store'] = $storeList['WxDataStore']['FName'];
			$vals[$this->name]['C_Order'] = date('YmdH', strtotime($vals[$this->name]['FCreatedate'])).$vals[$this->name]['Id'];
		}
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
		foreach ($this->status as $key => $vals) {
			switch ($key)  {
				default:
					$conditions['FStatus']  = $key;
			}
			$count = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
			$newarr[] = array('key' => $key, 'name' => $vals, 'count' => $count, 'link' => "{$baseurl}?_val={$key}");
			$count = 0;
		}
		// echo '<pre>';print_r($newarr);exit;
		return $newarr;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id, $storeId = null, $openid = null, $cid = null, $type = '', $product = 0)
	{	
		if ($cid != null)
		{
			$conditions = $type == 'md5' ? array('md5(`Id`)' => $cid) : array('Id' => $cid);
			$data = $this->find('first', array('conditions' => $conditions, 'recursive' => 0));
			$data['count'] = count($data[$this->name]['Id']);
			if (is_array($data)) {
				$data[$this->name]['FProduct'] = unserialize($data[$this->name]['FProduct']);
				$data[$this->name]['C_Order'] = date('YmdH', strtotime($data[$this->name]['FCreatedate'])).$data[$this->name]['Id'];
				$data[$this->name]['C_Status'] = $this->status[$data[$this->name]['FStatus']];
				$storelist = ClassRegistry::init('WxDataStore')->getDataList(null, $data[$this->name]['FOwnerId'], 'md5');
				$data[$this->name]['C_StoreName'] = $storelist['WxDataStore']['FName'] ? $storelist['WxDataStore']['FName'] : $data[$this->name]['FStoreName'];
			}
		}
		else
		{
			$conditions = $storeId == null ? array('WxDataOrder.FUserId' => $openid) : array('md5(`WxDataStore.Id`)' => $storeId, 'WxDataOrder.FUserId' => $openid);
			$oncond = $openid != null ? array('md5(`WxDataStore.Id`) = WxDataOrder.FOwnerId') : array('md5(`WxDataStore.Id`) = WxDataOrder.FOwnerId', 'WxDataStore.FWebchat' => $id);
			$attr = array(
				'conditions' => array(
				),
				'joins' => array(
					array(
						'table' => "{$this->tablePrefix}wcdata_stores",
			            'alias' => 'WxDataStore',
			            'type' => 'Right',
			            'conditions' => $oncond
					),
					array(
						'table' => "{$this->tablePrefix}wcdata_users",
			            'alias' => 'WxDataUsers',
			            'type' => 'Left',
			            'conditions' => array(
							'WxDataUsers.FOpenId = WxDataOrder.FUserId'
			            )
					)
				),
				'fields' => array(
					"WxDataStore.Id", 
					"WxDataStore.FName",
					"WxDataStore.FWebchat",
					"WxDataUsers.FMemberId",
					"WxDataUsers.FullName",
					"WxDataUsers.FSex",
					"WxDataOrder.*",
				),
				'group' => array('WxDataOrder.Id'),
				'order' => array('WxDataOrder.FCreatedate DESC')
			);
			if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
			$data = $this->find('all', $attr);
			$data['count'] = $this->find('count', $attr);
			if (is_array($data)) {
				foreach ($data as $key => &$vals) {
					if (is_numeric($key)) {
						$vals[$this->name]['FProduct'] = unserialize($vals[$this->name]['FProduct']);
						$vals[$this->name]['C_Order'] = date('YmdH', strtotime($vals[$this->name]['FCreatedate'])).$vals[$this->name]['Id'];
						$vals[$this->name]['C_Status'] = $this->status[$vals[$this->name]['FStatus']];
					}
				}
			}
			// echo $this->getLastQuery();
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
