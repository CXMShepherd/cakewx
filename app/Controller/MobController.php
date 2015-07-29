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
	public $appid = "wxa2345d698a6f2162";
	public $webchat = "ad59dac608c35311d71d11ec89300926";

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

		// Test
		$wx = new Wxauth('cakewx', '', $this->appid, "ad59dac608c35311d71d11ec89300926");
		$wx->dotest();
exit;
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
	public function activity($id, $action)
	{
        $this->loadModel('WxDataStore');
		$this->loadModel('WxReply');
		$this->loadModel('WxDataUser');
		// $this->layout = 'activity';
		$webchatId = $this->request->query['id'];
		$wxCode = $this->request->query['code'];
		$wxState = $this->request->query['state'];
		$debug = $this->request->query['lndebug'];
		$action = $id ? $action : 'index';		// 店铺列表页
		$tpl = $action;

		// Debug
		$this->_debug($debug);

		// Define
		$info = [
			'副会长曹晓春' => "药药药，切克闹，创业疑难杂症那都不是事儿",
			'副会长陈涛' => "我比较实在，做电商黑马们，一起赚钱一起飞！",
			'副会长段毅' => "房地产圈，我熟，房事儿不叫事儿！",
			'副会长郝鸿峰' => "别闹，创业这么苦，解忧唯有。。。",
			'副会长黄梦' => "搞定移动营销，黑马只用H5来嗨！",
			'副会长蒋涛' => "腾飞是个技术问题，我这只有技术男，是不是很有诱惑！",
			'副会长罗军' => "世界那么大你随便看，出差住宿交给我",
			'副会长蒲易' => "不光搞定温饱，我们还能给黑马们搞定爱情，人生巅峰不再遥远！",
			'副会长唐文斌' => "拼颜值的时代，加入黑马，face++帮你搞定“脸”的问题",
			'副会长王国安' => "走上人生巅峰，做牛X的事，兄弟我们一起上！",
			'副会长王宇翔' => "我们负责照顾好你的胃",
			'副会长杨守彬' => "微信红包（字显示：缺钱找我）",
			'副会长杨雪剑' => "买卖的事儿，随时call me",
			'副会长张珺' => "办展览包给我，办展览包给我，办展览包给我，重要的事说三遍！",
			'副会长郑早明' => "黑马创业难题，寻医问药，约我，约我！",
			'会长陈昊芝' => "兄弟们一起打怪升级啦！",
			'会长俞熔' => "身体不行，然并卵，黑马健康的事儿包给我！",
		];

		// Check Weixin Code
		$opens = $this->WxReply->getWpUserInfo('openid', $wxCode, $this->webchat, $this->appid);
		$this->log(var_export($opens, true)."\n", 'wxapi');
		if ($opens['state'] == 1) {
			$opens = $this->WxReply->getWpUserInfo('openid', $wxCode, $this->webchat, $this->appid);
			$openid = $opens['data']['openid'];
			$data = $action == 'index' ? $this->WxDataStore->getDataList($webchatId) : $this->WxDataStore->getDataList(null, $id, 'md5');
			$data['userinfo'] = $this->WxDataUser->getUserInfo($opens['data']['openid'], $webchat, $id);		//个人信息
			$webchat = $data['WxDataStore']['FWebchat'];			// md5 webchat
			if ($data['count']) {
				$this->set('tips', "对不起，此活动不存在。");
				$this->render(':Mobile:error.html.twig');
			} else {
				switch ($action) {
					case 'index':
						$tpl = 'index';
						break;
					case 'member-reg':
						// 存入数据
						$tpl = 'member-reg';
						if ($this->request->is('post')) {
							$data['FullName'] = $this->request->data['name'];
							$data['FPhone'] = $this->request->data['mobile'];
							if ($this->WxDataUser->saveData($openid, $data)) {
								$this->redirect(Router::url("/mob/activity/{$id}/share"));
							}
						}

						$rand_name = array_rand($info, 6);
						$map_func = function($v) use ($info) {
							$re_v = str_replace('副会长', '', $v);
							$re_v = str_replace('会长', '', $re_v);
							return [
								'name' => $re_v,
								'avatar' => $v,
								'value' => $info[$v]
							];
						};
						$rand_info = array_map($map_func, $rand_name);
						$this->set('rand_info', $rand_info);
						break;
					case 'groupchat':
						$rand_name = array_rand($info);
						$rand_info = [
							'name' => $rand_name,
							'value' => $info[$rand_name]
						];
						$this->set('rand_info', $rand_info);
						$tpl = 'groupchat';
						break;
					case 'video':
						$tpl = 'video';
						break;
					case 'share':
						$tpl = 'share';
						break;
					case 'ticket':
						$tpl = 'ticket';
						break;
					default:
						$tpl = 'index';
						break;
				}

				// Twig View
				$title = '活动报名';
				$this->set('action', $action);
                $this->set("rooturl", Router::url("/", TRUE));
				$this->set('title', $title);
                $this->set("storeid", "{$id}");
				$this->set("baseurl", Router::url("/mob/activity/", TRUE));
				$this->set("baseurlAction", Router::url("/mob/activity/{$id}", TRUE));
				$this->set("baseurlIndex", Router::url("/mob/activity?={$webchatId}", TRUE));
				$this->set('user', $data['userinfo']);
				$this->set('appid', $this->appid);
				// Share
				$this->set('share_link', Router::url("/mob/activity/{$id}", TRUE));
				$this->set('share_title', $title);
				$this->set('share_des', "黑马会领券活动");
				$this->set('share_logo', '/img/activity/sharepic.jpg');
				$this->LNRender($data, $tpl, 'twig');
			}
		} else {
			$rduri = urlencode(Router::url("/{$this->request->url}", TRUE));
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$rduri}&response_type=code&scope=snsapi_userinfo&state=iheima#wechat_redirect";
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
			$rduri = urlencode(Router::url("/{$this->request->url}/", TRUE));
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
			// $this->Session->write('WX_openid', 'oXVUJQEm4mEN7KsdM1PNXfxQtkFU');
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