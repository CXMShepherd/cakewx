<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxReply extends AppModel {

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public $msType = 'text';
	public $useTable = FALSE;
	public $_WX;

	/**
	 * 微信valid
	 *
	 * @return void
	 * @author niancode
	 **/
	function wx_valid() {
		$wx = new Wxauth();
		return $wx->wx_valid();
	}

	/**
	 * 检查Appid和Appsecret
	 *
	 * @return void
	 * @author niancode
	 **/
	function _checkAppidSecret($webchat, $appid, $appsecret) {
		if ($appid && $appsecret) {
			$this->_WX = new Wxauth('liunian', $webchat, $appid, $appsecret);
			$msg = TRUE;
		} else {
			$msg = array('state' => 0, 'msg' => "请先在系统设置中配置好appid和appsecret。");
		}
		return $msg;
	}

	/**
	 * 保存菜单
	 *
	 * @return void
	 * @author niancode
	 **/
	function saveMenus($webchat, $appid, $appsecret)
	{
		$check = $this->_checkAppidSecret($webchat, $appid, $appsecret);
		if (!is_array($check)) {
			$data = ClassRegistry::init('WxDataMus')->getMenuApi($webchat);
			return $this->_WX->saveMenus($data, 0);		// debug..
		}
		return $check;
	}

	/**
	 * 获取关注者列表
	 *
	 * @return void
	 * @author niancode
	 **/
	function getFollows($webchat, $appid, $appsecret)
	{
		$check = $this->_checkAppidSecret($webchat, $appid, $appsecret);
		if (!is_array($check)) {
			return $this->_WX->getFollows(0);		// debug..
		}
		return $check;
	}

	/**
	 * 发送图文／文本消息
	 *
	 * @return void
	 * @author niancode
	 **/
	function sendall($webchat, $appid, $appsecret, $type, $data) {
		$check = $this->_checkAppidSecret($webchat, $appid, $appsecret);
		if (!is_array($check)) {
			switch ($type) {
				case 0:
					$msg = $this->_WX->sendMsgText($data, 0);
					break;
				case 1:
					$data = ClassRegistry::init('WxDataTw')->getSendTwMsg($data);
					$msg = $this->_WX->sendMsgTw($data['items'], 0);
					break;
				default:

			}
			return $msg;
			// return $this->_WX->getFollows(0);		// debug..
			// echo '<pre>';print_r($return);exit;
		}
		return $check;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getWpUserInfo($type = 'openid', $code, $webchat, $appid) {
		App::uses("CakeSession", "Model/Datasource");
		$this->Session = new CakeSession();
		// echo $this->Session->read('WX_openid');exit;
		$userinfo = ClassRegistry::init('WxDataUser')->getUserInfo($this->Session->read('WX_openid'));
		if (isset($userinfo['FOpenId'])) {
			return array('state' => 1, 'data' => array('openid' => $this->Session->read('WX_openid')));
		} else {
			$this->_WX = new Wxauth('liunian', $webchat, $appid, "a1cc4aa247606645bcfe14f8654b2639");
			$data = $this->_WX->getWpUserInfo($type, $code);
			if ($data['state'] == 1) {
				$this->Session->write('WX_openid', $data['data']['openid']);
			}
			return $data;
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getSessOpenId() {
		App::uses("CakeSession", "Model/Datasource");
		$this->Session = new CakeSession();
		if ($this->Session->read('WX_openid')) {
			return $this->Session->read('WX_openid');
		}
	}

	/**
	 * 初始化
	 *
	 * @return void
	 * @author apple
	 **/
	function init($xmlData) {
		$this->xmlData = $xmlData;
		$this->fromUsername = $xmlData->FromUserName;
		$this->toUsername = $xmlData->ToUserName;
		$this->keyword = trim($xmlData->Content);
		$this->time = time();
		$this->msType = trim($xmlData->MsgType);
		$this->event = $xmlData->Event;
		$this->eventKey = $xmlData->EventKey;
		$this->webchat = ClassRegistry::init('WxWebchat')->getWxId($this->toUsername);

		// Senior API
		$this->msgid = $xmlData->MsgID;
		$this->totalCount = $xmlData->TotalCount;
		$this->filterCount = $xmlData->FilterCount;
		$this->sentCount = $xmlData->SentCount;
		$this->errorCount = $xmlData->ErrorCount;
		$this->status = $xmlData->Status;
	}

	/**
	 * 自动回复
	 *
	 * @return void
	 * @author apple
	 **/
	function getReply($xmlData) {
		$this->init($xmlData);				// 初始化WX_DATA
		$resultStr = "";
		if ($this->webchat) {
			switch ($this->msType) {
				case 'event':
					if ($this->event == 'subscribe') {
						$vars['keyword'] = $this->keyword;
						$wxData = ClassRegistry::init('WxWebchat')->getMsg('subscribe', $vars, $this->toUsername);
						$wxData = str_replace(PHP_EOL, '', $wxData);
						$resultStr = $this->_getTPL($wxData['type'], $wxData);
					} else if ($this->event == 'CLICK') {
						$vars['keyword'] = $this->eventKey;
						$wxData = ClassRegistry::init('WxWebchat')->getMsg("text", $vars, $this->toUsername);
						$wxData = str_replace(PHP_EOL, '', $wxData);
						$resultStr = $this->_getTPL($wxData['type'], $wxData);
					} else if ($this->event == 'MASSSENDJOBFINISH') {
						$data['FSentCount'] = $this->sentCount;
						$data['FTotalCount'] = $this->totalCount;
						$data['FilterCount'] = $this->filterCount;
						$data['FErrorCount'] = $this->errorCount;
						$data['FError'] = $this->status;
						ClassRegistry::init('WxDataSent')->callbackSent($this->msgid, $data);
					}
					break;
				default:
					$vars['keyword'] = $this->keyword;
					$wxData = ClassRegistry::init('WxWebchat')->getMsg("text", $vars, $this->toUsername);
					$wxData = str_replace(PHP_EOL, '', $wxData);
					$resultStr = $this->_getTPL($wxData['type'], $wxData);
			}
		} else {
			$resultStr = $this->_getTPL('text', array('data' => "亲，您的账号还没有配置成功。［CakeWX］"));
		}
		return $resultStr;
	}

	/**
	 * 获取TPL模板数据
	 *
	 * @return void
	 * @author apple
	 **/
	function _getTPL($msgType = 'text', $data) {
		extract($data, EXTR_PREFIX_ALL, "WX");
		$wxTpl = array(
					'text' => "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<Content><![CDATA[%s]]></Content>
								<FuncFlag>0</FuncFlag>
								</xml>",
					'news' => "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<ArticleCount>%s</ArticleCount>
								<Articles>
								%s
								</Articles>
								</xml>"
				);
		$resultStr = "";
		$wxTpl = $wxTpl[$msgType];
		switch ($msgType) {
			case 'text':
				$resultStr = sprintf($wxTpl, $this->fromUsername, $this->toUsername, $this->time, $msgType, $WX_data);
				break;
			case 'news':
				$WX_suffixTpl = "";
				$WX_itemTpl = "<item>
				<Title><![CDATA[%s]]></Title>
				<Description><![CDATA[%s]]></Description>
				<PicUrl><![CDATA[%s]]></PicUrl>
				<Url><![CDATA[%s]]></Url>
				</item>";
				foreach ($WX_data['items'] as $key => $vals) {
					$WX_suffixTpl .= sprintf($WX_itemTpl, $vals['Title'], $vals['Description'], $vals['PicUrl'], $vals['Url']);
				}
				$resultStr = sprintf($wxTpl, $this->fromUsername, $this->toUsername, $this->time, $msgType, $WX_data['ArticleCount'], $WX_suffixTpl);
				break;
			default:
		}
		return $resultStr;
	}
}
