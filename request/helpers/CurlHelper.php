<?php

    namespace nyx\request\helpers;

    use nyx\helpers\UrlHelper;

    /**
     * cURL Helper
     */
    class CurlHelper extends UrlHelper
    {
        /**
         * @param string $url
         * @param array  $allowedSchemes
         *
         * @return bool
         */
        public static function isValidUrl(string $url, array $allowedSchemes = ['http', 'https']): bool
        {
            $validUrl = !(filter_var($url, FILTER_VALIDATE_URL) === false);
            $scheme   = parse_url($url, PHP_URL_SCHEME);

            return ($validUrl && in_array($scheme, $allowedSchemes, true));
        }
    }
