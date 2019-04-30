<?php
/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $category \app\models\Category
 */


$this->title = $category->title;

$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('@app/views/good/partials/_list_items', [
    'dataProvider' => $dataProvider
])?>

