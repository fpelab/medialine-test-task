<?php

namespace app\modules\api\models;

use app\components\LinkHashBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property string $url
 * @property string $hash
 * @property int $counter
 */
class Link extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'link';
    }

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'LinkHashBehavior' => [
                'class' => LinkHashBehavior::class,
                'attribute' => 'hash',
                'attributes' => [ActiveRecord::EVENT_BEFORE_VALIDATE => 'hash']
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['url', 'hash'], 'required'],
            [['counter'], 'integer'],
            [['url'], 'url', 'validSchemes' => ['https', 'http']],
            [['url'], 'unique'],
            [['url'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 10],
            ['counter', 'default', 'value' => 0]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'hash' => 'Hash',
            'counter' => 'Counter',
        ];
    }
}
