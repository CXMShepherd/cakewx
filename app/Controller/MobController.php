<?php
App::uses('AppController', 'Controller');

/**
 * Mobile Controller
 *
 * @property Mobile $niancode
 */
class MobController extends AppController {

	public $layout = "mobile";
	public $viewClass = 'Twig.Twig';
	public $appid = "wx708acc93bd6ad1b0";
	public $webchat = "d05a63f65046e95d4d41dc7858aa9624";

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('tw', 'store', 'test', 'activity');
		$this->loadModel("TPerson");
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function index($action) {

		switch ($action) {
			default:
				$tpl = 'index';
				break;
		}

		// Twig View
		$this->set('action', $action);
        $this->set("rooturl", Router::url("/", TRUE));
		$this->set('title', "cakewx");
        $this->set("storeid", "{$id}");
		$this->set("baseurl", Router::url("/mob/store/", TRUE));
		$this->set("baseurlAction", Router::url("/mob", TRUE));
		$this->set('user', $data['userinfo']);
		$this->set('appid', $this->appid);
		$this->LNRender($data, $tpl, 'twig');
	}

	/**
	 * 活动报名
	 *
	 * @return void
	 * @author niancode
	 **/
	public function activity()
	{
        $this->loadModel('WxDataStore');
		$this->loadModel('WxReply');
		$this->loadModel('WxDataUser');
		$this->layout = 'activity';
		$webchatId = $this->request->query['id'];
		$wxCode = $this->request->query['code'];
		$wxState = $this->request->query['state'];
		$debug = $this->request->query['lndebug'];
		$action = $id ? $action : 'index';		// 店铺列表页
		$tpl = $action;

		// Debug
		$this->_debug($debug);

		// Check Weixin Code
		$opens = $this->WxReply->getWpUserInfo('openid', $wxCode, $this->webchat, $this->appid);
		if ($opens['state'] == 1) {
			echo '<pre>';print_r($opens);exit;
			$data = $action == 'index' ? $this->WxDataStore->getDataList($webchatId) : $this->WxDataStore->getDataList(null, $id, 'md5');
			$data['userinfo'] = $this->WxDataUser->getUserInfo($opens['data']['openid'], $webchat, $id);		//个人信息
			// exit;
			$webchat = $data['WxDataStore']['FWebchat'];			// md5 webchat
			if (!$data['count']) {
				$this->set('tips', "对不起，此店铺不存在。");
				$this->render(':Mobile:error.html.twig');
			} else {
				switch ($action) {
					case 'index':			// 店铺列表页
						$data['stores'] = $this->WxDataStore->getStoresByCate($webchatId);
						// echo '<pre>';print_r($data['stores']['cate']);exit;
						break;
					case 'shopping':
						$data['category'] = $this->WxDataStore->getStoreProdcut($data['WxDataStore']['FWebchat'], $id, 'md5');
						// echo '<pre>';print_r($data['category']);exit;
						break;
		            case 'cart':

		                break;
		            case 'ucenter':

		                break;
		            case 'address':

		                break;
		            case 'orders':
						$this->loadModel('WxDataOrder');
						$data['orders'] = $this->WxDataOrder->getDataList($webchat, $id, $opens['data']['openid']);
		                break;
					case 'person':

		                break;
					default:		// 店铺首页
						$tpl = 'view';
						$this->loadModel('WxDataCate');
						$data['accArticle'] = $this->WxDataCate->getArticleByCate($webchat, $id, '公告', 5);
						break;
				}

				// Twig View
				$this->set('action', $action);
                $this->set("rooturl", Router::url("/", TRUE));
				$this->set('title', '活动报名');
                $this->set("storeid", "{$id}");
				$this->set("baseurl", Router::url("/mob/store/", TRUE));
				$this->set("baseurlAction", Router::url("/mob/activity/{$id}", TRUE));
				$this->set("baseurlIndex", Router::url("/mob/activity?={$webchatId}", TRUE));
				$this->set('user', $data['userinfo']);
				$this->set('appid', $this->appid);
				$this->LNRender($data, $tpl, 'twig');
			}
		} else {
			$rduri = urlencode(Router::url("/{$this->request->url}", TRUE));
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$rduri}&response_type=code&scope=snsapi_base&state=idaiyan#wechat_redirect";
			$this->redirect($url);
		}
	}

	/**
	 * 店铺列表页： store?id=:webchatId
	 * 店铺首页：  store/:id
	 * 购物：    store/:id／shopping
	 * 购物车：   store/:id／cart
	 * ...
	 *
	 * @return void
	 * @author niancode
	 **/
    function store($id, $action) {
		$this->loadModel('WxReply');
		$this->loadModel('WxDataUser');
		$this->layout = 'store';
		$webchatId = $this->request->query['id'];
		$wxCode = $this->request->query['code'];
		$wxState = $this->request->query['state'];
		$debug = $this->request->query['lndebug'];
		$action = $id ? $action : 'index';		// 店铺列表页
		$tpl = $action;

		// Debug
		$this->_debug($debug);

		// Check Weixin Code
		$opens = $this->WxReply->getWpUserInfo('openid', $wxCode, $this->webchat, $this->appid);
		if ($opens['state'] == 1) {
			$data = $action == 'index' ? $this->WxDataStore->getDataList($webchatId) : $this->WxDataStore->getDataList(null, $id, 'md5');
			$data['userinfo'] = $this->WxDataUser->getUserInfo($opens['data']['openid'], $webchat, $id);		//个人信息
			// exit;
			$webchat = $data['WxDataStore']['FWebchat'];			// md5 webchat
			if (!$data['count']) {
				$this->set('tips', "对不起，此店铺不存在。");
				$this->render(':Mobile:error.html.twig');
			} else {
				switch ($action) {
					case 'index':			// 店铺列表页
						$data['stores'] = $this->WxDataStore->getStoresByCate($webchatId);
						// echo '<pre>';print_r($data['stores']['cate']);exit;
						break;
					case 'shopping':
						$data['category'] = $this->WxDataStore->getStoreProdcut($data['WxDataStore']['FWebchat'], $id, 'md5');
						// echo '<pre>';print_r($data['category']);exit;
						break;
		            case 'cart':

		                break;
		            case 'ucenter':

		                break;
		            case 'address':

		                break;
		            case 'orders':
						$this->loadModel('WxDataOrder');
						$data['orders'] = $this->WxDataOrder->getDataList($webchat, $id, $opens['data']['openid']);
		                break;
					case 'person':

		                break;
					default:		// 店铺首页
						$tpl = 'view';
						$this->loadModel('WxDataCate');
						$data['accArticle'] = $this->WxDataCate->getArticleByCate($webchat, $id, '公告', 5);
						break;
				}

				// Twig View
				$this->set('action', $action);
                $this->set("rooturl", Router::url("/", TRUE));
				$this->set('title', $data['WxDataStore']['FName']);
                $this->set("storeid", "{$id}");
				$this->set("baseurl", Router::url("/mob/store/", TRUE));
				$this->set("baseurlAction", Router::url("/mob/store/{$id}", TRUE));
				$this->set("baseurlIndex", Router::url("/mob/store?={$webchatId}", TRUE));
				$this->set('user', $data['userinfo']);
				$this->set('appid', $this->appid);
				$this->LNRender($data, $tpl, 'twig');
			}
		} else {
			$rduri = urlencode(Router::url("/{$this->request->url}", TRUE));
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$rduri}&response_type=code&scope=snsapi_base&state=idaiyan#wechat_redirect";
			$this->redirect($url);
		}
    }

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _debug($debug = 0) {
		if ($debug) {
			$this->Session->write('WX_openid', 'oKeG4jhJnE5MYy7Mgo3uuLBkgLb4');
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function tw($id, $cid)
	{
		$this->loadModel("WxDataTw");
		// $id = $id == 'events' ? $cid : $id;
		switch ($id) {
			case 'events':
				// Check Id
				if (!$this->WxDataTw->findById($cid)) {
					$this->flashError("不存在此内容。");
					$this->redirect("/");
				}
				$result = $this->WxDataTw->getDataList(NULL, $cid);
				if ($result['WxDataTw']['FType'] == 0 && $result['WxDataTw']['FTwType'] == 'events') {
					$this->set('title', $result['WxDataTw']['FTitle']);
					$data['title'] = $result['WxDataTw']['FTitle'];
					$data['cover'] = $result['WxDataTw']['FUrl'];
					$data['author'] = $result['WxDataTw']['FAuthor'];
					$data['content'] = $result['WxDataTw']['FContent'];
					$data['memeo'] = $result['WxDataTw']['FMemo'];
					$data['dateline'] = $result['WxDataTw']['FCreatedate'];
					$data['start'] = $result['WxDataTwEvent']['FStartdate'];
					$data['maxpercount'] = $result['WxDataTwEvent']['FMaxPersonCount'];
					$data['address'] = $result['WxDataTwEvent']['FAddress'];
					$data['percount'] = $result['WxDataTwEvent']['FPersonCount'];
					$this->LNRender($data, 'events', 'twig');
				} else {
					exit('error');
				}
				break;
			default:
				// Check Id
				if (!$this->WxDataTw->findById($id)) {
					$this->flashError("不存在此内容。");
					$this->redirect("/");
				}
				$result = $this->WxDataTw->getDataList(NULL, $id);
				$this->set('title', $result['WxDataTw']['FTitle']);
				$data['title'] = $result['WxDataTw']['FTitle'];
				$data['author'] = $result['WxDataTw']['FAuthor'];
				$data['content'] = $result['WxDataTw']['FContent'];
				$data['memeo'] = $result['WxDataTw']['FMemo'];
				$data['dateline'] = substr($result['WxDataTw']['FCreatedate'],0,strpos($result['WxDataTw']['FCreatedate'],' '));
				$this->LNRender($data, 'index', 'twig');
		}
	}

	/**
	 * TEST方法
	 *
	 * @return void
	 * @author niancode
	 **/
	function test()
	{
		$this->loadModel('WxDataUser');
		// $this->WxDataUser->randMemberId();
		$data['T001'] = "123";
		$this->LNRender($data, 'test', 'twig');
	}
}