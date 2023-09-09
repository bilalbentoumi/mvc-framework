<?php

namespace mvc\framework\libs;

class SessionManager extends \SessionHandler {

    private static $instance;

    /* Session Configs */
    private $sessionName = 'MVCSESS';
    private $sessionLifetime = 0;
    private $sessionSSL = false;
    private $sessionHTTPOnly = true;
    private $sessionPath = '/';
    private $sessionDomain = '.localhost';
    private $sessionSavePath;

    private $ttl = 10;

    /* OpenSSL Configs */
    private $method = 'AES-128-ECB';
    private $key = '^B!L@L-B3NTOUWI^';

    private function __construct() {
        $this->sessionSavePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'sessions';

        @ini_set('session.use_cookies', 1);
        @ini_set('session.use_only_cookies', 1);
        @ini_set('session.use_trans_sid', 0);
        @ini_set('session.save_handler', 'files');

        session_name($this->sessionName);
        session_save_path($this->sessionSavePath);

        session_set_cookie_params(
            $this->sessionLifetime,
            $this->sessionPath,
            $this->sessionDomain,
            $this->sessionSSL,
            $this->sessionHTTPOnly
        );

        session_set_save_handler($this, true);
    }

    public function read($id) {
        return openssl_decrypt(parent::read($id), $this->method, $this->key);
    }

    public function write($id, $data) {
        return parent::write($id, openssl_encrypt($data, $this->method, $this->key));
    }

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function __get($name) {
        return $_SESSION[$name];
    }

    public function __unset($name)    {
        unset($_SESSION[$name]);
    }

    public function __isset($name) {
        return isset($_SESSION[$name]);
    }

    public function start() {
        if (session_id() == '') {
            if (session_start()) {
                if (!isset($this->startTime))
                    $this->startTime = time();

                if (!$this->isSessionValid())
                    $this->renew();
            }
        }
    }

    public function renew() {
        session_regenerate_id(true);
        $this->startTime = time();
    }

    public function isSessionValid() {
        return ((time() - $this->startTime) < ($this->ttl * 60)) ? true : false;
    }

    public function kill() {
        session_unset();
        session_destroy();
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}