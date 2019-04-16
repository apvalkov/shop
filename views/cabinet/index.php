<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\forms\user\UserForm
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Личный кабинет: ' . Yii::$app->user->identity->name;
?>

<div class="col-md-8 col-md-offset-2">
    <h1>Личные данные</h1>

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['cabinet/update-user']),
        'method' => 'post'
    ])?>

        <?= $form->field($model, 'email')->textInput()?>

        <?= $form->field($model, 'name')->textInput()?>

        <?= $form->field($model, 'newPassword')->passwordInput()?>

        <?= $form->field($model, 'passwordConfirm')->passwordInput()?>

        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end()?>
</div>


