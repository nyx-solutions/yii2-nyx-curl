<?php

    namespace nox\validators;

    use yii\validators\Validator;

    /**
     * Class DateTimeFilterValidator
     *
     * @category Validator
     * @author   Jonatas Sas
     *
     * @package  common\components\validators
     */
    class DateTimeFilterValidator extends Validator
    {
        /**
         * @var string
         */
        public $format = 'd/m/Y H:i:s';

        /**
         * @var bool
         */
        public $useTime = true;

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
            $date = \DateTime::createFromFormat($this->format, $value, new \DateTimeZone(\Yii::$app->getTimeZone()));
            $dataBaseFormat = 'Y-m-d';

            if ($this->useTime) {
                $dataBaseFormat .= ' H:i:s';
            }

            $model->$attribute = $date->format($dataBaseFormat);
        }

        /**
         * @inheritdoc
         */
        public function clientValidateAttribute($model, $attribute, $view)
        {
            return null;
        }
    }
