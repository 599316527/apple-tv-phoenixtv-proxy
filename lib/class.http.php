<?php

class HTTP {

    private static $httpStatusText = array(
        '200' => 'OK',
        '400' => 'Bad Request',
        '403' => 'Forbidden',
        '404' => 'Not Found',
        '500' => 'Internal Server Error'
    );

    private static function getHttpStatusTextByCode($code) {
        return self::$httpStatusText[$code] ? self::$httpStatusText[$code] : '';
    }

    public static function throwError($code, $message = '') {
        $text = self::getHttpStatusTextByCode($code);
        header("HTTP/1.1 {$code} {$text}");
        include(TPL_PATH.'error.tpl.html');
        exit();
    }

    public static function redirect($url) {
        header("HTTP/1.1 302 Found");
        header('Location: ' . $url);
    }

}
