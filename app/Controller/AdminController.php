<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class AdminController extends AppController {

	public $components = array('Paginator');
	public $helpers = array('Array', 'Main', 'Html', 'AssetCompress.AssetCompress');
	public $layout = "admin";
	public $paginate = array(
		'maxLimit' => 500,
		'limit' => 10,
		// 'paramType' => 'querystring',
		'order' => array(
			'FCreatedate' => 'desc'
		)
    );
	var $validate = array();
	var $toAccount = 1;
	var $wxId = '';
	var $rdBaseURL = '';
	var $wcdata;
	var $appid = '';		// appid
	var $appsecret = '';		// appsecret

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->loadModel('TPerson');
		$this->loadModel('WxWebchat');
		$this->Auth->deny('index');
		$this->vmenu = $this->WxWebchat->getmenus('hmenu');
	}

	public function beforeRender() {
		// Check center
		if ($this->wxId && !$this->WxWebchat->checkWebchat($this->wxId, $this->uid, 'md5')) {
			return $this->redirect(array('action' => "index"));
		}
		$this->set('menutype', $this->wxId ? 'vmenu' : 'hmenu');
		$this->set('wxId', $this->wxId);
		$this->set('vurl', $this->vurl);
		$this->set('vmenu', $this->vmenu);
		$this->set('wxURL', $this->wxAPI);
		$this->set('wxToken', $this->wxToken);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/

	function wc($id) {
		$this->wxId = $id;
		$this->vmenu = $this->WxWebchat->getmenus('vmenu', $this->wxId);
		$wcdata = $this->WxWebchat->getWebchatList($this->uid, $id, 'md5');
		$wxId = $wcdata['WxWebchat']['Id'];
		$action = $this->request->params['pass'][1];
		$this->rdBaseURL = Router::url("/admin/wc/{$id}/", TRUE);
		$this->rdWcURL = Router::url("/admin/wc/{$id}/{$action}", TRUE);
		$this->rdMobURL = Router::url("/mob/", TRUE);
		$this->wcdata = $wcdata;
		$this->appid = $this->wcdata['WxWebchat']['FWxAppId'];		// appid
		$this->appsecret = $this->wcdata['WxWebchat']['FWxAppSecret'];		// app secret
		$query['mod'] = isset($this->request->query['_m']) ? $this->request->query['_m'] : '';
		$query['action'] = isset($this->request->query['_a']) ? $this->request->query['_a'] : '';
		$query['id'] = isset($this->request->query['_id']) ? $this->request->query['_id'] : '';
		$query['value'] = isset($this->request->query['_val']) ? $this->request->query['_val'] : '';
		$this->set('WC_BASE', $this->rdBaseURL);
		$this->set('WC_URL', $this->rdWcURL);
		$this->set('WC_MOBURL', $this->rdMobURL);
		$this->set('WC_query', $query);
		$this->set('WC_data', $wcdata);
		$this->set('WC_wxId', $wxId);

		// Check WebchatId
		if (!$wxId) return $this->redirect("/admin");

		// Load func
		if (!method_exists($this, "_{$action}")) {
			return $this->redirect("/admin/wc/{$id}/center");
		} else {
			return call_user_func(array($this, "_{$action}"), $id, $query, $wxId);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function index() {
		$this->loadModel('WxWebchat');
		$this->paginate['limit'] = 5;
		$this->Paginator->settings = $this->paginate;
		$data['datalist'] = $this->Paginator->paginate('WxWebchat', array('FPerson' => $this->uid));
		$this->toAccount = $this->isAdmin ? "1314" : $this->toAccount;
		$data['leavecount'] = $this->toAccount - intval(count($data['datalist']));
		$this->vmenu = $this->WxWebchat->getmenus('hmenu');
		$this->vurl = Router::url(array('controller' => "admin", 'action' => "basic"));
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _center($id) {
		return $this->redirect($this->rdBaseURL.'sAroz');
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _sAroz($id, $query, $wxId) {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->WxWebchat->set($this->request->data);
			if ($this->WxWebchat->validates(array('fieldList' => array('FWxType', 'FWxAppId', 'FWxAppSecret')))) {
				$this->WxWebchat->id = $wxId;
				$query = $this->WxWebchat->saveWebchat($this->request->data, $this->uid);
				if ($query) {
					$this->Session->setFlash('操作成功。');
					return $this->redirect($this->rdWcURL);
				}
			} else {
				$rData['WxWebchat']['FWxType']  = $this->request->data['WxWebchat']['FWxType'];
				$this->request->data = $rData;
			}
		} else {
			if (!$this->request->data) {
				$this->request->data = $this->wcdata;
			}
		}
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _sLayout() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bCtg($id, $query) {
		$this->loadModel('WxWcdata');
		switch ($query['mod']) {
			case 'follow':
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FFollowType', 'FFollowContent')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('被关注回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
					}
				}
				break;
			case 'mch':
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FDefaultType', 'FDefaultContent')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('无匹配回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data || $this->request->is('put')) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
					}
				}
				break;
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data || $this->request->is('put')) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
					}
				}
		}
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bFllow($id, $query) {
		$this->loadModel('WxWcdata');
		switch ($query['action']) {
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
					//print_r($this->request->data);exit;
                    if (isset($this->request->data['WxWcdata']['FTwj'][0])) {
                        $this->request->data['WxWcdata']['FFollowId'] = $this->request->data['WxWcdata']['FTwj'][0];
                    }
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FFollowType')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('被关注回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
						$this->request->data['WxWcdata']['FPreTwj'] = $datalist['WxWcdata']['FFollowId'];
						// echo '<pre>';print_r($this->request->data);exit;
					}
				}
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bMch($id, $query) {
		$this->loadModel('WxWcdata');
		switch ($query['action']) {
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->request->data['WxWcdata']['FTwj'][0])) {
                        $this->request->data['WxWcdata']['FDefaultId'] = $this->request->data['WxWcdata']['FTwj'][0];
                    }
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FDefaultType')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('无匹配回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data || $this->request->is('put')) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
						$this->request->data['WxWcdata']['FPreTwj'] = $datalist['WxWcdata']['FDefaultId'];
					}
				}
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bKds($id, $query) {
		$this->loadModel('WxDataKds');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxDataKds->set($this->request->data);
					if ($this->WxDataKds->validates(array('fieldList' => array('FKey', 'FKeyMacth', 'FType')))) {
						$query = $this->WxDataKds->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('关键字添加成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = array('WxWebchat' => array('FWxApi' => $this->wxAPI, 'FWxToken' => $this->wxToken));
					}
				}
				$this->LNRender($data, 'add');
				break;
			case 'edit':
				if (!$this->WxDataKds->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataKds->set($this->request->data);
					if ($this->WxDataKds->validates(array('fieldList' => array('FKey', 'FKeyMacth', 'FType')))) {
						$this->WxDataKds->id = $query['id'];
						$query = $this->WxDataKds->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('关键字编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataKds->getDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}
				$this->LNRender($data, 'add');
				break;
			case 'del':
				if (!$this->WxDataKds->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataKds->delete($query['id'])) {
					$this->Session->setFlash('微信公众账号删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$data['datalist'] = $this->Paginator->paginate('WxDataKds', array('FWebchat' => $id));
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bLbs() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bSvc() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mTxt($id, $query) {
		switch ($query['action']) {
			case 'add':
				$this->loadModel('WxDataWb');
				if ($this->request->is('post')) {
					$this->WxDataWb->set($this->request->data);
					if ($this->WxDataWb->validates()) {
						$query = $this->WxDataWb->saveWcdata($this->request->data, $this->uid);
						if ($query) {
							$this->Session->setFlash('微信公众账号添加成功。');
							return $this->redirect(array('action' => 'index'));
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = array('WxWebchat' => array('FWxApi' => $this->wxAPI, 'FWxToken' => $this->wxToken));
					}
				}
				$this->LNRender($data, 'add');
				break;
			case 'edit':
				$this->loadModel('WxDataWb');
				if (!$this->WxDataWb->checkWebchat($id, $this->uid)) return $this->redirect(array('action' => "webchatAdd"));
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataWb->set($this->request->data);
					if ($this->WxDataWb->validates()) {
						$this->WxDataWb->id = $id;
						$query = $this->WxDataWb->saveWebchat($this->request->data, $this->uid);
						if ($query) {
							$this->Session->setFlash('微信公众账号编辑成功。');
							return $this->redirect(array('action' => 'index'));
						}
					}
				} else {
					if (!$this->request->data) {
						$data['list'] = $this->WxDataWb->getWebchatList($this->uid, $id);
				        $this->request->data = $data['list'];
				    }

				}
				$this->LNRender($data, 'add');
				break;
			default:
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mPic($id, $query) {
		$this->loadModel('WxDataTw');
		$this->loadModel('WxDataTwEvent');
		$this->loadModel('WxDataCate');
		$this->loadModel('WxDataMenu');
		$twTpl = array(
			'tw' => '<div class="media_preview_area" id="%s">
                        <div class="appmsg editing">
                            <div id="js_appmsg_preview" class="appmsg_content">
                                <div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
                                    <h4 class="appmsg_title"><a href="%s" target="_blank">%s</a></h4>
                                    <div class="appmsg_info">
                                        <em class="appmsg_date">%s</em>
                                    </div>
                                    <div class="appmsg_thumb_wrp">
                                        <img class="js_appmsg_thumb appmsg_thumb" src="%s">
                                    </div>
                                    <p class="appmsg_desc">%s</p>
                                </div>
                            </div>
                            <div class="com_mask"></div>
                             <i class="icon_item_selected"><span class="delitem">删除</span><span class="pipe">|</span><span class="editem">修改</span></i>
                       </div>
                    </div>&nbsp;',
			'twj_header' => '<div class="media_preview_area" id="%s">
						<div class="appmsg multi editing">
				       		<div id="js_appmsg_preview" class="appmsg_content">
								<div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
									<div class="appmsg_info">
			                    		<em class="appmsg_date"></em>
			                		</div>
			                		<div class="cover_appmsg_item">
			                    		<h4 class="appmsg_title"><a href="%s" target="_blank">%s</a></h4>
			                    		<div class="appmsg_thumb_wrp">
			                        		<img class="js_appmsg_thumb appmsg_thumb" %s src="%s">
			                    		</div>
			                		</div>
							    </div>',
			'twj_wrap' => '<div id="appmsgItem2" data-fileid="" data-id="2" class="appmsg_item js_appmsg_item">
								<img class="js_appmsg_thumb appmsg_thumb" %s src="%s">
			               		<i class="appmsg_thumb default" %s>缩略图</i>
			                	<h4 class="appmsg_title"><a href="%s" target="_blank">%s</a></h4>
			            	</div>',
			'twj_footer' => '</div><div class="com_mask"></div><i class="icon_item_selected">修改</i></div></div>&nbsp;'
		);

		// Left Nav
		$data['leftNav'] = array(
			//'lhome' => array('name' => "分类设置", 'default' => TRUE, 'icon' => "pink icon-dashboard bigger-110"),
			//'ldp001' => array('name' => "菜单设置", 'icon' => "blue icon-user bigger-110"),
			//'ldp002' => array('name' => "评论设置", 'icon' => "icon-rocket bigger-110"),
		);

		// Action Start
		switch ($query['action']) {
			case 'add':
				if ($query['mod'] == 'tw') {
					if ($this->request->is('post')) {
						$this->request->data['WxDataTw']['FType'] = 0;
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates()) {
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$data['cates'] = $this->WxDataCate->getOptionsCates($id);
					$this->LNRender($data, 'addTw');
				} else if ($query['mod'] == 'twj') {
					if ($this->request->is('post')) {
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->LNRender($data, 'addTwj');
				} else if ($query['mod'] == 'event') {
					if ($this->request->is('post')) {
						$this->request->data['WxDataTw']['FType'] = 0;
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates()) {
							$this->WxDataTwEvent->set($this->request->data);
							if ($this->WxDataTwEvent->validates()) {
								$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
								if ($query) {
									$this->Session->setFlash('图文添加成功。');
									return $this->redirect($this->rdWcURL);
								}
							}
						}
					}
					$data['cates'] = $this->WxDataCate->getOptionsCates($id, 1);
					$this->LNRender($data, 'addEvent');
				} else if ($query['mod'] == 'product') {
					if ($this->request->is('post')) {
						$this->request->data['WxDataTw']['FType'] = 0;
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates()) {
							$this->WxDataTwEvent->set($this->request->data);
							if ($this->WxDataTwEvent->validates()) {
								$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
								if ($query) {
									$this->Session->setFlash('商品添加成功。');
									return $this->redirect($this->rdWcURL);
								}
							}
						}
					}
					$data['cates'] = $this->WxDataCate->getOptionsCates($id, 2);
					$this->LNRender($data, 'addProduct');
				} else {
					$this->LNRender($data, 'add');
				}
				break;
			case 'edit':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				$data = $this->WxDataTw->getDataList($id, $query['id']);		//获取图文数据
				$data = $data['WxDataTw']['FType'] == 1 ? $this->WxDataTw->getGaryDataList($id, $query['id']) : $data;
				if ($this->request->is('post') || $this->request->is('put')) {
					if ($this->request->data['WxDataTw']['FType'] == 0) {
						switch ($this->request->data['WxDataTw']['FTwType']) {
							case 'events':			// 图文提交
								$this->request->data['WxDataTw']['FType'] = 0;
								$this->WxDataTw->set($this->request->data);
								if ($this->WxDataTw->validates()) {
									$this->WxDataTwEvent->set($this->request->data);
									if ($this->WxDataTwEvent->validates()) {
										$this->WxDataTw->id = $query['id'];
										$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
										if ($query) {
											$this->Session->setFlash('图文编辑成功。');
											return $this->redirect($this->rdWcURL);
										}
									}
								}
								break;
							default:
								$this->request->data['WxDataTw']['FType'] = 0;
								$this->WxDataTw->set($this->request->data);
								if ($this->WxDataTw->validates()) {
									$this->WxDataTw->id = $query['id'];
									$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
									if ($query) {
										$this->Session->setFlash('图文编辑成功。');
										return $this->redirect($this->rdWcURL);
									}
								}
						}
					} else {
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
							$this->WxDataTw->id = $query['id'];
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文编辑成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = $data;
				    }
				}
				$opsType = 0;
				if ($data['WxDataTw']['FType'] == 0) {
					switch ($data['WxDataTw']['FTwType']) {
						case 'events':
							$tpl = "addEvent";
							$opsType = 1;
							break;
						case 'product':
							$tpl = "addProduct";
							$opsType = 2;
						default:
							$tpl = "addTw";
					}
				} else {
					$tpl = "addTwj";
				}
				$data['cates'] = $this->WxDataCate->getOptionsCates($id, $opsType);
				$this->LNRender($data, $tpl);
				break;
			case 'del':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataTw->delete($query['id'])) {
					$this->Session->setFlash('图文删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			case 'preview':
				$query['id'] = $this->request->query['id'];
				$data = $this->WxDataTw->getDataList($id, $query['id']);
				$data['WxDataTw']['FUrl'] = $data['WxDataTw']['FUrl'] ? Router::url($data['WxDataTw']['FUrl']) : '';
                $data['WxDataTw']['FCreatedate'] = date('n月d日', strtotime($data['WxDataTw']['FCreatedate']));
				if ($data['WxDataTw']['FType'] == 0) {
					$html .= sprintf($twTpl['tw'], $vals['WxDataTw']['Id'], $data['WxDataTw']['FPreview'], $data['WxDataTw']['FTitle'], $data['WxDataTw']['FCreatedate'], $data['WxDataTw']['FUrl'], $data['WxDataTw']['FMemo']);
				} else {
					$grayList = $this->WxDataTw->getGaryDataList($id, $data['WxDataTw']['Id']);
					foreach ($grayList['WxDataTw']['FTwj'] as $k => $v) {
						if ($k == 0) {
							$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
							$html .= sprintf($twTpl['twj_header'], $vals['WxDataTw']['Id'], $v['FPreview'], $v['FTitle'], $stythumb, $v['FUrl']);
						} else {
							$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
							$ithumb = $v['FUrl'] ? 'style="display:none"' : '';
							$html .= sprintf($twTpl['twj_wrap'], $stythumb, $v['FUrl'], $ithumb, $v['FPreview'], $v['FTitle']);
						}
						$html .= $k == end(array_keys($grayList['WxDataTw']['FTwj'])) ? sprintf($twTpl['twj_footer']) : '';
					}
				}
				exit(json_encode($html));
				break;
			case 'twj':
				if ($query['value'] == 'tw') {
					$data = $this->WxDataTw->getDataList($id, null, null, array('FType' => 0));
				} else {
					$data = $this->WxDataTw->getDataList($id);
				}
                if(count($data)){
                    foreach ($data['datalist'] as $vals) {
                        $vals['WxDataTw']['FUrl'] = $vals['WxDataTw']['FUrl'] ? Router::url($vals['WxDataTw']['FUrl']) : '';
                        $vals['WxDataTw']['FCreatedate'] = date('n月d日', strtotime($vals['WxDataTw']['FCreatedate']));
                        if ($vals['WxDataTw']['FType'] == 0) {
							$html .= sprintf($twTpl['tw'], $vals['WxDataTw']['Id'], $vals['WxDataTw']['FPreview'], $vals['WxDataTw']['FTitle'], $vals['WxDataTw']['FCreatedate'], $vals['WxDataTw']['FUrl'], $vals['WxDataTw']['FMemo']);
						} else {
							$grayList = $this->WxDataTw->getGaryDataList($id, $vals['WxDataTw']['Id']);
							foreach ($grayList['WxDataTw']['FTwj'] as $k => $v) {
								if ($k == 0) {
									$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
									$html .= sprintf($twTpl['twj_header'], $vals['WxDataTw']['Id'], $v['FPreview'], $v['FTitle'], $stythumb, $v['FUrl']);
								} else {
									$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
									$ithumb = $v['FUrl'] ? 'style="display:none"' : '';
									$html .= sprintf($twTpl['twj_wrap'], $stythumb, $v['FUrl'], $ithumb, $v['FPreview'], $v['FTitle']);
								}
								$html .= $k == end(array_keys($grayList['WxDataTw']['FTwj'])) ? sprintf($twTpl['twj_footer']) : '';
							}
						}
                    }

                    // 单图文
					if ($query['value'] == 'multi') {
						$html .= '<script>
	                            $.fn.clicktoggle = function(a, b) {
	                                return this.each(function() {
	                                    var clicked = false;
	                                    $(this).bind("click", function() {
	                                        if (clicked) {
	                                            clicked = false;
	                                            return b.apply(this, arguments);
	                                        }
	                                        clicked = true;
	                                        return a.apply(this, arguments);
	                                    });
	                                });
	                            };
	                            Atempids = [];
	                            function odd() {
	                                $(this).removeClass("selected");
	                                var hva = $(this).attr("id");
	                                var index = Atempids.indexOf(hva);
	                                if (index === -1) {
	                                    Atempids.push(hva);
	                                } else {
	                                    Atempids.splice(index, 1);
	                                }
	                            }

	                            function even() {
	                                $(this).addClass("selected");
	                                var hva = $(this).attr("id");
	                                var index = Atempids.indexOf(hva);
	                                if (index === -1) {
	                                    Atempids.push(hva);
	                                } else {
	                                    Atempids.splice(index, 1);
	                                }
	                            }

	                           $("#aj_box .media_preview_area").clicktoggle(even, odd);
	                           </script>';
					} else {
						$html .= '<script>
	                        $.fn.clicktoggle = function(a, b) {
	                            return this.each(function() {
	                                var clicked = false;
	                                $(this).bind("click", function() {
	                                    if (clicked) {
	                                        clicked = false;
	                                        return b.apply(this, arguments);
	                                    }
	                                    clicked = true;
	                                    return a.apply(this, arguments);
	                                });
	                            });
	                        };
	                        var Atempids = [];
	                        function odd() {
	                            $(this).removeClass("selected");
	                        }
	                        function even() {
	                            $(this).addClass("selected");
	                        }
	                        $("#aj_box .media_preview_area").clicktoggle(even, odd);
	                        $("#aj_box .media_preview_area").click(function(){
	                            $("#aj_box .media_preview_area").removeClass("selected");
	                            $(this).addClass("selected");
	                            Atempids = [$(this).attr("id")];
	                        });
	                    </script>';
					}
                } else {
                    $html = '<p style="text-align: center;margin-top: 80px;">亲,您的图文太少了，<a href="'.Router::url($data['WxDataTw']['FUrl']).'">马上去添加</a> 吧！</p>';
                }
				exit(json_encode($html));
				break;
			case 'getTwj':
				if ($this->request->is('post')) {
					$ids = json_decode($this->request->data['ids']);
					$data = $this->WxDataTw->getDataList($id, NULL, $ids);
                    if(count($data)) {
                        foreach ($data['datalist'] as $vals) {
	                        $vals['WxDataTw']['FUrl'] = $vals['WxDataTw']['FUrl'] ? Router::url($vals['WxDataTw']['FUrl']) : '';
	                        $vals['WxDataTw']['FCreatedate'] = date('n月d日', strtotime($vals['WxDataTw']['FCreatedate']));
	                        if ($vals['WxDataTw']['FType'] == 0) {
								$html .= sprintf($twTpl['tw'], $vals['WxDataTw']['Id'], $vals['WxDataTw']['FPreview'], $vals['WxDataTw']['FTitle'], $vals['WxDataTw']['FCreatedate'], $vals['WxDataTw']['FUrl'], $vals['WxDataTw']['FMemo']);
							} else {
								$grayList = $this->WxDataTw->getGaryDataList($id, $vals['WxDataTw']['Id']);
								foreach ($grayList['WxDataTw']['FTwj'] as $k => $v) {
									if ($k == 0) {
										$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
										$html .= sprintf($twTpl['twj_header'], $vals['WxDataTw']['Id'], $v['FPreview'], $v['FTitle'], $stythumb, $v['FUrl']);
									} else {
										$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
										$ithumb = $v['FUrl'] ? 'style="display:none"' : '';
										$html .= sprintf($twTpl['twj_wrap'], $stythumb, $v['FUrl'], $ithumb, $v['FPreview'], $v['FTitle']);
									}
									$html .= $k == end(array_keys($grayList['WxDataTw']['FTwj'])) ? sprintf($twTpl['twj_footer']) : '';
								}
							}
                        }
                    } else {
                        $html = '<p style="text-align: center;margin-top: 80px;">亲,您的图文太少了，<a href="'.Router::url($data['WxDataTw']['FUrl']).'">马上去添加</a> 吧！</p>';
                    }
					exit(json_encode($html));
				}
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id, 'FTwType' => NULL);
				if ($query['value']) {
					switch ($query['value']) {
						case 'tw':
							$conditions['FType'] = 0;
							$conditions['FTwType'] = null;
							break;
						case 'twj':
							$conditions['FType'] = 1;
							break;
						default:
							$conditions['FTwType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataTw', $conditions);
				$data['category'] = $this->WxDataTw->getCategories($id);
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _mEvent($id, $query) {
		$this->loadModel('WxDataTw');
		$this->loadModel('WxDataTwEvent');
		$data = array();
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->request->data['WxDataTw']['FType'] = 0;
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates()) {
						$this->WxDataTwEvent->set($this->request->data);
						if ($this->WxDataTwEvent->validates()) {
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
				}
				$this->LNRender($data, 'add');
				break;
			case 'edit':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}

				if ($this->request->is('post') || $this->request->is('put')) {
					$this->request->data['WxDataTw']['FType'] = 0;
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates()) {
						$this->WxDataTwEvent->set($this->request->data);
						if ($this->WxDataTwEvent->validates()) {
							$this->WxDataTw->id = $query['id'];
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文编辑成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataTw->getDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}
				$this->LNRender($data, 'add');
				break;
			case 'del':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataTw->delete($query['id'])) {
					$this->Session->setFlash('删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id, 'FType' => 0, 'FTwType' => "events");
				if ($query['value'] != '') {
					switch ($query['value']) {
						default:
							$conditions['FTwType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataTw', $conditions);
				$data['category'] = $this->WxDataTw->getCategories($id, 'events');
				$this->LNRender($data);

		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mCate($id, $query) {
		$this->loadModel('WxDataCate');
		switch ($query['action']) {
			case 'add':
				if ($query['mod'] == 'tw') {
					if ($this->request->is('post')) {
						$this->WxDataCate->set($this->request->data);
						if ($this->WxDataCate->validates()) {
							$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->LNRender(null, 'addTw');
				} else if ($query['mod'] == 'event') {
					if ($this->request->is('post')) {
						$this->WxDataCate->set($this->request->data);
						if ($this->WxDataCate->validates()) {
							$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->LNRender(null, 'addEvent');
				} else if ($query['mod'] == 'product') {
					if ($this->request->is('post')) {
						$this->WxDataCate->set($this->request->data);
						if ($this->WxDataCate->validates()) {
							$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->LNRender(null, 'addProduct');
				} else {
					$this->LNRender($data, 'add');
				}
				break;
			case 'edit':
				if (!$this->WxDataCate->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}

				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataCate->set($this->request->data);
					if ($this->WxDataCate->validates()) {
						$this->WxDataCate->id = $query['id'];
						$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataCate->getDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}

				switch ($data['WxDataCate']['FType']) {
					case '1':
						$tpl = "addEvent";
						break;
					case '2':
						$tpl = 'addProduct';
						break;
					default:
						$tpl = "addTw";
				}
				$this->LNRender($data, $tpl);
				break;
			case 'del':
				if (!$this->WxDataCate->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataCate->delete($query['id'])) {
					$this->Session->setFlash('删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id);
				if ($query['value'] != '') {
					switch ($query['value']) {
						default:
							$conditions['FType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataCate', $conditions);
				$data['category'] = $this->WxDataCate->getCategories($id, $this->rdWcURL);
				$this->LNRender($data);

		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _mProduct($id, $query) {
		$this->loadModel('WxDataTw');
		$this->loadModel('WxDataTwProduct');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->request->data['WxDataTw']['FType'] = 0;
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates()) {
						$this->WxDataTwProduct->set($this->request->data);
						if ($this->WxDataTwProduct->validates()) {
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
				}
				$this->LNRender($data, 'add');
				break;
			case 'edit':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->request->data['WxDataTw']['FType'] = 0;
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates()) {
						$this->WxDataTwProduct->set($this->request->data);
						if ($this->WxDataTwProduct->validates()) {
							$this->WxDataTw->id = $query['id'];
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('编辑成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataTw->getDataList($id, $query['id'], null, null, 'product');
						$this->request->data = $data;
				    }

				}

				// View Vars
				$data['nav'] = $navs;
				$this->LNRender($data, 'add');
				break;
			case 'del':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataTw->delete($query['id'])) {
					$this->Session->setFlash('删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id, 'FType' => 0, 'FTwType' => "product");
				if ($query['value'] != '') {
					switch ($query['value']) {
						default:
							$conditions['FTwType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataTw', $conditions);
				$data['category'] = $this->WxDataTw->getCategories($id, 'product');
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mMenu($id, $query) {
		$this->loadModel('WxDataMenu');
		$this->loadModel('WxDataStore');
		switch ($query['action']) {
			case 'add':
				if ($query['mod'] == 'mSite') {
					if ($this->request->is('post')) {
						$this->WxDataMenu->set($this->request->data);
						if ($this->WxDataMenu->validates()) {

							$query = $this->WxDataMenu->saveData($this->request->data, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->LNRender(null, 'addMsite');
				} else if ($query['mod'] == 'mStore') {
					if ($this->request->is('post')) {
						$this->WxDataMenu->set($this->request->data);
						if ($this->WxDataMenu->validates()) {
							// echo '<pre>';print_r($this->request->data);exit;
							$query = $this->WxDataMenu->saveData($this->request->data, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$data['stores'] = $this->WxDataStore->getOptionsStores($id);
					$this->LNRender($data, 'addMstore');
				} else {
					$this->LNRender($data, 'add');
				}
				break;
			case 'edit':
				if (!$this->WxDataMenu->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataMenu->set($this->request->data);
					if ($this->WxDataMenu->validates()) {
						$this->WxDataMenu->id = $query['id'];
						$query = $this->WxDataMenu->saveData($this->request->data, $id);
						if ($query) {
							$this->Session->setFlash('编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataMenu->getDataList($id, $query['id']);
						$data['WxDataMenu']['FPreTwj'] = $data['WxDataMenu']['FTwj'];
						$this->request->data = $data;
				    }

				}
				switch ($data['WxDataMenu']['FType']) {
					case '1':
						$tpl = "addMStore";
						break;
					default:
						$tpl = "addMSite";
				}
				$data['stores'] = $this->WxDataStore->getOptionsStores($id);
				$this->LNRender($data, $tpl);
				break;
			case 'del':
				if (!$this->WxDataMenu->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataMenu->delete($query['id'])) {
					$this->Session->setFlash('删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id);
				if ($query['value'] != '') {
					switch ($query['value']) {
						default:
							$conditions['FType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataMenu', $conditions);
				$data['category'] = $this->WxDataMenu->getCategories($id, $this->rdWcURL);
				$this->LNRender($data);

		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function __cates($type, $id, $query) {
		$data = array();
		$this->loadModel('WxDataCate');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxDataCate->set($this->request->data);
					if ($this->WxDataCate->validates()) {
						$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('添加成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				}
				$this->LNRender($data, 'add');
				break;
			case 'edit':
				if (!$this->WxDataCate->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}

				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataCate->set($this->request->data);
					if ($this->WxDataCate->validates()) {
						$this->WxDataCate->id = $query['id'];
						$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataCate->getDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}
				$this->LNRender($data, 'add');
				break;
			case 'del':
				if (!$this->WxDataCate->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataCate->delete($query['id'])) {
					$this->Session->setFlash('删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$_type = array('store' => 2);
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id, 'FType' => $_type[$type]);
				if ($query['value'] != '') {
					switch ($query['value']) {
						default:
							$conditions['FType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataCate', $conditions);
				$data['category'] = $this->WxDataCate->getCategories($id, $type);
				$this->LNRender($data);

		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _wCates($id, $query) {
		$this->set('storeIndexUrl', "{$this->rdMobURL}store?id={$id}");
		$this->__cates('store', $id, $query);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _wStores($id, $query) {
		$this->loadModel('WxDataStore');
		$this->loadModel('WxDataCate');
		$cateId = $this->request->query['_cid'];
		$baseurl['cate'] = "{$this->rdWcURL}?_m={$query['mod']}&_id={$query['id']}";
		$baseurl['cateHome'] = "{$this->rdWcURL}?_id={$query['id']}&_m={$query['mod']}";
		$this->WxDataStore->webchatId = $id;
		$storeList = $this->WxDataStore->getDataList($id, $query['id']);
		$navs = array(
			'home' => array('name' => "店铺信息", 'default' => TRUE),
			'dp001' => array('name' => "营业信息"),
			'dp002' => array('name' => "支付信息"),
			'dp003' => array('name' => "配送时间"),
			'dp004' => array('name' => "店铺活动"),
			'dp005' => array('name' => "订单提醒"),
			'dp006' => array('name' => "店铺图片"),
			'dp007' => array('name' => "二维码")
		);
		$cateNavs = array(
			'home' => array('name' => "店铺管理", 'uri' => "{$this->rdWcURL}"),
			'dp001' => array('name' => "分类管理", 'default' => TRUE, 'uri' => $baseurl['cateHome'])
		);

		$articleDefault = array(0 => array('WxDataCate' => array('Id' => string::uuid(), 'FName' => "公告", 'FOwnerName' => "应用首页")));

		// Switch Case
		$this->set('action', $query['action']);
		switch ($query['action']) {
			case 'add':
				if ($query['mod'] == 'cate') {
					if ($this->request->is('post')) {
						$this->WxDataCate->set($this->request->data);
						$this->WxDataCate->set('FOwnerId', $query['id']);
						if ($this->WxDataCate->validates()) {
							$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('编辑成功。');
								return $this->redirect($baseurl['cateHome']);
							}
						}
					}

					// View Vars
					$data['baseurl'] = $baseurl['cate'];
					$data['nav'] = $cateNavs;
					$data['storeList'] = $storeList;
					$this->LNRender($data, 'addCate');
				} else {
					if ($this->request->is('post')) {
						$this->WxDataStore->set($this->request->data);
						if ($this->WxDataStore->validates()) {
							$query = $this->WxDataStore->saveData($this->request->data, $id);
							if ($query) {
								$this->Session->setFlash('添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}

					// View Vars
					$data['nav'] = $navs;
					$data['cates'] = $this->WxDataCate->getOptionsCates($id, 2);
					$data['tips_store'] = isset($this->WxDataStore->storeType[$query['mod']]) ? $this->WxDataStore->storeType[$query['mod']] : reset($this->WxDataStore->storeType);
					$this->LNRender($data, 'add');
				}
				break;
			case 'edit':
				if ($query['mod'] == 'cate') {
					$storeId = $query['id'];
					$query['id'] = $cateId;
					if (!$this->WxDataCate->checkId($id, $query['id'])) {
						return $this->redirect($this->rdWcURL);
					}
					if ($this->request->is('post') || $this->request->is('put')) {
						$this->WxDataCate->set($this->request->data);
						$this->WxDataCate->set('FOwnerId', $storeId);
						if ($this->WxDataCate->validates()) {
							$this->WxDataCate->id = $query['id'];
							$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('编辑成功。');
								return $this->redirect($baseurl['cateHome']);
							}
						}
					} else {
						if (!$this->request->data) {
							$data = $this->WxDataCate->getDataList($id, $query['id']);
							$this->request->data = $data;
					    }
					}

					// View Vars
					$data['baseurl'] = $baseurl['cate'];
					$data['nav'] = $cateNavs;
					$data['storeList'] = $storeList;
					$this->LNRender($data, 'addCate');
				} else if ($query['mod'] == 'article') {			// 文章
					$cateNavs['dp001']['name'] = '文章管理';
					$storeId = $query['id'];
					$query['id'] = $cateId;
					if ($this->request->is('post') || $this->request->is('put')) {
						$this->WxDataCate->set($this->request->data);
						$this->WxDataCate->set('FOwnerId', $storeId);
						if ($this->WxDataCate->validates()) {
							$this->WxDataCate->id = $query['id'];
							$query = $this->WxDataCate->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('编辑成功。');
								return $this->redirect($baseurl['cateHome']);
							}
						}
					} else {
						if (!$this->request->data) {
							$data = $this->WxDataCate->getDataList($id, $query['id']);
							$data = !$data['WxDataCate']['Id'] ? reset($articleDefault) : $data;
							$this->request->data = $data;
					    }
					}

					// View Vars
					$data['baseurl'] = $baseurl['cate'];
					$data['nav'] = $cateNavs;
					$data['storeList'] = $storeList;
					$this->LNRender($data, 'addArticle');
				} else {
					if (!$this->WxDataStore->checkId($id, $query['id'])) {
						return $this->redirect($this->rdWcURL);
					}
					if ($this->request->is('post') || $this->request->is('put')) {
						$this->WxDataStore->set($this->request->data);
						if ($this->WxDataStore->validates()) {
							$this->WxDataStore->id = $query['id'];
							$query = $this->WxDataStore->saveData($this->request->data, $id);
							if ($query) {
								$this->Session->setFlash('编辑成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					} else {
						if (!$this->request->data) {
							$data = $this->WxDataStore->getDataList($id, $query['id']);
							$this->request->data = $data;
					    }

					}

					// View Vars
					$data['nav'] = $navs;
					$data['cates'] = $this->WxDataCate->getOptionsCates($id, 2);
					$data['tips_store'] = isset($this->WxDataStore->storeType[$query['mod']]) ? $this->WxDataStore->storeType[$query['mod']] : reset($this->WxDataStore->storeType);
					$this->LNRender($data, 'add');
				}
				break;
			case 'del':
				if ($query['mod'] == 'cate') {
					$query['id'] = $cateId;
					if (!$this->WxDataCate->checkId($id, $query['id'])) {
						return $this->redirect($this->rdWcURL);
					}
					if ($this->WxDataCate->delete($query['id'])) {
						$this->Session->setFlash('删除成功。');
					}
					return $this->redirect($baseurl['cateHome']);
				} else {
					if (!$this->WxDataStore->checkId($id, $query['id'])) {
						return $this->redirect($this->rdWcURL);
					}
					if ($this->WxDataStore->delete($query['id'])) {
						$this->Session->setFlash('删除成功。');
					}
					return $this->redirect($this->rdWcURL);
				}
				break;
			default:
				if ($query['mod'] == 'cate') {
					$type = 'product';
					$_type = array('product' => 3);
					$this->paginate['limit'] = 9;
					$this->Paginator->settings = $this->paginate;
					$conditions = array('FWebchat' => $id, 'FType' => $_type[$type], 'FOwnerId' => $query['id']);
					if ($query['value'] != '') {
						switch ($query['value']) {
							default:
								$conditions['FType'] = $query['value'];
						}
					}
					$data['datalist'] = $this->Paginator->paginate('WxDataCate', $conditions);
					$data['baseurl'] = $baseurl['cate'];
					$data['nav'] = $cateNavs;
					$data['storeList'] = $storeList;
					$this->LNRender($data, 'cateIndex');
				} else if ($query['mod'] == 'article') {
					$cateNavs['dp001']['name'] = '文章管理';
					$type = 'product';
					$_type = array('product' => 4);
					$this->paginate['limit'] = 9;
					$this->Paginator->settings = $this->paginate;
					$conditions = array('FWebchat' => $id, 'FType' => $_type[$type], 'FOwnerId' => $query['id']);
					if ($query['value'] != '') {
						switch ($query['value']) {
							default:
								$conditions['FType'] = $query['value'];
						}
					}
					$data['datalist'] = $this->Paginator->paginate('WxDataCate', $conditions);
					$data['datalist'] = !$data['datalist'] ? $articleDefault : $data['datalist'];		// default
					$data['baseurl'] = $baseurl['cate'];
					$data['nav'] = $cateNavs;
					$data['storeList'] = $storeList;
					$this->LNRender($data, 'articleIndex');
				} else {
					$this->paginate['limit'] = 9;
					$this->Paginator->settings = $this->paginate;
					$conditions = array('FWebchat' => $id);
					if ($query['value'] != '') {
						switch ($query['value']) {
							default:
								$conditions['FStore'] = $query['value'];
						}
					}
					$data['datalist'] = $this->Paginator->paginate('WxDataStore', $conditions);
					$data['category'] = $this->WxDataStore->getCategories($id, $this->rdWcURL);
					$this->LNRender($data);
				}
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function _wOrders($id, $query) {
		$this->loadModel('WxDataOrder');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxDataOrder->set($this->request->data);
					if ($this->WxDataOrder->validates()) {
						$query = $this->WxDataOrder->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('添加成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				}
				$this->LNRender($data, 'add');
				break;
			case 'edit':
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataOrder->set($this->request->data);
					if ($this->WxDataOrder->validates()) {
						$this->WxDataOrder->id = $query['id'];
						// print_r($this->request->data);exit;
						$query = $this->WxDataOrder->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataOrder->getDataList($id, null, null, $query['id']);
						$data['WxDataOrder']['FIsTop'] = array($data['WxDataOrder']['FStatus']);
						$this->request->data = $data;
				    }
				}
				$this->LNRender($data, 'add');
				break;
			case 'del':
				if (!$this->WxDataOrder->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataOrder->delete($query['id'])) {
					$this->Session->setFlash('删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions['FWebchat'] = $id;
				if ($query['value'] != '') {
					switch ($query['value']) {
						default:
							$conditions['FStatus'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataOrder', $conditions);
				$data['category'] = $this->WxDataOrder->getCategories($id, $this->rdWcURL);
				$this->LNRender($data);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mPicGary($id, $query) {
		$this->loadModel('WxDataTw');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
						$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('图文添加成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				}
				$this->LNRender(null, 'add');
				break;
			case 'edit':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
						$this->WxDataTw->id = $query['id'];
						$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('图文编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataTw->getGaryDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}
				$this->LNRender($data, 'add');
				break;
			case 'del':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->WxDataTw->delete($query['id'])) {
					$this->Session->setFlash('图文删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$data['datalist'] = $this->Paginator->paginate('WxDataTw', array('FWebchat' => $id, 'FType' => 1));
				$this->LNRender($data);

		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mSlide() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mFile() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _hRobot($id, $query) {
		$navs = array(
			'home' => array('name' => "全局设置", 'default' => TRUE, 'uri' => "{$this->rdWcURL}"),
			'follow' => array('name' => "问答列表", 'uri' => "{$this->rdWcURL}?_m=follow"),
			'mch' => array('name' => "功能介绍", 'uri' => "{$this->rdWcURL}?_m=mch"),
		);
		$tpl = 'index';
		switch ($query['mod']) {
			case 'follow':
				$tpl = 'follow';
				break;
			case 'mch':
				$tpl = 'mch';
				break;
			default:

		}
		$data['nav'] = $navs;
		$this->LNRender($data, $tpl);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _hService($id, $query) {
		$navs = array(
			'home' => array('name' => "全局设置", 'default' => TRUE),
		);
		$data['nav'] = $navs;
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _hApp($id, $query) {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _menuset($id) {
		$this->loadModel('WxWcdata');
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->WxWcdata->set($this->request->data);
			if ($this->WxWcdata->validates()) {
				$query = $this->WxWcdata->saveWcdata($this->request->data, $this->uid, $id);
				if ($query) {
					$this->Session->setFlash('默认回复保存成功。');
					return $this->redirect($this->rdBaseURL.'menuset');
				}
			}
		} else {
			if (!$this->request->data) {
				$data = $this->WxWcdata->getWcdataList($this->uid, $id);
				$this->request->data = $data;
			}
		}
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _areply($id, $query, $wxId) {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _txtreply($id, $query, $wxId) {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _info($id, $query, $wxId) {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _picreply($id, $query, $wxId) {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _mFields($id, $query, $wxId) {
		$this->loadModel("WxDataMus");
		switch ($query['mod']) {
			case 'api':
				switch ($query['action']) {
					case 'save':
						if ($this->request->is('post')) {
							$post = $this->request->data['post'];
							$postJson['WxDataMus'] = json_decode($post, TRUE);
							// print_r($postJson);exit;
							$query = $this->WxDataMus->saveData($postJson, $wxId);
							if ($query) {
								$msg['state'] = 1;
								$msg['msg'] = "操作成功";
								$msg['data'] = $query;
							} else {
								$msg['state'] = 0;
								$msg['msg'] = "操作失败";
							}
							echo json_encode($msg);exit;
						}
						break;
					case 'del':
						if ($this->request->is('post')) {
							$post['id'] = $this->request->data['post'];
							$query = $this->WxDataMus->delete($post['id']);
							if ($query) {
								$msg['state'] = 1;
								$msg['msg'] = "操作成功";
							} else {
								$msg['state'] = 0;
								$msg['msg'] = "操作失败";
							}
							echo json_encode($msg);exit;
						}
						break;
					case 'svMenus':
						if ($this->request->is('post')) {
							$post = $this->request->data['post'];
							$post = json_decode($post, TRUE);
							$query = $this->WxDataMus->svMenus($post);
							if ($query) {
								$msg['state'] = 1;
								$msg['msg'] = "操作成功";
							} else {
								$msg['state'] = 0;
								$msg['msg'] = "操作失败";
							}
							echo json_encode($msg);exit;
						}
						break;
					default:
						$msg = $this->WxDataMus->getDataList($id);
						echo json_encode($msg);exit;
				}
				break;
			default:
				if ($this->request->isPost()) {
					$this->loadModel('WxReply');
					$case = $this->WxReply->saveMenus($id, $this->appid, $this->appsecret);
					if ($case && $case['state'] == 1) {
						$this->flashSuccess("菜单已经更新成功，由于微信客户端缓存，需要24小时微信客户端才会展现出来。");
					} else if ($case && $case['state'] == 0) {
						$this->flashError($case['msg']);
					} else {
						$this->flashError("菜单更新失败。");
					}
					$this->redirect($this->rdWcURL);
				}
				$this->LNRender($data);
		}
	}

	/**
	 * 获取关注者列表
	 *
	 * @return void
	 * @author apple
	 **/
	public function _sFans($id, $query, $wxId) {
		$this->loadModel('WxDataUser');
		$this->loadModel('WxReply');
		$tpl = "index";
		switch ($query['action']) {
			case 'sync':
				$case = $this->WxReply->getFollows($id, $this->appid, $this->appsecret);
				if ($case && $case['state'] == 1) {
					$this->flashSuccess("粉丝数据同步成功。");
				} else if ($case && $case['state'] == 0) {
					$this->flashError($case['msg']);
				} else {
					$this->flashError("同步失败。");
				}
				$this->redirect($this->rdWcURL);
				break;
			case 'edit':
				$tpl = "add";
				if ($this->request->is('put')) {
					$this->WxDataUser->set($this->request->data);
					if ($this->WxDataUser->validates(array('fieldList' => array('FMemo')))) {
						$this->WxDataUser->id = $query['id'];
						$query = $this->WxDataUser->saveData($id);
						if ($query) {
							$this->flashSuccess("编辑成功。");
							return $this->redirect($this->rdBaseURL.'sFans');
						}
					}
				} else {
					if (!$this->request->data) {
						$data['list'] = $this->WxDataUser->getDataList($id, $query['id']);
				        $this->request->data = $data['list'];
				    }
				}
			default:
				$this->paginate['limit'] = 9;
				$this->paginate['order'] = "FSubscribe_time DESC";
				$this->Paginator->settings = $this->paginate;
				$data['datalist'] = $this->Paginator->paginate('WxDataUser', array('FWebchat' => $id));
				// $data['ds'] = $this->WxDataUser->getDataList($id);
		}
		$this->LNRender($data, $tpl);
	}

	/**
	 * 获取关注者列表
	 *
	 * @return void
	 * @author apple
	 **/
	public function _sMsgst($id, $query, $wxId) {
		$this->loadModel('WxDataSent');
		$this->loadModel('WxReply');
		$tpl = "index";
		switch ($query['mod']) {
			case 'history':
				if ($query['action'] == 'del') {
					if ($this->WxDataSent->delete($query['id'])) {
						$this->Session->setFlash('删除成功。');
						return $this->redirect("{$this->rdWcURL}?_m=history");
					}
				} else {
					$tpl = 'history';
					$this->paginate['limit'] = 9;
					$this->paginate['order'] = "FCreatedate DESC";
					$this->Paginator->settings = $this->paginate;
					$data['datalist'] = $this->Paginator->paginate('WxDataSent', array('FWebchat' => $id));
				}
				// echo '<pre>';print_r($data);exit;
				break;
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
					$rdata = $this->request->data['WxDataSent'];
					$type = $rdata['FType'];
					$sendd = $type ? reset($rdata['FTwj']) : $rdata['FSentMsg'];
					$fieldList = ($type == 1) ? array('fieldList' => array('FType')) : array();
					$this->WxDataSent->set($this->request->data);
					if ($this->WxDataSent->validates($fieldList)) {
						$case = ClassRegistry::init('WxReply')->sendall($id, $this->appid, $this->appsecret, $type, $sendd);
						if ($case && $case['state'] == 1) {
							$query = $this->WxDataSent->saveData($id, $case['data']['msg_id']);
							if ($query) {
								$this->flashSuccess("群发消息提交成功，群发任务一般需要较长的时间才能全部发送完毕，请耐心等待。");
								return $this->redirect($this->rdWcURL);
							}
						} else {
							$this->flashError($case['msg']);
						}
					}
				}
		}

		// View Vars
		$data['nav'] = array(
			'home' => array('name' => "消息群发", 'default' => TRUE, 'uri' => "{$this->rdWcURL}"),
			'history' => array('name' => "历史消息", 'uri' => "{$this->rdWcURL}?_m=history")
			// 'follow' => array('name' => "被关注回复"),
			// 'mch' => array('name' => "无匹配回复")
		);
		$this->LNRender($data, $tpl);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function basic() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->TPerson->set($this->request->data);
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FullName', 'FPhone', 'FMobileNumber', 'FEMail', 'FCity')))) {
				$this->TPerson->id = $this->uid;
				$query = $this->TPerson->save($this->request->data, TRUE, array('FullName', 'FPhone', 'FMobileNumber', 'FEMail', 'FCity'));
				if ($query) {
					$this->flashSuccess("保存成功");
					return $this->redirect($this->rdBaseURL.'basic');
				}
			}
		} else {
			$user['TPerson'] = $this->TPerson->getUserInfo($this->uid);
			$this->request->data = $user;
		}

		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function wBasic() {
		$this->_checkPrivileges();
		if ($this->request->is('post') || $this->request->is('put')) {
			$Setting = ClassRegistry::init('Settings.Setting');
			$Setting->Behaviors->disable('Cached');
			foreach ($this->request->data as $key => $value) {
				foreach ($value as $k => $v) {
					$v = is_array($v) ? reset($v) : $v;
					$Setting->write("{$key}.{$k}", $v);
				}
			}
			$this->flashSuccess("保存成功");
		} else {
			$sets = array('Site' => array("title", "name", "keywords", "description", "FOpenSignup", "FSiteStats"));
			foreach ($sets as $key => $value) {
				foreach ($value as $v) {
					$user[$key][$v] = Configure::read("{$key}.{$v}");
				}
			}
			$this->request->data = $user;
		}

		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function wInvite($action, $id) {
		$this->_checkPrivileges();
		$this->loadModel('WxInvite');
		$tpl = "index";
		switch ($action) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxInvite->set($this->request->data);
					if ($this->WxInvite->validates()) {
						$query = $this->WxInvite->saveData();
						if ($query) {
							$this->Session->setFlash('添加成功。');
							return $this->redirect($this->rdBaseURL.'wInvite');
						}
					}
				} else {
					$view = new View();
					$main = $view->loadHelper('Main');
					$redata['WxInvite']['FInvCode'] = $main->randomkeys(8);
					$this->request->data = $redata;
				}
				$tpl = "add";
				break;
			case 'edit':
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxInvite->set($this->request->data);
					if ($this->WxInvite->validates()) {
						$this->WxInvite->id = $id;
						$query = $this->WxInvite->saveData();
						if ($query) {
							$this->Session->setFlash('编辑成功。');
							return $this->redirect($this->rdBaseURL.'wInvite');
						}
					}
				} else {
					$redata = $this->WxInvite->getDataList("", $id);
					$this->request->data = $redata;
				}
				$tpl = "add";
				break;
			case 'del':
				$query = $this->WxInvite->delete($id);
				if ($query) {
					$this->Session->setFlash('删除成功。');
					return $this->redirect($this->rdBaseURL.'wInvite');
				}
				break;
			default:
		}
		$this->Paginator->settings = $this->paginate;
		$data['datalist'] = $this->Paginator->paginate('WxInvite', $conditions);
		$this->set('action', $action);
		$this->LNRender($data, $tpl);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function message() {
		if ($this->request->is('post') || $this->request->is('put')) {
			// Validate
			$user = $this->TPerson->getUserInfo($this->uid);
			$this->TPerson->validator()
			->add('FPhoneUser', 'required', array(
			    'rule' => "notEmpty",
				'required' => true,
				'message' => "必须填写"
			))
			->add('FPhonePwd', 'required', array(
		        'rule' => "notEmpty",
				'required' => true,
				'message' => "必须填写"
			));
			$this->TPerson->set($this->request->data);
			if ($this->TPerson->validates(array('fieldList' => array('FPhoneUser', 'FPhonePwd')))) {
				$this->TPerson->id = $this->uid;
				$query = $this->TPerson->save($this->request->data, TRUE, array('FPhoneUser', 'FPhonePwd'));
				if ($query) {
					$this->Session->setFlash('短信账号配置成功。');
					return $this->redirect($this->rdBaseURL.'message');
				}
			}
		} else {
			$user = $this->TPerson->find('first', array('conditions' => array('Id' => $this->uid)));
			$this->request->data = $user;
		}

		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function repwd() {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		if ($this->request->is('post') || $this->request->is('put')) {

			// Encode Password
			$userPwd = $this->request->data['TPerson']['FPassWord'];
			$oldPwd = $this->request->data['TPerson']['FOldPassWord'];
			$sp = new SimplePasswordHasher();
			$this->request->data['TPerson']['FOldPassWord'] = $oldPwd = $sp->hash($oldPwd);
			$this->request->data['TPerson']['FPassWord'] = $sp->hash($userPwd);

			// Validate
			$user = $this->TPerson->getUserInfo($this->uid);
			$this->TPerson->validator()
			->add('FOldPassWord', 'required', array(
			    'rule' => "notEmpty",
				'required' => true,
				'message' => "必须填写"
			))
			->add('FOldPassWord', 'equalTo', array(
		        'rule' => array('equalTo', $user['FPassWord']),
				'message' => "原密码不正确",
			))
			->add('FRePassWord', 'required', array(
		        'rule' => "notEmpty",
				'required' => true,
				'message' => "必须填写",
			))
			->add('FRePassWord', 'minLength', array(
		        'rule' => array('minLength', '6'),
				'message' => "不能少于6位",
			))
			->add('FRePassWord', 'equalTo', array(
		        'rule' => array('equalTo', $userPwd),
				'message' => "两次输入的密码不一致",
			));

			$this->TPerson->set($this->request->data);
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FOldPassWord', 'FPassWord', 'FRePassWord')))) {
				$this->TPerson->id = $this->uid;
				$query = $this->TPerson->save($this->request->data, TRUE, array('FPassWord'));
				if ($query) {
					$this->Session->setFlash('密码修改成功，请重新登录');
					return $this->redirect($this->Auth->logout());
				}
			}
		} else {
			$user['TPerson']['FMemberId'] = $this->username;
			$this->request->data = $user;
		}

		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function webchat($action, $id)
	{
		$Tpl = 'add';
		$this->loadModel('WxWebchat');
		$navs = array(
			'home' => array('name' => "基本信息", 'default' => TRUE),
			'dp001' => array('name' => "微信应用"),
		);
		switch ($action) {
			case 'add':
				$result = $this->WxWebchat->getWebchatList($this->uid);
				$data['leavecount'] = $this->toAccount - intval($result['count']);
				if ($data['leavecount'] <= 0 && !$this->isAdmin) {
					$this->flashError("您的公众号配额已经超了。");
					return $this->redirect(array('action' => "index"));
				}
				if ($this->request->is('post')) {
					$this->WxWebchat->set($this->request->data);
					if ($this->WxWebchat->validates(array('fieldList' => array('FName', 'FWxopenId', 'FWxId', 'FIcon')))) {
						$query = $this->WxWebchat->saveWebchat($this->request->data, $this->uid);
						if ($query) {
							$this->Session->setFlash('微信公众账号添加成功。');
							return $this->redirect(array('action' => 'index'));
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = array('WxWebchat' => array('FWxApi' => $this->wxAPI, 'FWxToken' => $this->wxToken));
					}
				}
				break;
			case 'edit':
				$navs['dp002'] = array('name' => "二维码（应用预览）");
				if (!$this->WxWebchat->checkWebchat($id, $this->uid)) return $this->redirect(array('action' => "webchatAdd"));
				// echo '<pre>';print_r($this->request);exit;
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWebchat->set($this->request->data);
					if ($this->WxWebchat->validates(array('fieldList' => array('FName', 'FWxopenId', 'FWxId', 'FIcon')))) {
						$this->WxWebchat->id = $id;
						$query = $this->WxWebchat->saveWebchat($this->request->data, $this->uid);
						if ($query) {
							$this->Session->setFlash('微信公众账号编辑成功。');
							return $this->redirect(array('action' => 'index'));
						}
					}
				} else {
					if (!$this->request->data) {
						$data['list'] = $this->WxWebchat->getWebchatList($this->uid, $id);
				        $this->request->data = $data['list'];
				    }
				}
				break;
			case 'del':
				if (!$this->WxWebchat->checkWebchat($id, $this->uid)) return $this->redirect(array('action' => "index"));
				if ($this->WxWebchat->delete($id)) {
					$this->Session->setFlash('微信公众账号删除成功。');
				}
				return $this->redirect(array('action' => 'index'));
				break;
		}
		$data['nav'] = $navs;
		$this->LNRender($data, $Tpl);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function yMapps() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function yAppStore() {
		$this->LNRender($data);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function pUsers($action, $id) {
		$this->_checkPrivileges();
		$this->loadModel('TPerson');
		$tpl = "index";
		$data = array();
		switch ($action) {
			case 'add':
				$tpl = "add";
				if ($this->request->is('post')) {
					$this->TPerson->set($this->request->data);
					$this->TPerson->validator()->add('FMemberId', 'unique', array(
					    'rule' => 'isUnique',
					    'required' => 'create',
						'message' => "此账号已经存在了，请更换一个新的。"
					));
					if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FPassWord', 'FullName', 'FMobileNumber')))) {
						$query = $this->TPerson->addUser($this->request->data);
						if ($query) {
							$this->flashSuccess("添加成功。");
							return $this->redirect(array('action' => "pUsers"));
						}
					}
				}
				break;
			case 'edit':
				$tpl = "add";
				if ($this->request->is('put')) {
					$this->TPerson->set($this->request->data);
					if ($this->TPerson->validates(array('fieldList' => array('FPassWord', 'FullName', 'FPhone', 'FMobileNumber', 'FEMail', 'FCity')))) {
						$this->TPerson->id = $this->request->data['TPerson']['Id'];
						$query = $this->TPerson->saveUser($this->request->data);
						if ($query) {
							$this->flashSuccess("编辑成功。");
							return $this->redirect(array('action' => "pUsers"));
						}
					}
				} else {
					if (!$this->request->data) {
						$data['list'] = $this->TPerson->findById($id);
				        $this->request->data = $data['list'];
				    }
				}
				break;
			case 'del':
				if ($this->TPerson->delete($id)) {
					$this->Session->setFlash('用户删除成功。');
					return $this->redirect(array('action' => "pUsers"));
				}
				break;
			default:
				$this->Paginator->settings = $this->paginate;
				$data['datalist'] = $this->Paginator->paginate('TPerson', array());
				$this->vurl = Router::url(array('controller' => "admin", 'action' => "pUsers"));
		}
		$data['action'] = $action;
		$this->LNRender($data, $tpl);
	}

//======================Private

	/**
	 * 权限检查
	 *
	 * @return void
	 * @author niancode
	 **/
	function _checkPrivileges()
	{
		$routers = $this->WxWebchat->getmenus('hmenu', '', 'router');
		$str = Router::url();
		$segment = stripos(substr($str, stripos($str, 'admin/') + 6), '/');
		$str = $segment ? substr($str, 0, stripos($str, 'admin/') + 6).substr(substr($str, stripos($str, 'admin/') + 6), 0, stripos(substr($str, stripos($str, 'admin/') + 6), '/')) : $str;
		if (!in_array($str, $routers)) {
			$this->flashError("用户未被授权，禁止访问。");
			return $this->redirect(array('action' => "index"));
		}
	}
}
