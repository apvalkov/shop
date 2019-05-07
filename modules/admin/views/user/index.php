<?php
/**
 * @var $this \yii\web\View
 * @var $searchModel \app\modules\admin\models\search\UserSearch
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;
use kartik\daterange\DateRangePicker;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a('Создать', ['/admin/user/create'], ['class' => 'btn btn-success'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'name',
        'email:email',
        [
            'attribute' => 'created_at',
            'value' => 'created_at',
            'format' => 'date',
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
                'convertFormat' => true,
                'startAttribute' => 'createdStart',
                'endAttribute' => 'createdEnd',
                'pluginEvents'=>[
                    'cancel.daterangepicker' => <<<JS
function(ev, picker) {
    $('#usersearch-created_at').val('');
    $('#usersearch-created_at-start').val('');
    $('#usersearch-created_at-end').val('');
    $('.grid-view').yiiGridView('applyFilter');
}
JS
                ],
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 15,
                    'locale' => [
                        'format' => 'Y-m-d'
                    ]
                ]
            ])
        ],
        [
            'attribute' => 'updated_at',
            'value' => 'updated_at',
            'format' => 'date',
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'updated_at',
                'convertFormat' => true,
                'startAttribute' => 'updatedStart',
                'endAttribute' => 'updatedEnd',
                'pluginEvents'=>[
                    'cancel.daterangepicker' => <<<JS
function(ev, picker) {
    $('#usersearch-updated_at').val('');
    $('#usersearch-updated_at-start').val('');
    $('#usersearch-updated_at-end').val('');
    $('.grid-view').yiiGridView('applyFilter');
}
JS
                ],
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 15,
                    'locale' => [
                        'format' => 'Y-m-d'
                    ]
                ]
            ])
        ],
        [
            'class' => '\yii\grid\ActionColumn'
        ]
    ]
])?>


