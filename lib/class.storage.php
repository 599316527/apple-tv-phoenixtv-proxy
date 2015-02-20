<?php

require(LIB_PATH.'class.db.php');


class Storage {

    private static $dbInstance;

    public static function getInstance() {
        // 数据库连接 单例
        if (!isset(self::$dbInstance)) {
            $db = new DB(DB_DSN, DB_USERNAME, DB_PASSWORD);
            if (!$db) {
                throw new Exception('Can\'t connect to database');
            }
        }
        $db->query('set names utf8');
        self::$dbInstance = $db;
        return $db;
    }

}
