<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServiceAccessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Service Accesses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-access-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Service Access'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'user_id',
            [
                'attribute' => 'user_name',
                'label' => 'User name',
                'value' => function($data) {
                    return \backend\models\User::find()->where(['=','id',$data->user_id])->asArray()->all()[0]['username'];
                }
            ],
//            'id1',
            [
              'attribute' => 'pw1',
                'label' => 'Better Docor key'
            ],
            'id2',
             'pw2',
             'id3',
             'pw3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
