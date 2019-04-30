<?php

/**
 * @var $this yii\web\View
 * @var $categories \app\models\Category[]
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\helpers\Url;

$this->title = 'Магазин';
?>
<div class="col-md-12">

    <div class="col-md-3">
        <div class="list-group">
            <?php foreach ($categories as $category) : ?>
                <a href="<?= Url::to(['category/view', 'slug' => $category->slug])?>" class="list-group-item">
                    <?= $category->title ?> ( <?= $category->getActiveGoods()->count()?> )
                </a>
            <?php endforeach;?>
        </div>
    </div>

    <div class="col-md-9">

        <?= $this->render('@app/views/good/partials/_list_items', [
                'dataProvider' => $dataProvider
        ])?>

    </div>
</div>
