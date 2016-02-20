<?php

    namespace common\components\validators;

    use kartik\password\StrengthValidator;
    use Yii;

    /**
     * Class PasswordStrengthValidator
     *
     * @package common\components\validators
     */
    class PasswordStrengthValidator extends StrengthValidator
    {
        /**
         * @inheritdoc
         */
        public $encoding = 'UTF-8';

        /**
         * @inheritdoc
         */
        public function init()
        {
            Yii::setAlias('@pwdstrength', dirname(__FILE__));

            if (empty($this->i18n)) {
                $this->i18n = [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath'       => '@common/messages'
                ];
            }

            Yii::$app->i18n->translations['kvpwdstrength'] = $this->i18n;

            $this->applyPreset();
            $this->checkParams();
            $this->setRuleMessages();
        }
    }
