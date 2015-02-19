<?php

class Query {

    /**
     * 是否存在参数
     * @param  string $key  参数名
     * @return boolean      是否存在
     */
    static public function isExistParam($key) {
        return isset($_GET[$key]) && !empty($_GET[$key]);
    }


    /**
     * 處理來自命令行的參數
     */
    static private function parseParamFromCli() {
        global $argc;
        if ($argc) {
            global $argv;
            parse_str(implode('&', array_slice($argv, 1)), $_GET);
        }
    }

    /**
     * 获取请求参数
     * @param  string $key  参数名
     * @return string       参数值
     */
    static public function getParam($key) {
        self::parseParamFromCli();
        return self::isExistParam($key) ? trim($_GET[$key]) : null;
    }

}
