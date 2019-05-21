<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\CategoryForm
 * @var $parents array
 * @var $statuses array
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="col-md-6">
    <?php $form = ActiveForm::begin()?>

        <?= $form->field($model, 'title')->textInput()?>

        <?= $form->field($model, 'slug')->textInput()?>

        <?= $form->field($model, 'parent_id')->dropDownList($parents, ['prompt' => 'Выберите категорию'])?>

        <?= $form->field($model, 'status')->dropDownList($statuses, ['prompt' => 'Выберите статус'])?>

        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary'])?>

    <?php ActiveForm::end()?>
</div>


