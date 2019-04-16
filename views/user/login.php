<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\forms\user\LoginForm
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Вход'
?>

<div class="col-md-offset-2 col-md-8">

    <h1><?= Html::encode($this->title)?></h1>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
    ])?>

        <?= $form->field($model, 'email')->textInput()?>

        <?= $form->field($model, 'password')->passwordInput()?>

        <?= $form->field($model, 'rememberMe')->checkbox()?>

        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary'])?>

    <?php ActiveForm::end()?>
</div>
