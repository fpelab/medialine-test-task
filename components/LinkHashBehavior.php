<?php

namespace app\components;

use Yii;
use yii\validators\UniqueValidator;
use yii\behaviors\AttributeBehavior;

class LinkHashBehavior extends AttributeBehavior
{

   /**
    * @var string the attribute whose value will be converted into a hash
    */
    public $attribute;

    /**
     * {@inheritdoc}
     * @throws yii\base\Exception
     */
    protected function getValue($event): string
    {
        return $this->makeUnique();
    }

    /**
     * Create hash and check is it unique in table, if no regenerate it
     * @return string
     * @throws yii\base\Exception
     */
    private function makeUnique(): string
    {
        /* @var $model yii\db\BaseActiveRecord */
        $hash = '';
        $isHashUnique = false;
        $model = clone $this->owner;
        $validator = Yii::createObject(['class' => UniqueValidator::class]);

        while (!$isHashUnique) {
            $hash = Yii::$app->security->generateRandomString(6);
            $model->clearErrors();
            $model->{$this->attribute} = $hash;
            $validator->validateAttribute($model, $this->attribute);
            $isHashUnique = !$model->hasErrors();
        }

        return $hash;
    }
}
