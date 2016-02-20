<?php

    namespace nox\validators;

    use nox\helpers\Text;
    use yii\validators\Validator;

    /**
     * Class CpfValidator
     *
     * @package common\components\validators
     */
    class CpfValidator extends Validator
    {
        /**
         * @inheritdoc
         */
        public function init()
        {
            parent::init();

            $this->message = 'O número de CPF informado não é válido.';
        }

        /**
         * @inheritdoc
         */
        public function validateAttribute($model, $attribute)
        {
            if (!$this->validateCpf($model->$attribute)) {
                $this->addError($model, $attribute, $this->message);
            }
        }

        /**
         * Validates a if a value is a valid CPF number.
         *
         * @param $cpf string CPF Number
         *
         * @return bool
         */
        public function validateCpf($cpf)
        {
            $cpf = Text::justNumbers((string)$cpf);

            if ($this->skipOnEmpty && empty($cpf)) {
                return true;
            }

            return self::isCpfValid($cpf);
        }

        /**
         * @param string $cpf
         *
         * @return bool
         */
        public static function isCpfValid($cpf)
        {
            $cpf = Text::justNumbers($cpf);

            if (strlen($cpf) !== 11 || in_array($cpf, [
                    '00000000000',
                    '11111111111',
                    '22222222222',
                    '33333333333',
                    '44444444444',
                    '55555555555',
                    '66666666666',
                    '77777777777',
                    '88888888888',
                    '99999999999'
                ])
            ) {
                return false;
            } else {
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }

                    $d = ((10 * $d) % 11) % 10;

                    if ($cpf{$c} != $d) {
                        return false;
                    }
                }
            }

            return true;
        }

        /**
         * @inheritdoc
         */
        public function validateValue($value)
        {
            if (!$this->validateCpf($value)) {
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

            $skipOnEmpty = (($this->skipOnEmpty) ? 'if(cpf == \'\') return true;' : '');

            return <<<JS
if(typeof(validateCpfNumber) != 'function'){
	function validateCpfNumber(cpf){
		var sum, residual;

		sum = 0;

		cpf = cpf.replace(/([^0-9]{1,})/g, '');

		{$skipOnEmpty}

		if(cpf == '00000000000' || cpf == '11111111111' || cpf == '22222222222' || cpf == '33333333333' || cpf == '44444444444' || cpf == '55555555555' || cpf == '66666666666' || cpf == '77777777777' || cpf == '88888888888' || cpf == '99999999999') return false;

		for(var i = 1; i <= 9; i++) sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);

		residual = (sum * 10) % 11;

		if((residual == 10) || (residual == 11)) residual = 0;
		if(residual != parseInt(cpf.substring(9, 10))) return false;

		sum = 0;

		for(i = 1; i <= 10; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i);

		residual = (sum * 10) % 11;

		if((residual == 10) || (residual == 11)) residual = 0;
		if(residual != parseInt(cpf.substring(10, 11))) return false;

		return true;
	}
}

if(!validateCpfNumber(value)){
	messages.push($message);
}

JS;

        }
    }
