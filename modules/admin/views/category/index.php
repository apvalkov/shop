<?php
/**
 * @var $this \yii\web\View
 * @var $searchModel \app\modules\admin\models\search\CategorySearch
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $statuses array
 */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a('Создать', ['/admin/category/create'], ['class' => 'btn btn-success'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title',
        'slug',
        [
            'attribute' => 'status',
            'filter' => $statuses
        ],
        [
            'class' => '\yii\grid\ActionColumn'
        ]
    ]
])?>
