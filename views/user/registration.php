<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\forms\user\RegistrationForm
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Регистрация';
?>

<div class="col-md-12">
    <?php $form = ActiveForm::begin(['method' => 'post'])?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end()?>
</div>





