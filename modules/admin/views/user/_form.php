<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\UserForm
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin()?>

    <?= $form->field($model, 'name')->textInput()?>

    <?= $form->field($model, 'email')->input('email')?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= Html::submitButton('Сохранить' , ['class' => 'btn btn-success'])?>

<?php ActiveForm::end() ?>
