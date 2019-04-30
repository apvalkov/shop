<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php
    $columns = 3;
    $cl = 12 / $columns;
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '@app/views/category/_item_view',
        'options' => ['class' => 'text-center'],
        'summary' => false,
        'beforeItem'   => function ($model, $key, $index, $widget) use ($columns) {
            if ( $index % $columns == 0 ) {
                return "<div class='row'>";
            }
        },
        'afterItem' => function ($model, $key, $index, $widget) use ($columns, $dataProvider) {
            if (($index > 0 && $index % $columns === $columns - 1) || ($index + 1) === count($dataProvider->getModels())) {
                return "</div>";
            }
        }
    ])?>

</div>
