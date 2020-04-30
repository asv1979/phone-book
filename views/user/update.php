<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->fullName;
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$phones = $model->getPhone()->asArray()->all();
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'f_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'l_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <h2><?= Html::encode('User phones') ?></h2>
    <?= Html::beginTag('table', ['class' => 'table']) ?>

    <?php
    /** @var array $phones */
    foreach ($phones as $item): ?>
        <?= Html::beginTag('tr'); ?>
        <?= Html::beginTag('td'); ?>
        <?= $item['phone']; ?>
        <?= Html::endTag('td'); ?>
        <?= Html::beginTag('td'); ?>
        <?= Html::a('Edit', ['/phone/update/', 'id' => $item['id'], 'user_id' => $item['user_id']], ['class' => 'btn btn-primary']); ?>
        <?= Html::endTag('td'); ?>
        <?= Html::beginTag('td'); ?>
        <?= Html::beginForm(['/phone/delete/', 'id' => $item['id'], 'user_id' => $model->id], 'post') ?>
        <?= Html::submitButton(
            Html::encode('Delete'),
            ['class' => 'btn btn-danger', 'data-confirm' => 'Are you shoe?']
        )
        ?>
        <?= Html::endForm() ?>
        <?= Html::endTag('td'); ?>
        <?= Html::endTag('tr'); ?>
    <?php endforeach; ?>

    <?= Html::endTag('table') ?>
    <?= Html::beginTag('p'); ?>
    <?= Html::a('Assign phone', ['/phone/create/', 'user_id' => $model->id], ['class' => 'btn btn-success']); ?>
    <?= Html::endTag('p'); ?>

</div>
