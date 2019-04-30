<?php
/**
 * @var \app\models\Good $model
 */

use yii\helpers\StringHelper;
use yii\helpers\Url;
?>


<div class="col-sm-4">
    <h4>
        <a href="<?/*= Url::to(['good/view', 'category' => $model->category->slug, 'good' => $model->slug])*/?>">
            <?= $model->title ?>
        </a>
    </h4>
    <div class="card card-price">
        <div class="card-img">
            <a href="#">
                <img src="<?= $model->image ?>" class="img-responsive">
                <!--<div class="card-caption">
                    <span class="h2">Big Item</span>
                    <p>100% silk</p>
                </div>-->
            </a>
        </div>
        <div class="card-body">
            <div class="lead"><?/*= $model->category->title */?></div>
            <div class="text-justify">
                <?= StringHelper::truncate($model->description, 150)?>
            </div>

            <div class="price"><?= Yii::$app->formatter->asCurrency($model->price)?></div>
            <a href="#" class="btn btn-primary btn-lg btn-block buy-now">
                Купить <span class="glyphicon glyphicon-triangle-right"></span>
            </a>
        </div>
    </div>
</div>
