<?php
/**
 * @var $this \yii\web\View
 * @var $good \app\models\Good
 */

use yii\widgets\DetailView;
use app\models\Good;
use yii\helpers\Html;

$this->title = $good->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = ['label' => $good->category->title, 'url' => ['category/view', 'slug' => $good->category->slug]];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $good,
    'attributes' => [
        'title',
        [
            'attribute' => 'image',
            'value' => function (Good $good) {
                return Html::img($good->image);
            },
            'format' => 'html'
        ],
        'description',
        'price',
        'amount',
    ]
])?>