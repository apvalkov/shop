<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\Good
 */

use yii\widgets\DetailView;
use app\models\Good;
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['good/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'category_id',
            'value' => function($data){
                return $data->category->title;
            },
        ],
        [
            'attribute' => 'status',
            'value' => function (Good $good) {
                return $good->getStatus();
            },
            'filter' => Good::getStatuses()
        ],
        'title',
        [
            'attribute' => 'image',
            'value' => function (Good $good) {
                return Html::img($good->image);
            },
            'format' => 'html'
        ],
        'slug',
        'description',
        'price',
        'amount'
    ]
])?>
