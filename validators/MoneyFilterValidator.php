<?php

    namespace common\components\validators;

    use yii\validators\Validator;

    /**
     * Class MoneyFilterValidator
     *
     * @category Validator
     * @author   Jonatas Sas
     *
     * @package  common\components\validators
     */
    class MoneyFilterValidator extends Validator
    {
        /**
         * @var string
         */
        public $thousands = '.';

        /**
         * @var string
         */
        public $decimal = ',';

        /**
         * @var int
         */
        public $precision = 2;

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
            $value = trim((string)$model->$attribute);

            $value = str_replace($this->thousands, '', $value);
            $value = str_replace($this->decimal, '.', $value);
            $value = preg_replace('/([^0-9.]+)/', '', (float)$value);

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
