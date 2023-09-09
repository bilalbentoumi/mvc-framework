<?php

namespace mvc\framework\libs;

class Language {

    private static $instance;
    public $dictionary;

    private function __construct() {
        $this->loadTemplateSettings();
        $this->loadCommonProperties();
        $this->loadFieldsCommon();
        $this->loadMessages();
    }

    /* Load Language From Path*/
    public function load($path) {
        $lang = @include_once LANGUAGES_PATH . DEFAULT_LANGUAGE . DS . $path . '.lang.php';
        if (!empty($lang)) {
            foreach ($lang as $key => $value) {
                $this->dictionary[$key] = $value;
            }
        }
    }

    /* Load Language Settings */
    public function loadTemplateSettings() {
        $lang = @include_once LANGUAGES_PATH . DEFAULT_LANGUAGE . DS . 'settings.php';
        if (!empty($lang)) {
            foreach ($lang as $key => $value) {
                $this->dictionary[$key] = $value;
            }
        }
    }

    /* Load Language Common */
    public function loadCommonProperties() {
        $lang = @include_once LANGUAGES_PATH . DEFAULT_LANGUAGE . DS . 'common.lang.php';
        if (!empty($lang)) {
            foreach ($lang as $key => $value) {
                $this->dictionary[$key] = $value;
            }
        }
    }

    /* Load Language Common */
    public function loadFieldsCommon() {
        $lang = @include_once LANGUAGES_PATH . DEFAULT_LANGUAGE . DS . CONTROLLER . DS . 'common.lang.php';
        if (!empty($lang)) {
            foreach ($lang as $key => $value) {
                $this->dictionary[$key] = $value;
            }
        }
    }

    /* Load Messages */
    public function loadMessages() {
        $lang = @include_once LANGUAGES_PATH . DEFAULT_LANGUAGE . DS . CONTROLLER . DS . 'messages.lang.php';
        if (!empty($lang)) {
            foreach ($lang as $key => $value) {
                $this->dictionary[$key] = $value;
            }
        }
    }

    /* Get Instance Function */
    /* Returns the same instance in all pages */
    public static function getInstance() {
        if (static::$instance == NULL) {
            static::$instance = new self();
        }
        return static::$instance;
    }

}