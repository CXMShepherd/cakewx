<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataTw extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'wcdata_tw';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
	    'FTitle' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FUrl' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
	public $type = array('0' => "文章图文", '1' => "图文集");
	//public $conType = array('tw' => "单图文", 'twj' => "多图文", 'events' => array('events' => "活动", 'dzp' => "大转盘", 'yhq' => "优惠券"), 'product' => "商品");
	public $conType = array('tw' => "单图文", 'twj' => "多图文", 'events' => array('events' => "活动"), 'product' => "商品");
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($data, $uid, $id)
	{	
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('Id', $this->id ? $this->id : String::uuid());
		$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		$twj = array_filter($this->data['WxDataTw']['FTwj']);
		$this->data['WxDataTw']['FTwj'] = serialize(array_values($twj));
		$twData = $this->data;
		$query = $this->save($this->data, FALSE);
		if ($query) {
			switch ($twData['WxDataTw']['FTwType']) {
				case 'events':
					$dbExtra = ClassRegistry::init('WxDataTwEvent');
					$eData = $dbExtra->find('first', array('conditions' => array('FOwnerId' => $this->id), 'recursive' => 0));
					if (isset($eData['WxDataTwEvent']['Id'])) {
						$dbExtra->id = $eData['WxDataTwEvent']['Id'];
					} else {
						$dbExtra->set('Id', String::uuid());
						$dbExtra->set('FCreatedate', date('Y-m-d H:i:s'));
					}
					$dbExtra->set('FOwnerId', $this->id);
					$dbExtra->save();
					break;
				case 'product':
					$dbExtra = ClassRegistry::init('WxDataTwProduct');
					$eData = $dbExtra->find('first', array('conditions' => array('FOwnerId' => $this->id), 'recursive' => 0));
					if (isset($eData['WxDataTwProduct']['Id'])) {
						$dbExtra->id = $eData['WxDataTwProduct']['Id'];
					} else {
						$dbExtra->set('Id', String::uuid());
						$dbExtra->set('FCreatedate', date('Y-m-d H:i:s'));
					}
					$dbExtra->set('FOwnerId', $this->id);
					$dbExtra->save();
					break;
				default:
			}
			return $this->id;
		} 
	}
	
	/**
	 * 获取图文类型
	 *
	 * @return void
	 * @author niancode
	 **/
	function _getTwType($type, $FTwType = null)
	{
		if ($type == 0) {
			$return = is_array($this->conType[$FTwType]) ? reset($this->conType[$FTwType]) : $this->conType[$FTwType];
			$return = $return ? $return : $this->conType['tw'];
			return $return;
		} else {
			return $this->conType['twj'];
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
			$vals['WxDataTw']['C_FType'] = $this->_getTwType($vals['WxDataTw']['FType'], $vals['WxDataTw']['FTwType']);
		}
	    return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id = NULL, $cid = NULL, $ids = NULL, $conditions = NULL, $type = null, $limit = null, $offset = null, $idsOrder = 1) {	
		if ($cid != NULL) {
			$conditions = $id == NULL ? array('WxDataTw.Id' => $cid) : array('WxDataTw.Id' => $cid, 'WxDataTw.FWebchat' => $id);
			switch ($type) {
				case 'product':
					$attr = array(
						'conditions' => array(
						),
						'joins' => array(
							array(
								'table' => "{$this->tablePrefix}wcdata_tw_product",
					            'alias' => 'WxDataTwProduct',
					            'type' => 'LEFT',
					            'conditions' => array(
					                'WxDataTw.Id = WxDataTwProduct.FOwnerId'
					            )
							)
						),
						'fields' => array(
							"WxDataTw.*",
							"WxDataTwProduct.FOrigPrice", 
							"WxDataTwProduct.FPrice", 
							"WxDataTwProduct.FPicUrl",
							"WxDataTwProduct.FAddress",
							"WxDataTwProduct.FUnit",
							"WxDataTwProduct.FIsClosed",
						),
						'group' => array('WxDataTw.Id'),
						'order' => array('FCreatedate DESC')
					);
					break;
				default:
					$attr = array(
						'conditions' => array(
						),
						'joins' => array(
							array(
								'table' => "{$this->tablePrefix}wcdata_tw_events",
					            'alias' => 'WxDataTwEvent',
					            'type' => 'LEFT',
					            'conditions' => array(
					                'WxDataTw.Id = WxDataTwEvent.FOwnerId'
					            )
							)
						),
						'fields' => array(
							"WxDataTw.*",
							"WxDataTwEvent.FMaxPersonCount", 
							"WxDataTwEvent.FAddress", 
							"WxDataTwEvent.FPersonCount",
							"WxDataTwEvent.FStartdate"
						),
						'group' => array('WxDataTw.Id'),
						'order' => array('FCreatedate DESC')
					);
					break;
			}
			if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
			$data = $this->find('first', $attr);
			if (is_array($data)) {
				$data['WxDataTw']['FTwj'] = unserialize($data['WxDataTw']['FTwj']);
				$data['WxDataTw']['FPreTwj'] = implode(',', $data['WxDataTw']['FTwj']);
				$data['WxDataTw']['FPreview'] = ($data['WxDataTw']['FType'] == 0 && $data['WxDataTw']['FTwType'] != null) ? Router::url("/mob/tw/events/{$data['WxDataTw']['Id']}", TRUE) : Router::url("/mob/tw/{$data['WxDataTw']['Id']}", TRUE);
				$data['WxDataTw']['FPreview'] = !empty($data['WxDataTw']['FLink']) ? $data['WxDataTw']['FLink'] : $data['WxDataTw']['FPreview'];
				$data['WxDataTw']['FPreview_nlik'] = ($data['WxDataTw']['FType'] == 0 && $data['WxDataTw']['FTwType'] != null) ? "/mob/tw/events/{$data['WxDataTw']['Id']}" : "/mob/tw/{$data['WxDataTw']['Id']}";
				$data['WxDataTw']['FPreview_nlik'] = !empty($data['WxDataTw']['FLink']) ? $data['WxDataTw']['FLink'] : $data['WxDataTw']['FPreview_nlik'];
				$data['WxDataTwProduct']['FUnit'] = !empty($data['WxDataTwProduct']['FUnit']) ? $data['WxDataTwProduct']['FUnit'] : "份";
				$data['WxDataTwProduct']['FIsClosed'] = !empty($data['WxDataTwProduct']['FIsClosed']) ? $data['WxDataTwProduct']['FIsClosed'] : 0;
			}
		} else {
			$conditions['WxDataTw.FWebchat'] = $id;
			if ($ids) $conditions['WxDataTw.Id'] = $ids;
			switch ($type) {
				case 'product':
					$attr = array(
						'conditions' => array(
						),
						'joins' => array(
							array(
								'table' => "{$this->tablePrefix}wcdata_tw_product",
					            'alias' => 'WxDataTwProduct',
					            'type' => 'LEFT',
					            'conditions' => array(
					                'WxDataTw.Id = WxDataTwProduct.FOwnerId'
					            )
							)
						),
						'fields' => array(
							"WxDataTw.*",
							"WxDataTwProduct.FOrigPrice", 
							"WxDataTwProduct.FPrice", 
							"WxDataTwProduct.FPicUrl",
							"WxDataTwProduct.FAddress",
							"WxDataTwProduct.FUnit",
							"WxDataTwProduct.FIsClosed",
						),
						'group' => array('WxDataTw.Id'),
						'order' => array('FCreatedate DESC')
					);
					break;
				default:
					$attr = array(
						'conditions' => array(
						),
						'joins' => array(
							array(
								'table' => "{$this->tablePrefix}wcdata_tw_events",
					            'alias' => 'WxDataTwEvent',
					            'type' => 'LEFT',
					            'conditions' => array(
					                'WxDataTw.Id = WxDataTwEvent.FOwnerId'
					            )
							)
						),
						'fields' => array(
							"WxDataTw.*",
							"WxDataTwEvent.FMaxPersonCount", 
							"WxDataTwEvent.FAddress", 
							"WxDataTwEvent.FPersonCount",
							"WxDataTwEvent.FStartdate"
						),
						'group' => array('WxDataTw.Id'),
						'order' => array('FCreatedate DESC')
					);
					break;
			}
			if ($limit) $attr['limit'] = $limit;
			if ($offset) $attr['offset'] = $offset;
			$ids_str = implode(',', $ids);
			if ($ids && $idsOrder) $attr['order'] = "FIND_IN_SET(WxDataTw.Id, '{$ids_str}')";
			if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
			$data['datalist'] = $this->find('all', $attr);
			$data['count'] = $this->find('count', $attr);
			foreach ($data['datalist'] as $key => &$vals) {	
				$vals['WxDataTw']['C_FType'] = $this->conType[$vals['WxDataTw']['FTwType']] ? $this->conType[$vals['WxDataTw']['FTwType']] : reset($this->conType);
				$vals['WxDataTw']['FTwj'] = unserialize($vals['WxDataTw']['FTwj']);
				$vals['WxDataTw']['FPreview'] = ($vals['WxDataTw']['FType'] == 0 && $vals['WxDataTw']['FTwType'] != null) ? Router::url("/mob/tw/events/{$vals['WxDataTw']['Id']}", TRUE) : Router::url("/mob/tw/{$vals['WxDataTw']['Id']}", TRUE);
				$vals['WxDataTw']['FPreview'] = !empty($vals['WxDataTw']['FLink']) ? $vals['WxDataTw']['FLink'] : $vals['WxDataTw']['FPreview'];
				$vals['WxDataTw']['FPreview_nlik'] = ($vals['WxDataTw']['FType'] == 0 && $vals['WxDataTw']['FTwType'] != null) ? "/mob/tw/events/{$vals['WxDataTw']['Id']}" : "/mob/tw/{$vals['WxDataTw']['Id']}";
				$vals['WxDataTw']['FPreview_nlik'] = !empty($vals['WxDataTw']['FLink']) ? $vals['WxDataTw']['FLink'] : $vals['WxDataTw']['FPreview_nlik'];
				$vals['WxDataTw']['C_FCreatedate'] = date('y-m-d', strtotime($vals['WxDataTw']['FCreatedate']));
				$vals['WxDataTwProduct']['FUnit'] = !empty($vals['WxDataTwProduct']['FUnit']) ? $vals['WxDataTwProduct']['FUnit'] : "份";
				$vals['WxDataTwProduct']['FIsClosed'] = !empty($vals['WxDataTwProduct']['FIsClosed']) ? $vals['WxDataTwProduct']['FIsClosed'] : 0;
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
	 * @author niancode
	 **/
	function getGaryDataList($id, $cid) {
		$data = $this->getDataList($id, $cid);
		foreach ($data['WxDataTw']['FTwj'] as $key => &$vals) {
			$findData = $this->findById($vals);
			$findData['WxDataTw']['FUrl_nl'] = $findData['WxDataTw']['FUrl'];
			$findData['WxDataTw']['FUrl'] = Router::url($findData['WxDataTw']['FUrl'], TRUE);
			$findData['WxDataTw']['FPreview'] = ($findData['WxDataTw']['FType'] == 0 && $findData['WxDataTw']['FTwType'] != null) ? Router::url("/mob/tw/events/{$findData['WxDataTw']['Id']}", TRUE) : Router::url("/mob/tw/{$findData['WxDataTw']['Id']}", TRUE);
			$findData['WxDataTw']['FPreview'] = !empty($findData['WxDataTw']['FLink']) ? $findData['WxDataTw']['FLink'] : $findData['WxDataTw']['FPreview'];
			$vals = $findData['WxDataTw'];
		}
		return $data;
	}
	
	/**
	 * 获取分类数据
	 *
	 * @return void
	 * @author niancode
	 **/
	function getCategories($id, $type = 'tw') {
		$newarr = $conType = array();
		$conditions['FWebchat'] = $id;
		if ($type == 'tw') {
			$conType = array_slice($this->conType, 0, 2, true);
		} else {
			$conType = is_array($this->conType[$type]) ? $this->conType[$type] : array($type => $this->conType[$type]);
		}
		foreach ($conType as $key => $vals) {
			switch ($key)  {
				case 'tw':
					$conditions['FTwType'] = null;
					$conditions['FType']  = 0;
					break;
				case 'twj':
					$conditions['FType']  = 1;
					break;
				default:
					$conditions['FType']  = 0;
					$conditions['FTwType']  = $key;
			}
			$count = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
			$newarr[] = array('key' => $key, 'name' => $vals, 'count' => $count, 'link' => "{$baseurl}?_val={$key}");
			$count = 0;
		}
		return $newarr;
	}
	
	/**
	 * 检查Id
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
	 * WebChat API Send 
	 *
	 * @return void
	 * @author niancode
	 **/
	function getSendTwMsg($twId, $type = 'arr')
	{
		$twId = is_array($twId) ? reset($twId) : $twId;
		$data = $this->getDataList(null, $twId);
		$WX_twj = isset($data['WxDataTw']['FTwj']) ? unserialize($data['WxDataTw']['FTwj']) : FALSE;
		$WX_type = isset($data['WxDataTw']['FType']) ? $data['WxDataTw']['FType'] : 0;
		$returnArr['count'] = 0;
		if ($WX_type == 0) {
			$returnArr['count'] = 1;
			$returnArr['items'][0] = array(
										'Title' => $data['WxDataTw']['FTitle'],
										'Description' => $data['WxDataTw']['FMemo'],
										'PicUrl' => Router::url($data['WxDataTw']['FUrl'], TRUE),
										'Url' => $data['WxDataTw']['FPreview'],
										'Content' => $data['WxDataTw']['FContent'],
										'Author' => $data['WxDataTw']['FAuthor'],
										'FUrl' => WWW_ROOT.$data['WxDataTw']['FUrl'],
										'Coverd' => 0
									);
		} else {
			$twjData = $this->getGaryDataList(null, $twId);
			// echo '<pre>';print_r($twjData);exit;
			$itemsArr = array();
			foreach ($twjData['WxDataTw']['FTwj'] as $key => $value) {
				$returnArr['items'][] = array(
									'Title' => $value['FTitle'],
									'Description' => $value['FMemo'],
									'PicUrl' => Router::url($value['FUrl'], TRUE),
									'Url' => $value['FPreview'],
									'Author' => $value['FAuthor'],
									'Content' => $value['FContent'],
									'Coverd' => $key == 0 ? 1 : 0,
									'FUrl' => WWW_ROOT.$value['FUrl_nl']
								);
				
			}
			$returnArr['count'] += intval(count($twjData['WxDataTw']['FTwj']));
		}
		
		// Msg Output
		if ($type != 'arr') {
			$content = array();
			$content['data']['ArticleCount'] = $returnArr['count'];
			$content['data']['items'] = $returnArr['items'];
			$content['type'] = "news";
			$returnArr = $content;
		}
		return $returnArr;
	}
	
	/**
	 * WebChat API 
	 *
	 * @return void
	 * @author apple
	 **/
	function getMsg($twId, $type = 'arr')
	{
		$twId = is_array($twId) ? reset($twId) : $twId;
		$data = $this->getDataList(null, $twId);
		$WX_twj = isset($data['WxDataTw']['FTwj']) ? unserialize($data['WxDataTw']['FTwj']) : FALSE;
		$WX_type = isset($data['WxDataTw']['FType']) ? $data['WxDataTw']['FType'] : 0;
		$returnArr['count'] = 0;
		if ($WX_type == 0) {
			$returnArr['count'] = 1;
			$returnArr['items'][0] = array(
										'Title' => $data['WxDataTw']['FTitle'],
										'Description' => $data['WxDataTw']['FMemo'],
										'PicUrl' => Router::url($data['WxDataTw']['FUrl'], TRUE),
										'Url' => $data['WxDataTw']['FPreview']
									);
		} else {
			$twjData = $this->getGaryDataList(null, $twId);
			$itemsArr = array();
			foreach ($twjData['WxDataTw']['FTwj'] as $key => $value) {
				$returnArr['items'][] = array(
									'Title' => $value['FTitle'],
									'Description' => $value['FMemo'],
									'PicUrl' => Router::url($value['FUrl'], TRUE),
									'Url' => $value['FPreview']
								);
			}
			$returnArr['count'] += intval(count($twjData['WxDataTw']['FTwj']));
		}
		
		// Msg Output
		if ($type != 'arr') {
			$content = array();
			$content['data']['ArticleCount'] = $returnArr['count'];
			$content['data']['items'] = $returnArr['items'];
			$content['type'] = "news";
			$returnArr = $content;
		}
		return $returnArr;
	}
	

	
	/**
	 * 图文链接
	 *
	 * @return void
	 * @author apple
	 **/
	function _getFTwjLink($id)
	{
		return Router::url("/mob/tw/{$id}", TRUE);
	}
}
