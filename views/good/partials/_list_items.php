<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $this \yii\web\View
 */

use yii\widgets\ListView;
?>

<?php
$columns = 3;
$cl = 12 / $columns;
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@app/views/good/_view_item',
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
