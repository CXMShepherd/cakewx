<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataUser extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_users';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'FOpenId';

	/**
	 * undocumented variable
	 *
	 * @var string
	 */
	public $validate = array(
	    'FNickname' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    )
	);

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($id, $data = [])
	{
		$userid = $this->_randMemberId();
		$read = $this->read(null, $id);

		if ($read) {
			$this->set($data);
			$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		} else {
			$this->set($data);
			$this->set('FMemberId', $userid);
			$this->set('FCreatedate', date('Y-m-d H:i:s'));
			$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		}

		$query = $this->save($this->data);
		if ($query) return $this->id;
	}

	/**
	 * 获取用户信息
	 *
	 * @return void
	 * @author
	 **/
	public function getUserByOpenid($openid)
	{
		$result = $this->find('first', array('conditions' => array('FOpenId' => $id), 'recursive' => 0));
		return $result;
	}

    /**
     * undocumented function
     *
     * @return void
     * @author apple
     **/
    function saveUser($data)
    {
        $this->set($data);
        if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
        $this->set('FUpdatedate', date('Y-m-d H:i:s'));
        $query = $this->save($this->data, FALSE);
        if ($query) return $this->id;
    }

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getUserInfo($id, $webchat = null, $storeId = null) {
		$data = $this->find('first', array('conditions' => array('FOpenId' => $id), 'recursive' => 0));
		$data = $data[$this->name];
		$data['isFirstOrder'] = $storeId ? ClassRegistry::init('WxDataOrder')->getDataList($webchat, $storeId, $id) : 0;
		// echo '<pre>';print_r(ClassRegistry::init('WxDataOrder')->getDataList($webchat, $storeId, $id));
		$data['isFirstOrder'] = empty($data['isFirstOrder']['count']) ? 1 : 0;
		return $data;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _randMemberId() {
		$data = $this->find('first', array('fields' => array("CONVERT(`FMemberId`,SIGNED) as FMemberId"), 'order' => "FMemberId DESC", 'group' => "FMemberId", 'recursive' => 0));
		$userid = reset(reset($data));
		return $userid ? intval($userid) + 1 : 10000;
	}

	/**
	 * Overridden paginate method - group by week, away_team_id and home_team_id
	 */
	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array())
	{
	    $recursive = -1;
	    $order = array('FCreatedate' => 'DESC');
		$data = $this->find(
	        'all',
	        compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive', 'group')
	    );
		foreach ($data as $key => &$vals)
		{
			$vals['WxDataUser']['Headimgurl_96'] = $vals['WxDataUser']['FHeadimgurl'] ? substr($vals['WxDataUser']['FHeadimgurl'], 0, -1).'96' : Router::url('/img/avatar/noimg.jpg', TRUE);
			$vals['WxDataUser']['FSubscribe_time'] = date('Y-m-d H:i:s', $vals['WxDataUser']['FSubscribe_time']);
		}
		//echo '<pre>';print_r($data);exit;
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
			$data = $this->find('first', array('conditions' => array('FOpenId' => $cid, 'FWebchat' => $id), 'recursive' => 0));
			if (is_array($data)) {
				$data['WxDataUser']['FSubscribe_time'] = $data['WxDataUser']['FSubscribe_time'] ? date('Y-m-d H:i:s', $data['WxDataUser']['FSubscribe_time']) : '';
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
