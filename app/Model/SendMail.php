<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * SendMail Model
 *
 */
class SendMail extends AppModel {

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public $msType = 'text';
	public $useTable = FALSE;
	public $_WX;
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function sts() {
		echo 'sts';
	}
	
	/**
	 * 发送邮件
	 *
	 * @return void
	 * @author niancode
	 **/
	function sendAsMail($to, $subject, $content, $type = 'text', $temp = "default", $layout = "default") {
		$email = new CakeEmail('smtp');
		$from = array('liunianbook@126.com' => '在微信');
		switch ($type) {
			case 'text':
				$sent = $email->emailFormat('text')
				    ->to($to)
				    ->from($from)
					->subject($subject)
				    ->send($content);
				break;
			case 'html':
				$defVars = array('title_for_layout' => $subject);
				$content = is_array($content) ? $content : array('content' => $content);
				$email->viewVars(array_merge($content, $defVars));
				$sent = $email->template($temp, $layout)
    				->emailFormat('html')
				    ->to($to)
				    ->from($from)
					->subject($subject)
				    ->send();
				break;
		}
		if ($sent) return TRUE;			// 发送成功
	}	
	
	/**
	 * 发送短信
	 *
	 * @return void
	 * @author niancode
	 **/
	function sendAsPhone($phone, $content) {
		$uid = AuthComponent::user()['Id'];
		$user = ClassRegistry::init('TPerson')->getUserInfo($uid);
		$account['user'] = $user['FPhoneUser'];
		$account['pass'] = $user['FPhonePwd'];
		//Config
		try
		{
			// $account['user'] = 'niancode';
			// account['pass'] = 'NIANKS321';
			$url = Router::url('/app/webroot/phone/phoneMsg.php?type=soap', TRUE);
			$client = new SoapClient(null, array('location' => $url, 'uri' => "soap123"));
			$content = $client->sendmsg($phone, $content, $account);
			return $content;
		}
		catch(Exction $e)
		{
			return FALSE;
		}
	}
}
