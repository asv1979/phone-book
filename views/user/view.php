<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $username string */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($model->fullName) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
