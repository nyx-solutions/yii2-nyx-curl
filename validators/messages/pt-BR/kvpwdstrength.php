<?php

    /**
     * Message translations for \kartik\password\StrengthValidator.
     *
     * It contains the localizable messages extracted from source code.
     * You may modify this file by translating the extracted messages.
     *
     * Each array element represents the translation (value) of a message (key).
     * If the value is empty, the message is considered as not translated.
     * Messages that no longer need translation will have their translations
     * enclosed between a pair of '@@' marks.
     *
     * Message string can be used with plural forms format. Check i18n section
     * of the guide for details.
     *
     * NOTE: this file must be saved in UTF-8 encoding.
     */
    return [
        '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!'                                 => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
        '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!'                                  => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
        '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!'                                  => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
        '{attribute} cannot contain the username'                                                                                                  => 'A senha informada não deve conter o seu nome de usuário.',
        '{attribute} cannot contain an email address'                                                                                              => 'A senha informada não deve conter o seu endereço de e-mail.',
        '{attribute} must be a string'                                                                                                             => 'A senha informada deve ser uma string.',
        '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!'           => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
        '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!'           => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
        '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
        '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!'                 => 'A senha deve conter no mínimo um caractere minúsculo, um caractere maiúsculo e dois caracteres numéricos.',
    ];
