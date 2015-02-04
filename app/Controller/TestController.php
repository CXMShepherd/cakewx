<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class TestController extends AppController {
	
	public function beforeFilter() {
	    parent::beforeFilter();
	}
	
	public function index()
	{
		// $result = $this->TPerson->find('first');
// 		pr($result);exit;
echo 'hello, world!';exit;
	}
	
}