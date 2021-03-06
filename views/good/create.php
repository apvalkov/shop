<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Good */
/* @var $categories array */

$this->title = 'Создать товар';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="good-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'action' => 'Создать'
    ]) ?>

</div>