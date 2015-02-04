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
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	public function index() {
		exit('success');
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
