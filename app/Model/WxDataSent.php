<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataSent extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_sent';

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
	    'FType' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    ),
		'FSentMsg' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
	public $type = array('0' => "文本", '1' => "图文");
	public $status = array('0' => "发送失败", '1' => "发送中", '2' => "发送成功");
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($id, $msgid)
	{	
		if ($this->data['WxDataSent']['FType'] == 1) {
			$twid = reset($this->data['WxDataSent']['FTwj']);
			$twdata = ClassRegistry::init('WxDataTw')->getDataList($id, $twid);
			// echo '<pre>'; print_r($twdata);exit;
			if (isset($twdata['WxDataTw'])) {
				$twitem = $twdata['WxDataTw'];
				$data['Title'] = $twitem['FTitle'];
				$data['PicUrl'] = $twitem['FUrl'];
				$data['Url'] = $twitem['FPreview_nlik'];
				$data['Message'] = $twitem['FContent'];
				$this->set('FSentMsg', serialize($data));
			}
		} 
		$this->set('FMsgId', $msgid);
		$this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		$this->set('FStatus', 1);
		$query = $this->save($this->data);
		if ($query) return $this->id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function callbackSent($msgid, $data)
	{
		$stlist = $this->find('all', array('conditions' => array('FMsgId' => $msgid), 'recursive' => 0));
		if ($stlist[$this->name]['Id']) {
			$this->id = $stlist[$this->name]['Id'];
			$this->set($data);
			switch ($data['FError']) {
				case 'send success':
					$this->set('FStatus', 2);
					break;
				default:
			}
			$this->save($this->data, FALSE);
			return TRUE;
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
	    return $this->_unserdata($data);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _unserdata($data)
	{
		foreach ($data as $key => &$vals)
		{	
			$vals[$this->name]['FSentMsg'] = $vals[$this->name]['FType'] == 1 ? unserialize($vals[$this->name]['FSentMsg']) : $vals[$this->name]['FSentMsg'];
			$vals[$this->name]['C_FType'] = $this->type[$vals[$this->name]['FType']];
			$vals[$this->name]['C_FStatus'] = $this->status[$vals[$this->name]['FStatus']];
			if (is_array($vals[$this->name]['FSentMsg'])) {
				foreach ($vals[$this->name]['FSentMsg'] as $k => $v) {
					$v['PicUrl'] = Router::url($v['PicUrl'], TRUE);
					$v['Url'] = Router::url($v['Url'], TRUE);
				}
			}
			$vals[$this->name]['C_Text'] = $vals[$this->name]['FType'] == 1 ? $vals[$this->name]['FSentMsg']['Title'] : $vals[$this->name]['FSentMsg'];
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
