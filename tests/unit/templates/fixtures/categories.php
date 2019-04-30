<?php
/**
 * @var $faker \Faker\Generator
 * @var $index int
 */

use app\models\Category;
use yii\helpers\Inflector;

return [
    'id' => $index + 1,
    'title' => $title = $faker->unique()->firstName,
    'slug' => Inflector::slug(implode('-', explode(' ', $title))),
    'status' => $faker->randomElement(array_keys(Category::getStatuses())),
    'created_at' => $date = $faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s'),
    'updated_at' => $date
];