<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\CategoryForm
 * @var $parents array
 * @var $statuses array
 */
$this->title = "Обновить категории";
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => '/admin/category'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<?= $this->render('_form', [
    'model' => $model,
    'parents' => $parents,
    'statuses' => $statuses
])?>
