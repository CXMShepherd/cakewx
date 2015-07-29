<?php
App::uses('CakeSession', 'Model/Datasource');
App::uses('ClassRegistry', 'Utility');

//define your token
define("APPID", "wx903c19fcf0626385");
define("APPSECRET", "4f9734b004e3944872f3e72039e3a28f");
define("TOKEN", "ohnuw2oob0Aiweequoh3");
include ("lib/func.php");
include ("lib/curl.php");
$userinfo = array();
$cl = new Curl();
// $code = isset($_GET['code']) ? $_GET['code'] : FALSE;
// $wechatObj = new wechatCallbackapiTest();
// $userinfo = $wechatObj->getUserInfo($aToken, $openId);

// ====================class
class wechatCallbackapiTest
{
	var $token = '';

	public function wx_valid()
	{
		if($this->checkSignature()){
        	$echoStr = $_GET["echostr"];
			echo $echoStr;
        	exit;
        }
	}

	public function valid()
    {
        if($this->checkSignature()){
        	return TRUE;
        }
    }

	public function setGloabl($data)
	{
		while (list($key, $vals) = each($data))
		{
			$this->$key = $vals;
		}
	}

	public function getUserInfo()
	{
		$code = isset($_GET['code']) ? $_GET['code'] : FALSE;
		if (!$code) return FALSE;
		$acode = $this->getAccessCode($code);
		$aToken = $acode['access_token'];
		$openId = $acode['openid'];
		if ($aToken && $openId)
		{
			$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$aToken}&openid={$openId}&lang=zh_CN";
			$data = curlData($url);
			return $data;
		}
	}

	/**
	 * 菜单功能
	 *
	 * @return void
	 * @author niancode
	 **/
	public function saveMenus($mdata, $debug = 0) {
		$aToken = $this->getAccessCode();
		if (!is_array($aToken)) {
			$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$aToken}";
			$data = curlData($url, $mdata, 'POST', $debug);
			// print_r($data);
			if ($data['errcode'] == 0) {
				$msg['state'] = 1;
				return $msg;
			} else {
				$msg['state'] = 0;
				$msg['msg'] = "错误：{$data['errcode']}，{$data['errmsg']}";
				return $msg;
			}
		} else {
			$msg['state'] = 0;
			$msg['msg'] = $aToken['msg'];
			return $msg;
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getFollows($debug = 0, $userinfo = 1)
	{
		$aToken = $this->getAccessCode();
		if (!is_array($aToken)) {
			$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$aToken}&next_openid=";
			$data = curlData($url, '', 'GET', $debug);
			$data['data']['openid'] = array_slice($data['data']['openid'], 0, 10);
			// echo '<pre>';print_r($data);exit;
			// print_r($data);exit;
			if (!isset($data['errcode'])) {
				if (is_array($data['data']['openid']) && $userinfo) {
					foreach ($data['data']['openid'] as $key => &$vals) {
						$this->_getWxUsers($aToken, $vals);		// 获取用户信息
					}
				}
				$msg['state'] = 1;
				$msg['data'] = $data;
				return $msg;
			} else {
				$msg['state'] = 0;
				$msg['msg'] = "错误：{$data['errcode']}，{$data['errmsg']}";
				return $msg;
			}
		} else {
			$msg['state'] = 0;
			$msg['msg'] = $aToken['msg'];
			return $msg;
		}
	}

	/**
	 * 群发文本消息
	 *
	 * @return void
	 * @author niancode
	 **/
	function sendMsgText($data, $debug = 0)
	{
		$aToken = $this->getAccessCode();
		if (!is_array($aToken)) {
			$allusers = $this->getFollows(0, 0);
			if ($allusers['state'] == 1) {
				$url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$aToken}";
				// $stsdata['touser'] = $allusers['data']['data']['openid'];
				$stsdata['touser'] = array('oY229t4APS29cHtoZw8NI6oQjp7Y');
				$stsdata['text'] = array('content' => $data);
				$stsdata['msgtype'] = "text";
				$view = new View();
				$main = $view->loadHelper('Main');
				$stsdata = $main->decodeUnicode(json_encode($stsdata));
				$stscase = curlData($url, $stsdata, 'POST', $debug);
				if ($stscase['errcode'] == 0) {
					return array('state' => 1, 'data' => $stscase);
				} else {
					return array('state' => 0, 'msg' => $case['errmsg']);
				}
			} else {
				return array('state' => 0, 'msg' => $allusers['msg']);
			}
		} else {
			return $aToken;
		}
	}

	/**
	 * 群发图文消息
	 *
	 * @return void
	 * @author niancode
	 **/
	function sendMsgTw($data, $debug = 0)
	{
		$aToken = $this->getAccessCode();
		if (!is_array($aToken)) {
			$view = new View();
			$main = $view->loadHelper('Main');
			$sentdata = array('articles' => array());
			$st = &$sentdata['articles'];
			foreach ($data as $key => $vals) {
				$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$aToken}&type=image";
				$params['media'] = "@{$vals['FUrl']}";
				$case = curlData($url, $params, 'POST', $debug, array(), 0);
				if (!isset($case['errcode'])) {
					$st[$key]['thumb_media_id'] = $case['media_id'];
					$st[$key]['author'] = $vals['Author'];
					$st[$key]['title'] = $vals['Title'];
					$st[$key]['content_source_url'] = $vals['FReLink'];
					$st[$key]['content'] = $vals['Content'];
					$st[$key]['digest'] = $vals['Description'];
					$st[$key]['show_cover_pic'] = $vals['Coverd'];
				} else {
					return array('state' => 0, 'msg' => $case['errmsg']);
				}
			}
			$sentdata = $main->decodeUnicode(json_encode($sentdata));			// 去掉JSON转义
			$url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token={$aToken}";
			$stcase = curlData($url, $sentdata, 'POST', $debug);
			if (!isset($stcase['errcode'])) {
				$allusers = $this->getFollows(0, 0);
				if ($allusers['state'] == 1) {
					$url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$aToken}";
					// $stsdata['touser'] = $allusers['data']['data']['openid'];
					$stsdata['touser'] = array('oY229t4APS29cHtoZw8NI6oQjp7Y');
					$stsdata['mpnews'] = array('media_id' => $stcase['media_id']);
					$stsdata['msgtype'] = "mpnews";
					$stsdata = json_encode($stsdata);
					$stscase = curlData($url, $stsdata, 'POST', $debug);
					if ($stscase['errcode'] == 0) {
						return array('state' => 1, 'data' => $stscase);
					} else {
						return array('state' => 0, 'msg' => $case['errmsg']);
					}
				} else {
					return array('state' => 0, 'msg' => $allusers['msg']);
				}
			} else {
				return array('state' => 0, 'msg' => $case['errmsg']);
			}
			// echo '<pre>';print_r($stscase);
			// echo $aToken;
		} else {
			return $aToken;
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function getWpUserInfo($type, $code) {
		$appid = $this->appid;
		$secret = $this->appsecret;
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
		$data = curlData($url);
		if (isset($data['access_token'])) {
			$aToken = $data['access_token'];
			$openid = $data['openid'];
			$this->_getWxUsers($aToken, $openid);		// 获取用户信息
			$msg = $data['openid'];
			$msg = array('state' => 1, 'data' => array('openid' => $data['openid']));
		} else {
			$msg = array('state' => 0, 'msg' => "错误：appid不正确。");
		}
		return $msg;
	}

	public function getAccessCode($force = 0)
	{
		$msg = "";
		$appid = $this->appid;
		$secret = $this->appsecret;
		$time = time();
		ClassRegistry::init('WxSession')->setWxId($this->webchat);
		$sess = ClassRegistry::init('WxSession')->read("WX.AccessCode");
		$expires = $force ? 10 : ($sess['expires_in'] - 10);
		if (isset($sess['access_token']) && ($time - $sess['dateline']) < $expires) {
			$msg = $sess['access_token'];
		} else {
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
			$data = curlData($url);
			$data['dateline'] = time();
			if (isset($data['access_token'])) {
				ClassRegistry::init('WxSession')->write("WX.AccessCode", $data);
				$msg = $data['access_token'];
			} else {
				$msg = array('state' => 0, 'msg' => "appid和appsecret配置不正确。");
			}
		}
		// print_r($msg);exit;
		return $msg;
	}

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){

              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				if(!empty( $keyword ))
                {
					$rsStr = array(
									'流年' => "如花美眷，似水流年。",
									'ln' => "如花美眷，似水流年。",
								);
					$contentStr = $rsStr[$keyword];
					if (!in_array($keyword, array_keys($rsStr)))
					{
						$contentStr = "你好，我是流年小秘书。";
					}
              		$msgType = "text";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }

    /**
	 * 获取用户信息
	 *
	 * @return void
	 * @author
	 **/
	private function _getWxUsers($token, $openid)
	{
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$openid}&lang=zh_CN";
		$user = curlData($url, '', 'GET', $debug);
		file_put_contents('/tmp/wxapi.log', $url);
		if (!isset($user['errcode'])) {
			$vals = $user;
			$user['nickname'] = $this->_preg_nickname($user['nickname']);
			$ds['FOpenId'] = $user['openid'];
			$ds['FSubscribe'] = $user['subscribe'];
			$ds['FNickname'] = $user['nickname'];
			$ds['FSex'] = $user['sex'] == 1 ? '男' : ($user['sex'] == 2 ? '女' : '');
			$ds['FLanguage'] = $user['language'];
			$ds['FCity'] = $user['city'];
			$ds['FProvince'] = $user['province'];
			$ds['FCountry'] = $user['country'];
			$ds['FHeadimgurl'] = $user['headimgurl'];
			$ds['FSubscribe_time'] = $user['subscribe_time'];
			$ds['FWebchat'] = $this->webchat;
			ClassRegistry::init('WxDataUser')->saveData($user['openid'], $ds);			// 写入数据库
		}
	}

	/**
	 * 替换昵称
	 *
	 * @return void
	 * @author
	 **/
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

		$token = $this->token;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	private function _preg_nickname($nickname)
	{
		return preg_replace('~\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]~', '', $nickname);
	}
}

?>