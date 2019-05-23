<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\CategoryForm
 * @var $categories array
 * @var $statuses array
 */

$this->title = 'Обновить товар:' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => '/admin/good'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<?= $this->render('_form', [
    'model' => $model,
    'categories' => $categories,
    'statuses' => $statuses
])?>
