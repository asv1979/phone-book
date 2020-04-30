<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Address list';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            'id',
            'f_name',
            'l_name',
            [
                'attribute' => 'phone',
                'format' => 'raw',
                'value' => function (User $model) {

                    $arr =  $model->getPhone()->asArray()->all();
                    $value = '<ul>';
                    foreach ($arr as $item) {
                        $value .= '<li>' . $item['phone'] . '</li>';
                    }
                    $value .= '</ul>';
                    return $value;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
