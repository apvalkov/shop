<?php

namespace app\models;

use app\queries\GoodQuery;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property int $id
 * @property int $category_id
 * @property string $status
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property float $price
 * @property float $amount
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 */
class Good extends ActiveRecord
{
    const STATUS_ACTIVE = 'active';

    const STATUS_DISABLE = 'disable';

    const STATUS_IS_OVER = 'is_over';

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('now()'),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%goods}}';
    }

    public function rules()
    {
        return [
            [['title', 'status', 'price', 'amount', 'description', 'category_id'], 'required'],
            [['title', 'slug'], 'unique', 'filter' => function (ActiveQuery $query) {
                return $this->isNewRecord ? $query : $query->andWhere(['<>', 'id', $this->id]);
            }],
            [['title', 'status', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'status' => 'Статус',
            'title' => 'Заголовок',
            'slug' => 'Url',
            'description' => 'Описание',
            'image' => 'Изображение',
            'price' => 'Цена',
            'amount' => 'Количество',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_DISABLE => 'Отключен',
            self::STATUS_IS_OVER => 'Закончился',
        ];
    }

    public function getStatus()
    {
        $statuses = self::getStatuses();

        return (isset($statuses[$this->status])) ? $statuses[$this->status] : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public static function find()
    {
        return new GoodQuery(get_called_class());
    }
}