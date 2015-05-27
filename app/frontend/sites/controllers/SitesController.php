<?php

namespace frontend\sites\controllers;

use Yii;
// use frontend\controllers;
// use spyc;
// use yii\web\Controller;

class SitesController extends \frontend\core\AppController
{
    public function actionDel()
    {
        return $this->render('del');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        Yii::$app->view->params['datas'] = $this->datas;
        // Yii::$app->view->params['title'] = $this->datas;
        $data['title'] = "index";
        // $spyc = new Yii::$classMap['spyc'];
        // echo '<pre>';print_r(Spyc::YAMLLoad(Yii::getAlias('@vendor').'/mustangostang/spyc/spyc.yaml'));
        // echo '<pre>';print_r(Yii::$classMap);exit; 
        // echo Yii::getAlias('@vendor');exit;
        return $this->render('index', $data);
    }

    public function actionShow()
    {
        return $this->render('show');
    }

}
