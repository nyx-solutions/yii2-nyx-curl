<?php

    namespace common\components\validators;

    use yii\validators\Validator;

    /**
     * Class OneWordValidator
     *
     * @package common\components
     */
    class OneWordValidator extends Validator
    {
        /**
         * @inheritdoc
         */
        public function init()
        {
            parent::init();

            $this->message = 'O campo "{attribute}" deve conter apenas uma única palavra (sem números, caracteres especiais ou espaços).';
        }

        /**
         * @inheritdoc
         */
        public function validateAttribute($model, $attribute)
        {
            if (!$this->validateWord($model->$attribute)) {
                $this->addError($model, $attribute, $this->getMessage($model->getAttributeLabel($attribute)));
            }
        }

        /**
         * Validates if a value is a valid single word.
         *
         * @param $word string Word
         *
         * @return bool
         */
        private function validateWord($word)
        {
            if ($this->skipOnEmpty && empty($word)) {
                return true;
            }

            if (preg_match('/( )/', $word)) {
                return false;
            }
            if (preg_match('/([0-9]+)/', $word)) {
                return false;
            }

            $specialChars = [
                '"',
                '\'',
                '!',
                '@',
                '#',
                '$',
                '%',
                '¨',
                '&',
                '*',
                '(',
                ')',
                '_',
                '-',
                '+',
                '=',
                '§',
                'ª',
                'º',
                '{',
                '}',
                '[',
                ']',
                '?',
                '/',
                '\\',
                ';',
                ':',
                '.',
                ',',
                '<',
                '>',
                '|',
                '´',
                '`',
                '^',
                '~'
            ];

            foreach ($specialChars as $specialChar) {
                if (strpos($word, $specialChar) !== false) {
                    return false;
                }
            }

            return true;
        }

        /**
         * Gets the filtered message.
         *
         * @param $attribute string Attribute name
         *
         * @return string Message
         */
        private function getMessage($attribute)
        {
            return (string)preg_replace('/\{attribute\}/', $attribute, $this->message);
        }

        /**
         * @inheritdoc
         */
        public function validateValue($value)
        {
            if (!$this->validateWord($value)) {
                return ['O valor deve ser uma única palavra (sem números, caracteres especiais ou espaços).', []];
            } else {
                return null;
            }
        }

        /**
         * @inheritdoc
         */
        public function clientValidateAttribute($model, $attribute, $view)
        {
            $message = json_encode($this->getMessage($model->getAttributeLabel($attribute)));

            $skipOnEmpty = (($this->skipOnEmpty) ? 'if(word == \'\') return true;' : '');

            return <<<JS
if(typeof(validateOneWord) != 'function'){
	function validateOneWord(word){
		{$skipOnEmpty}

		if(word.match(/(\ )/g)) return false;
		if(word.match(/([0-9]{1,})/g)) return false;

		var specialChars = ['"', '\'', '!', '@', '#', '$', '%', '¨', '&', '*', '(', ')', '_', '-', '+', '=', '§', 'ª', 'º', '{', '}', '[', ']', '?', '/', '\\\', ';', ':', '.', ',', '<', '>', '|', '´', '`', '^', '~'];

		for(var i = 0; i < specialChars.length; i++){
			if(word.indexOf(specialChars[i]) !== -1) return false;
		}

		return true;
	}
}

if(!validateOneWord(value)){
	messages.push($message);
}

JS;

        }
    }
