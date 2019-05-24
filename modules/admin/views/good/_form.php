<?php
/**
 * @var \app\modules\admin\models\forms\GoodForm $model
 * @var array $categories
 * @var string $action
 */

use yii\bootstrap\ActiveForm;
use app\models\forms\good\GoodForm;
use yii\helpers\Html;
?>


<div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'method' => 'post'
    ])?>

    <?= $form->field($model, 'title')->textInput()?>

    <?= $form->field($model, 'slug')->textInput()?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(GoodForm::getStatuses(), ['prompt' => 'Выберите статус'])?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Выберите категорию'])?>
        </div>
    </div>


    <?= $form->field($model, 'description')->textarea(['rows' => 10])?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'price')->input('number')?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'amount')->input('number')?>
        </div>
    </div>

    <div class="row">
        <?php if ($model->image):?>

            <div class="col-md-2">
                <img src="<?= $model->image?>" alt="" width="100">
            </div>

        <?php endif;?>
    </div>


    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>

    <?= Html::submitButton($action, ['class' => 'btn btn-primary'])?>

    <?php ActiveForm::end()?>

</div>