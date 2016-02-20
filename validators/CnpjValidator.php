<?php

    namespace nox\validators;

    use nox\helpers\Text;
    use yii\validators\Validator;

    /**
     * Class CnpjValidator
     *
     * @package common\components\validators
     */
    class CnpjValidator extends Validator
    {
        /**
         * @inheritdoc
         */
        public function init()
        {
            parent::init();

            $this->message = 'O número de CNPJ informado não é válido.';
        }

        /**
         * @inheritdoc
         */
        public function validateAttribute($model, $attribute)
        {
            if (!$this->validateCnpj($model->$attribute)) {
                $this->addError($model, $attribute, $this->message);
            }
        }

        /**
         * Validates a if a value is a valid CPF number.
         *
         * @param $cnpj string CNPJ Number
         *
         * @return bool
         */
        private function validateCnpj($cnpj)
        {
            $cnpj = Text::justNumbers($cnpj);

            if ($this->skipOnEmpty && empty($cnpj)) {
                return true;
            }

            if (strlen($cnpj) != 14) {
                return false;
            }

            for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
                $sum += $cnpj{$i} * $j;

                $j = ($j == 2) ? 9 : $j - 1;
            }

            $residual = $sum % 11;

            if ($cnpj{12} != ($residual < 2 ? 0 : 11 - $residual)) {
                return false;
            }


            for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {

                $sum += $cnpj{$i} * $j;

                $j = ($j == 2) ? 9 : $j - 1;
            }

            $residual = ($sum % 11);

            return $cnpj{13} == ($residual < 2 ? 0 : 11 - $residual);
        }

        /**
         * @inheritdoc
         */
        public function validateValue($value)
        {
            if (!$this->validateCnpj($value)) {
                return [$this->message, []];
            } else {
                return null;
            }
        }

        /**
         * @inheritdoc
         */
        public function clientValidateAttribute($model, $attribute, $view)
        {
            $message = json_encode($this->message);

            $skipOnEmpty = (($this->skipOnEmpty) ? 'if(cnpj == \'\') return true;' : '');

            return <<<JS
if(typeof(validateCnpjNumber) != 'function'){
	function validateCnpjNumber(cnpj){
		cnpj = cnpj.replace(/([^0-9]{1,})/g, '');

		{$skipOnEmpty}

		var i, c = cnpj.substr(0,12), dv = cnpj.substr(12,2), d1 = 0;

		for(i = 0; i < 12; i++){
			d1 += c.charAt(11-i)*(2+(i % 8));
		}

		if(d1 == 0) return false;

		d1 = 11 - (d1 % 11);

		if(d1 > 9) d1 = 0;

		if(dv.charAt(0) != d1) return false;

		d1 *= 2;

		for(i = 0; i < 12; i++){
			d1 += c.charAt(11-i)*(2+((i+1) % 8));
		}

		d1 = 11 - (d1 % 11);

		if(d1 > 9) d1 = 0;
		if(dv.charAt(1) != d1) return false;

		return true;
	}
}

if(!validateCnpjNumber(value)){
	messages.push($message);
}

JS;

        }
    }
