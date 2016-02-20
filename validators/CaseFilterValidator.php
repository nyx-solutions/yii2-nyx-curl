<?php

    namespace nox\validators;

    use yii\validators\Validator;

    /**
     * Class CaseFilterValidator
     *
     * @category Validator
     * @author   Jonatas Sas
     *
     * @package  common\components\validators
     */
    class CaseFilterValidator extends Validator
    {
        /**
         * @var integer
         */
        public $mode = MB_CASE_UPPER;

        /**
         * @var bool
         */
        public $trim = false;

        /**
         * @inheritdoc
         */
        public function init()
        {
            parent::init();
        }

        /**
         * @inheritdoc
         *
         * @todo-project Verificar se o Yii informa o encoding.
         */
        public function validateAttribute($model, $attribute)
        {
            $value = (string)$model->$attribute;

            if ($this->trim) {
                $value = trim($value);
            }

            if (!in_array($this->mode, [MB_CASE_LOWER, MB_CASE_LOWER, MB_CASE_TITLE])) {
                $this->mode = MB_CASE_UPPER;
            }

            $model->$attribute = mb_convert_case($value, $this->mode, 'UTF-8');
        }

        /**
         * @inheritdoc
         */
        public function clientValidateAttribute($model, $attribute, $view)
        {
            return null;
        }
    }
