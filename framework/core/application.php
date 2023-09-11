<?php

namespace mvc\framework\core;

use mvc\framework\libs\Messenger;
use mvc\framework\libs\SessionManager;

class Application {

    public static function run() {
        static::autoload();
        static::init();
        static::dispatch();
    }

    private static function init() {

    ini_set('date.timezone', 'Africa/Algiers');

        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT', getcwd() . DS);
        define('APP_PATH', ROOT . 'app' . DS);
        define('FRAMEWORK_PATH', ROOT . 'framework' . DS);

        define('CONFIGS_PATH', APP_PATH . 'configs' . DS);
        define('TEMPLATES_PATH', APP_PATH . 'templates' . DS);
        define('LANGUAGES_PATH', APP_PATH . 'languages' . DS);

        require_once CONFIGS_PATH . 'config.php';

        // BASE HTTP URL
        $root = str_replace(str_split('\\/'), DS, $_SERVER['DOCUMENT_ROOT']);
        define('BASE_URL', str_replace($root, '', getcwd()) . DS);

        define('ACTIVE_TEMPLATE_PATH', TEMPLATES_PATH . DEFAULT_TEMPLATE . DS);
        define('VIEWS_PATH', ACTIVE_TEMPLATE_PATH . 'views' . DS);
        define('COMPONENTS_PATH', ACTIVE_TEMPLATE_PATH . 'components' . DS);

        define('ASSETS_PATH', BASE_URL . 'app/templates/' . DEFAULT_TEMPLATE . '/assets/');
        define('CSS_PATH', ASSETS_PATH . 'css' . DS);
        define('JS_PATH', ASSETS_PATH . 'js' . DS);
        define('IMAGES_PATH', ASSETS_PATH . 'images' . DS);

        // Parse URL
        $url = explode('/', trim($_GET['url'], '/'), 3);
        define('CONTROLLER', $url[0] == null ? 'index' : $url[0]);
        define('ACTION', $url[1] == null ? 'default' : $url[1]);
        define('PARAMS', $url[2]);

        $session = SessionManager::getInstance();
        $session->start();
        $messenger = Messenger::getInstance();
    }

    private function dispatch() {
        $controller_name = sprintf('mvc\app\controllers\%scontroller', CONTROLLER);
        $action_name = ACTION . 'action';

        if (!class_exists($controller_name) || !method_exists($controller_name, $action_name)) {
            $controller_name = 'mvc\app\controllers\NotFoundController';
            $action_name = 'defaultAction';
        }

        $controller = new $controller_name;
        $controller->parseParams();
        $controller->$action_name();
    }

    private static function autoload() {
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    private static function load($className) {
        $className = str_replace('mvc\\', '', $className);
        $className = str_replace('\\', '/', $className);
        $className = ROOT . $className . '.php';
        if (!file_exists($className)) {
            return;
        }

        require_once $className;
    }

}