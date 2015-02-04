<?php

//App::uses('BasicAppController', 'Basic.Controller');
App::uses('AppController', 'Controller');

/**
 * Links Controller
 *
 * @category Controller
 * @package  Croogo.Menus.Controller
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class BasicController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Basic';
	
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
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	public function index($id) {
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
		print_r($this->Liunian);exit;
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
	 * @author niancode
	 **/
	public function test() {
		exit('success');
	}
}
