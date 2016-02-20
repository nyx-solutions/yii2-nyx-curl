<?php

    namespace common\components\validators;

    use yii\validators\Validator;

    /**
     * Class JustNumbersFilterValidator
     *
     * @category Validator
     * @author   Jonatas Sas
     *
     * @package  common\components\validators
     */
    class JustNumbersFilterValidator extends Validator
    {
        /**
         * @inheritdoc
         */
        public function init()
        {
            parent::init();
        }

        /**
         * @inheritdoc
         */
        public function validateAttribute($model, $attribute)
        {
            $value = (string)$model->$attribute;
            $value = preg_replace('/([^0-9]+)/', '', $value);

            $model->$attribute = $value;
        }

        /**
         * @inheritdoc
         */
        public function clientValidateAttribute($model, $attribute, $view)
        {
            return null;
        }
    }
