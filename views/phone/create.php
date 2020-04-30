<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Phone */

$this->title = 'Create Phone';
$this->params['breadcrumbs'][] = ['label' => 'Phones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user_name = $user['f_name'] . ($user['l_name'] ? ' ' . $user['l_name'] : '');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.js');

$this->registerJsFile(
    '@web/js/main.js',
    [
        'depends' => [\yii\web\JqueryAsset::class],
        'position' => '\yii\web\View::POS_END'
    ]
);


?>
<div class="phone-create">

    <h1><?= Html::encode('Create number for - ' . $user_name) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

