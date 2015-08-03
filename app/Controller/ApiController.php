<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class ApiController extends AppController {
	public $components = array('RequestHandler');

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->RequestHandler->renderAs($this, 'json');
		$this->Auth->allow('wxUser', 'wxOrder', 'test', 'getUserInfo');
		$this->json = $this->request->input('json_decode');
		//$this->loadModel('WxReply');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function getUserInfo()
	{
		$this->loadModel('WxDataUser');
		if ($this->request->isPost()) {
			$post['FOpenId'] = $this->request->data['openid'];
			$result = $this->WxDataUser->getUserInfo($post['FOpenId']);
			if ($result) {
				$data['state'] = 1;
				$data['data'] = $result;
			} else {
				$data['state'] = 0;
				$data['msg'] = "获取失败";
			}
			$this->set('jsondata', $data);
			$this->render('/Admin/Api/json');
		}
	}

	/**
	 * 个人中资料
	 *
	 * @return void
	 * @author niancode
	 **/
	function wxUser() {
		$this->loadModel('WxReply');
		$this->loadModel('WxDataUser');
		$data = '';
		$openid = $this->WxReply->getSessOpenId();
		if ($openid && $this->request->isPost()) {
			$post['FPhone'] = $this->json->phone;
			$post['FullName'] = $this->json->fullname;
			$post['FAddress'] = $this->json->address;
			$this->WxDataUser->id = $openid;
			$query = $this->WxDataUser->saveUser($post);
			if ($query) {
				$data['state'] = 1;
				$data['msg'] = "保存成功";
			} else {
				$data['state'] = 0;
				$data['msg'] = "保存失败";
			}
		}
		$this->set('jsondata', $data);
		$this->render('/Admin/Api/json');
	}

	/**
	 * 提交订单
	 *
	 * @return void
	 * @author niancode
	 **/
	function wxOrder() {
		$this->loadModel('WxDataOrder');
		$this->loadModel('WxDataStore');
		$this->loadModel('SendMail');
		$data = '';
		if ($this->request->isPost()) {
			$this->json->product = json_decode(json_encode($this->json->product), TRUE);
			$post['FOwnerId'] = $this->json->storeId;
			$post['FUserId'] = $this->json->userId;
			$post['FUserName'] = $this->json->userName;
			$post['FUserPhone'] = $this->json->userPhone;
			$post['FUserAddress'] = $this->json->userAdds;
			$post['FUserMemo'] = $this->json->memo;
			$post['FPrice'] = $this->json->allPrice;
			$post['FProduct'] = serialize($this->json->product);
			$post['FPay'] = 'hdfk';
			$post['FStatus'] = 1;
			$post['FUserTime'] = $this->json->userTime;
			$storeList = $this->WxDataStore->getDataList(null, $post['FOwnerId'], 'md5');
			$post['FWebchat'] = $storeList['WxDataStore']['FWebchat'];
			$post['FStoreName'] = $storeList['WxDataStore']['FName'];
			$orderId = $this->WxDataOrder->saveOrder($post);
			if ($orderId) {
				$data['state'] = 1;
				$data['msg'] = "保存成功";
				$data['data'] = $orderId;
				$remind['isPhone'] = $storeList['WxDataStore']['FIsRdPhone'];
				$remind['rdPhone'] = $storeList['WxDataStore']['FRdPhone'];
				$remind['isMail'] = $storeList['WxDataStore']['FIsRdMail'];
				$remind['rdMail'] = $storeList['WxDataStore']['FRdMail'];
				if ($remind['isPhone']) {
					$temp = "%s有新的订单了，总价是：%s元。";
					$rdContent = sprintf($temp, $post['FStoreName'], $post['FPrice'], $post['FUserName'], $post['FUserPhone'], $post['FUserAddress']);
					$emdata['product'] = unserialize($post['FProduct']);
					$emdata['content'] = $rdContent;
					$emdata['memo'] = $FUserMemo;
					$emdata['user'] = array('name' => $post['FUserName'], 'phone' => $post['FUserPhone'], 'address' => $post['FUserAddress']);
					$this->SendMail->sendAsMail($remind['rdMail'], "{$post['FStoreName']}有新的订单了", $emdata, 'html', 'order', 'order');
				}
				if ($remind['isMail']) {
					$temp = "%s有新的订单了，总价是：%s元，购买人：%s，电话：%s，地址：%s";
					$rdContent = sprintf($temp, $post['FStoreName'], $post['FPrice'], $post['FUserName'], $post['FUserPhone'], $post['FUserAddress']);
					$this->SendMail->sendAsPhone($remind['rdPhone'], $rdContent);
				}
			} else {
				$data['state'] = 0;
				$data['msg'] = "保存失败";
			}
		}
		$this->set('jsondata', $data);
		$this->render('/Admin/Api/json');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function message() {
		$this->loadModel('SendMail');
		$phonenumber = $this->json->phonenumber;
		$text = "此短信是手机验证短信，如您已经收到说明短信账户已经配置好了。";
		$case = $this->SendMail->sendAsPhone($phonenumber, $text);
		if ($case) {
			$data['state'] = 1;
			$data['msg'] = "短信发送成功，请注意查收！";
		} else {
			$data['state'] = 0;
			$data['msg'] = "短信发送失败";
		}
		$this->set('jsondata', $data);
		$this->render('/Admin/Api/json');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	public function test() {
		$this->loadModel('SendMail');
		$data['user'] = array('name' => "chen", 'phone' => "133", 'address' => "beijing");
		$data['content'] = "hello";
		$sent = $this->SendMail->sendAsMail("niancode@gmail.com", 'hello', $data, 'html', 'order', 'order');
		//$phoen = $this->SendMail->sendAsPhone("13301372150", "hello, zaiwx");
		// $sent = $this->SendMail->sts();
		if ($sent) echo 'Sent..';
		exit;
	}

}