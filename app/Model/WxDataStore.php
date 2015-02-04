<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataStore extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_stores';

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
	    'FName' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    ),
		'FSignPicUrl' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    )
	);
	
	public $storeType = array(
							'00' => "普通店",
							'cy001' => "餐饮店",
							'gs001' => "果蔬店",
							'cs001' => "超市店",
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
			$storeId = md5($vals[$this->name]['Id']);
			$vals[$this->name]['fontendUrl'] = Router::url("/mob/store/{$storeId}", TRUE);
			$vals[$this->name]['C_FStore'] = $this->storeType[$vals[$this->name]['FStore']];
			$vals[$this->name]['C_FType'] = ClassRegistry::init('WxDataCate')->getValueCate($this->webchatId, 2, $vals[$this->name]['FOwnerId']);
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
		foreach ($this->storeType as $key => $vals) {
			switch ($key)  {
				default:
					$conditions['FStore']  = $key;
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
	 * @author niancode
	 **/
	function getStoresByCate($webchatId) {
		$newarr = array();
		$conditions = array('WxDataStore.FWebchat' => $webchatId);
		$attr = array(
			'conditions' => array(
			),
			'joins' => array(
				array(
					'table' => "{$this->tablePrefix}wcdata_cates",
		            'alias' => 'WxDataCate',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'WxDataStore.FOwnerId = WxDataCate.Id',
						'WxDataCate.FType' => 2		// 店铺分类
		            )
				)
			),
			'fields' => array(
				"WxDataCate.Id", 
				"WxDataCate.FName",
				"WxDataCate.FTwj",
				"WxDataCate.FCreatedate",
				"WxDataCate.FOrder",
				"WxDataStore.*",
			),
			'order' => array('WxDataCate.FOrder ASC')
		);
		if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
		$data = $this->find('all', $attr);
		foreach ($data as $key => &$value) {
			if ($value['WxDataCate']['Id']) {
				$newarr['cate'][$value['WxDataCate']['Id']] = $value['WxDataCate']['FName'];
			}
			if ($value[$this->name]['Id']) {
				$newarr['datalist'][$key] = $value[$this->name];
				$newarr['datalist'][$key]['C_cate'] = $value['WxDataCate'];
			}
		}
		$newarr['cate'] = ClassRegistry::init('WxDataCate')->getOptionsCates($webchatId, 2);
		// echo '<pre>'; print_r($newarr);exit;
		return $newarr;
	}
	
	/**
	 * 获取店铺数据
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id, $cid = null, $type = '', $product = 0)
	{	
		if ($cid != null)
		{
			$conditions = $type == 'md5' ? array('md5(`Id`)' => $cid) : array('Id' => $cid);
			$data = $this->find('first', array('conditions' => $conditions, 'recursive' => 0));
			$data['count'] = count($data[$this->name]['Id']);
			if (is_array($data)) {
				$storeId = md5($data[$this->name]['Id']);
				$data[$this->name]['fontendUrl'] = Router::url("/mob/store/{$storeId}", TRUE);
				$data[$this->name]['FTwj'] = unserialize($data[$this->name]['FTwj']);
				$data[$this->name]['FPreTwj'] = implode(',', $data[$this->name]['FTwj']);
				$data[$this->name]['C_FOvFreeDc'] = $data[$this->name]['FOvFreeDc'] ? $data[$this->name]['FOvFreeDc'] : 100;
				$data[$this->name]['C_FDevDistance'] = $data[$this->name]['FDevDistance'] ? $data[$this->name]['FDevDistance'] : 2;
				$data[$this->name]['C_FPhone'] = explode('|', $data[$this->name]['FPhone']);
				$data[$this->name]['FPhone'] = reset($data[$this->name]['C_FPhone']);
				$data[$this->name]['C_FPhone'] = implode('，', $data[$this->name]['C_FPhone']);
				$couStr['FDevCost'] = $data[$this->name]['FIsCouponsFirst'] && $data[$this->name]['FCouponsFirst'] ? $data[$this->name]['FCouponsFirst'] : '';
				$couStr['FOvFreeDc'] = $data[$this->name]['FDevCost'] != 0 ? $data[$this->name]['C_FOvFreeDc'] : '';
				$arCounStr = array_filter(array_values($couStr));
				$data[$this->name]['C_IsCoupons'] = !empty($arCounStr) ? 1 : 0;
				$couStr['FDevCost'] = $couStr['FDevCost'] ? sprintf("首单立减%s元", $couStr['FDevCost']) : '';
				if (empty($couStr['FDevCost'])) unset($couStr['FDevCost']);
				$couStr['FOvFreeDc'] = $couStr['FOvFreeDc'] ? sprintf("满%s元免配送费", $couStr['FOvFreeDc']) : '';
				if (empty($couStr['FOvFreeDc'])) unset($couStr['FOvFreeDc']);
				$data[$this->name]['C_Coupons'] = implode('，', $couStr);
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
				$vals[$this->name]['C_FOvFreeDc'] = $vals[$this->name]['FOvFreeDc'] ? $vals[$this->name]['FOvFreeDc'] : 100;
				$vals[$this->name]['C_FDevDistance'] = $vals[$this->name]['FDevDistance'] ? $vals[$this->name]['FDevDistance'] : 2;
			}
		}
		// echo '<pre>';print_r($data);exit;
		return $data;
	}
	
	/**
	 * 获取商品数据
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
			'order' => array('WxDataCate.FOrder ASC')
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
