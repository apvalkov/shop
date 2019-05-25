<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \app\models\search\GoodSearch
 * @var $categories array
 */

use app\models\Good;
use yii\helpers\Html;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a('Создать', ['/admin/good/create'], ['class' => 'btn btn-success'])?>



<div class="row">
    <div class="col-md-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'category_id',
                    'value' => 'category.title',
                    'filter' => $categories
                ],
                'title',
                [
                    'attribute' => 'status',
                    'value' => function (Good $good) {
                        return $good->getStatus();
                    },
                    'filter' => Good::getStatuses()
                ],
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
                ['class' => 'yii\grid\ActionColumn'],
            ]
        ])?>

    </div>
</div>