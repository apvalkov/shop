<?php
/**
 * @var $this \yii\web\View
 * @var $searchModel \app\modules\admin\models\search\GoodSearch
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $statuses array
 * @var $categories array
 */

use yii\grid\GridView;
use app\models\Good;
use yii\helpers\Html;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a('Создать', ['/admin/good/create'], ['class' => 'btn btn-success'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        [
            'attribute' => 'category_id',
            'value' => 'category.title',
            'filter' => $categories
        ],
        [
            'attribute' => 'status',
            'value' => function (Good $good) {
                return $good->getStatus();
            },
            'filter' => Good::getStatuses()
        ],
        'title',
        'slug',
        'description:text',
        [
            'attribute' => 'image',
            'value' => function (Good $good){
                if ($good->image) {
                    return Html::img($good->image, ['width' => 50, 'height' => 50]);
                }

                return null;
            },
            'format' => 'html'
        ],
        'price',
        'amount',
        [
            'class' => '\yii\grid\ActionColumn'
        ]
    ]
])?>