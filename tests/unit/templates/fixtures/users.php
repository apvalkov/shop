<?php
/**
 * @var $faker \Faker\Generator
 */
return [
    'name' => $faker->firstName,
    'email' => $faker->email,
    'password' => Yii::$app->getSecurity()->generatePasswordHash('secret'),
    'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
    'created_at' => $date = $faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s'),
    'updated_at' => $date
];