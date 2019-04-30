<?php
/**
 * @var $faker \Faker\Generator
 */
return [
    'name' => $faker->firstName,
    'email' => $faker->email,
    'password' => Yii::$app->getSecurity()->generatePasswordHash('secret'),
    'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
];