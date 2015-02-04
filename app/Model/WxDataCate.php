<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataCate extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_cates';

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
	    ),
		'FType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
	public $type = array('default' => array('0' => "图文", '1' => "活动", '2' => "店铺", '3' => "商品", "4" => "文章"), 'store' => array('2' => "店铺"), 'product' => array('3' => "商品"));
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($data, $uid, $id)
	{	
		// echo '<pre>';print_r($this->data);exit;
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('Id', $this->id ? $this->id : String::uuid());
		$this->set('FWebchat', $id);
		if (isset($this->data[$this->name]['FTwj'])) {
			$this->data[$this->name]['FTwj'] = serialize($this->data[$this->name]['FTwj']);
		}
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
	// echo $this->getLastQuery();exit;
		foreach ($data as $key => &$vals)
		{	
			$vals['WxDataCate']['C_FType'] = $this->type['default'][$vals['WxDataCate']['FType']];
			$vals['WxDataCate']['M_FType'] = $this->matchType[$vals['WxDataCate']['FKeyMacth']] ? $this->matchType[$vals['WxDataKds']['FKeyMacth']] : "完全匹配";
		}
	    return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getOptionsCates($id, $type = 0)
	{
		$data = $this->find('list', array('fields' => array("Id", "FName"), 'conditions' => array('FWebchat' => $id, 'FType' => $type), 'order' => "FOrder asc", 'recursive' => 0));
		// echo '<pre>'; print_r($data);exit;
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getValueCate($webchatId, $type, $id) {
		$data = $this->getOptionsCates($webchatId, $type);
		$data = isset($data[$id]) ? $data[$id] : '无分类';
		// echo $this->getLastQuery();
		// echo '<pre>'; print_r($data);exit;
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getCategories($id, $type) {
		$newarr = array();
		$conditions['FWebchat'] = $id;
		$tps = $this->type[$type] ? $this->type[$type] : $this->type['default'];
		foreach ($tps as $key => $vals) {
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
				$vals[$this->name]['C_FType'] = $this->type[$vals[$this->name]['FType']];
				$vals[$this->name]['FTwj'] = unserialize($vals[$this->name]['FTwj']);
			}
			// echo '<pre>';print_r($data);exit;
		}
		return $data;
	}
	
	/**
	 * 移动端展示公告，文章等
	 * artype可以是数组array('公告', '活动')
	 *
	 * @return void
	 * @author niancode
	 **/
	function getArticleByCate($webchat, $ownerId, $artype = '公告', $limit = null, $offset = null, $idsOrder = 1) {
		//$artype = array('公告', '活动', '优惠');
		$data = $this->find('list', array('conditions' => array('md5(`FOwnerId`)' => $ownerId, 'FType' => 4, 'FName' => $artype), 'recursive' => 0, 'fields' => array('FName', 'FTwj')));
		$twids = array();
		foreach ($data as $vals) {
			$vals =  unserialize($vals);
			$twids = array_merge($twids, $vals);
		}
		$rs = array();
		if (!empty($twids)) {
			$rs = ClassRegistry::init('WxDataTw')->getDataList($webchat, NULL, $twids, NULL, NULL, $limit, $offset, $idsOrder);
			$rs = $rs['datalist'];
			$rsys = array();
			if (is_array($data)) {
				if (is_array($artype)) {
					foreach ($artype as $ak => $av) {
						unset($artype[$ak]);
						$artype[$av] = $data[$av];
					}
				} else {
					$artype = $data;
				}
				foreach ($artype as $k => $v) {
					$v = unserialize($v);
					if (is_array($rs)) {
						foreach ($rs as $rk => &$rv) {
							if (in_array($rv['WxDataTw']['Id'], $v)) {
								$rv['cateType'] = $k;
								$rsys[] = $rv;
							}
						}
					}
				}
			}
		}
		// echo '<pre>'; print_r($rsys);exit;
		return $rsys;
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
