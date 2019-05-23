<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\CategoryForm
 * @var $categories array
 * @var $statuses array
 */

use yii\helpers\Html;

$this->title = 'Create Good';
$this->params['breadcrumbs'][] = ['label' => 'Good', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'statuses' => $statuses
    ]) ?>

</div>