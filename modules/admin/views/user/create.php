<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\forms\UserForm
 */

$this->title = 'Создать пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => '/admin/user'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>


<?= $this->render('_form', [
    'model' => $model
])?>

