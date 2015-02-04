<?php
App::uses('AppController', 'Controller');

/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class WelcomeController extends AppController {
	
	var $layout = "index";
	var $helpers = array('AssetCompress.AssetCompress');
	
	public function beforeFilter() {
	    parent::beforeFilter();
		$this->Auth->allow('message', 'signup', 'stop', 'index');
		$this->loadModel("TPerson");
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function index() {
		$this->render('/Home/Index/index');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function stop() {
		$this->render('/Home/Index/stop', 'stop');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function message()
	{
		$this->loadModel('WxFeedback');
		$msg = array();
		if ($this->request->isPost()) {
			// print_r($this->request->data);exit;
			$this->WxFeedback->set($this->request->data);
			if ($this->WxFeedback->validates(array('fieldList' => array('FName', 'FEMail', 'FPhone', 'FMessage')))) {
				$this->WxFeedback->set('FIP', $this->request->clientIp());
				$this->WxFeedback->set('FCreatedate', date('Y-m-d H:i:s'));
				$query = $this->WxFeedback->save();
				$msg['state'] = $query ? 1 : 0;
			} else {
				$error = "错误：";
				foreach ($this->WxFeedback->validationErrors as $key => $vals) {
					$error .= "{$key}, ";
					foreach ($vals as $k => $v) {
						$error .= "{$v}&nbsp;&nbsp;";
					}
				}
				$msg['state'] = 0;
				$msg['msg'] = $error;
			}
		}
		exit(json_encode($msg));
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function signup()
	{
		$msg = array();
		if ($this->request->is('post')) {
			$this->TPerson->set($this->request->data);
			$this->TPerson->validator()->add('FMemberId', 'unique', array(
			    'rule' => 'isUnique',
			    'required' => 'create',
				'message' => "此账号已经存在了，请更换一个新的。"
			));
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FEMail', 'FMobileNumber', 'FPassWord')))) {
				$this->TPerson->id = $this->uid;
                $this->TPerson->set('FullName', $this->request->data['FMemberId']);
				$query = $this->TPerson->addUser($this->request->data);
				$msg['state'] = 0;
				$msg['msg'] = "注册失败。";
				if ($query) {
					$data = $this->TPerson->findById($query);
					$this->Auth->login($data['TPerson']);
					$this->flashSuccess("注册成功。");
					$msg['state'] = 1;
					$msg['msg'] = "注册成功。";
					$msg['redirect'] = Router::url('/admin');
				}
			} else {
				$error = "错误：";
				foreach ($this->TPerson->validationErrors as $key => $vals) {
					$error .= "{$key}, ";
					foreach ($vals as $k => $v) {
						$error .= "{$v}&nbsp;&nbsp;";
					}
				}
				$msg['state'] = 0;
				$msg['msg'] = $error;
			}
		}
		exit(json_encode($msg));
	}	
}