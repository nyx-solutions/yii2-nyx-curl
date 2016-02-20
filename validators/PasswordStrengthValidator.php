<?php

    namespace nox\validators;

    use kartik\password\StrengthValidator;
    use Yii;

    /**
     * Class PasswordStrengthValidator
     *
     * @package nox\validators
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
            Yii::setAlias('@pwdstrength', __DIR__);

            if (empty($this->i18n)) {
                $this->i18n = [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath'       => '@pwdstrength/messages'
                ];
            }

            Yii::$app->i18n->translations['kvpwdstrength'] = $this->i18n;

            $this->applyPreset();
            $this->checkParams();
            $this->setRuleMessages();
        }
    }
