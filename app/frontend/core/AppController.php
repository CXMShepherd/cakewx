<?php

namespace frontend\core;

use yii;
use yii\web\Controller;
use yii\base\Event;
use yii\web\View;

/**
 * AppController implements the CRUD actions for Member model.
 */
class AppController extends Controller
{	
    /**
     * undocumented class variable
     *
     * @var string
     **/
    var $datas = [1, 2, 3];

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function beforeAction($action)
    {
        Event::on(View::className(), View::EVENT_BEFORE_RENDER, function() {
            Yii::$app->view->params['datas'] = $this->datas;
        });

    	// $this->setView(['hello' => 'hello, world!']);
    	return TRUE;
    }
}
