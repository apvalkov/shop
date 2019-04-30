<?php
/**
 * @var $faker \Faker\Generator
 * @var $index int
 */

use app\models\Category;
use app\models\Good;
use yii\helpers\Inflector;

return [
    'id' => $index + 1,
    'category_id' => $faker->randomElement(Category::find()->select('id')->active()->column()),
    'title' => $title = $faker->unique()->name,
    'slug' => Inflector::slug(implode('-', explode(' ', $title))),
    'description' => $faker->text(700),
    'status' => $faker->randomElement(array_keys(Good::getStatuses())),
    'image' => $faker->imageUrl(),
    'price' => $faker->randomFloat(2, 1, 10000),
    'amount' => $faker->randomFloat(2, 1, 1000),
    'created_at' => $date = $faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s'),
    'updated_at' => $date
];