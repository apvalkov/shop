<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\GoodForm
 * @var $categories array
 * @var $statuses array
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="col-md-6">
    <?php $form = ActiveForm::begin()?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Выберите категорию'])?>

    <?= $form->field($model, 'status')->dropDownList($statuses, ['prompt' => 'Выберите статус'])?>

    <?= $form->field($model, 'title')->textInput()?>

    <?= $form->field($model, 'slug')->textInput()?>

    <?= $form->field($model, 'description')->textarea(['rows' => 10])?>

    <?= $form->field($model, 'price')->input('number')?>

    <?= $form->field($model, 'amount')->input('number')?>

    <div class="row">
        <?php if ($model->image):?>

            <div class="col-md-2">
                <img src="<?= $model->image?>" alt="" width="100">
            </div>

        <?php endif;?>
    </div>

    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>

    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary'])?>

    <?php ActiveForm::end()?>
</div>