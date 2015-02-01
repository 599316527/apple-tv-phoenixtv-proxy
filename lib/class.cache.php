<?php

/**
 * 缓存类
 */
class Cache {

    private $filename;

    /**
     * __construct
     * @param String $cache_filename 缓存文件名
     */
    function __construct($cacheFileName) {
        $this->filename = CACHE_PATH . $cacheFileName;
    }

    /**
     * 写入缓存
     * @param  Array $data  缓存数据
     * @return Int       写入字节数
     */
    public function write($data) {
        $data->_write_time = time();
        if (!file_exists($this->filename)) {
            touch($this->filename);
        }
        $ret = file_put_contents($this->filename, json_encode($data));
        return $ret;
    }

    /**
     * 读取缓存
     * @return stdClass 缓存数据
     */
    public function read() {
        if (file_exists($this->filename)) {
            $content = file_get_contents($this->filename);
            return json_decode($content);
        } else {
            return null;
        }
    }

    /**
     * 缓存是否过期
     * @return boolean
     */
    public function isExpires() {
        $content = $this->read();
        return !$content || !$content->_write_time ||
                time() - $content->_write_time > CACHE_AGE;
    }

    /**
     * 是否存在缓存
     * @return boolean
     */
    public function isExist() {
        $content = $this->read();
        return !!$content;
    }

    /**
     * 推遲緩存失效時間
     * @return boolean
     */
    public function postponeExpiration() {
        $data = $this->read();
        if ($data) {
            return $this->write($data);
        } else {
            return false;
        }
    }

}
