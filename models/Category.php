<?php

namespace app\models;

use app\queries\CategoryQuery;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Модель категории.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Good[] $goods
 */
class Category extends ActiveRecord
{
    const STATUS_ACTIVE = 'active';

    const STATUS_DISABLE = 'disable';

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

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

    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['title', 'slug'], 'unique', 'filter' => function (ActiveQuery $query) {
                return $this->isNewRecord ? $query : $query->andWhere(['<>', 'id', $this->id]);
            }],
            [['title', 'status'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'slug' => 'Url',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления'
        ];
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активно',
            self::STATUS_DISABLE => 'Отключено'
        ];
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        $statuses = self::getStatuses();

        return (isset($statuses[$this->status])) ? $statuses[$this->status] : null;
    }

    /**
     * @return CategoryQuery
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Good::class, ['category_id' => 'id']);
    }

    /**
     * @return \app\queries\GoodQuery
     */
    public function getActiveGoods()
    {
        return Good::find()->where(['category_id' => $this->id])->active();
    }
}