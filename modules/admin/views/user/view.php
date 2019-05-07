<?php
/**
 * @var $model \app\models\User
 */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Пользователь: '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => '/admin'];
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => '/admin/user'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<h1>
    <?= Html::encode($this->title)?>
</h1>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'email'
    ]
])?>
