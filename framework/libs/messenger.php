<?php

namespace mvc\framework\libs;

class Messenger {

    const MESSAGE_SUCCESS   = 'success';
    const MESSAGE_ERROR     = 'error';
    const MESSAGE_WARNING   = 'warning';
    const MESSAGE_INFO      = 'info';

    private static $instance;
    private $session;
    private $language;
    private $messages = [];

    private function __construct() {
        $this->session = SessionManager::getInstance();
        $this->language = Language::getInstance();
    }

    private function __clone() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add($message, $type = self::MESSAGE_SUCCESS) {
        if(!$this->messagesExists()) {
            $this->session->messages = [];
        }
        $this->messages = $this->session->messages;
        $this->messages[] = ['text' => $message, 'type' => $type];
        $this->session->messages = $this->messages;
    }

    private function messagesExists() {
        return isset($this->session->messages);
    }

    public function getMessages() {
        if($this->messagesExists()) {
            $this->messages = $this->session->messages;
            unset($this->session->messages);
            return $this->messages;
        }
        return [];
    }

}