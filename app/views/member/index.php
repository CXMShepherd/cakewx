<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Member'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'username',
            'password',
            'random',
            'is_admin',
            // 'mobile',
            // 'email:email',
            // 'truename',
            // 'nickname',
            // 'sex',
            // 'birthday',
            // 'occupation',
            // 'pagehome',
            // 'aboutus',
            // 'avatar',
            // 'address',
            // 'money',
            // 'comefrom',
            // 'update_at',
            // 'create_at',
            // 'create_ip',
            // 'is_del',
            // 'province',
            // 'city',
            // 'avatar_cut',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
