<?php

namespace mvc\framework\core;

use mvc\framework\helpers\InputFilter;
use mvc\framework\helpers\Redirect;
use mvc\framework\libs\Language;
use mvc\framework\libs\Messenger;
use mvc\framework\libs\Template;
use mvc\framework\libs\Validator;

class Controller {

    use InputFilter;
    use Redirect;

    protected $params;
    protected $template;
    protected $language;
    protected $messenger;
    protected $validator;

    protected $controller;
    protected $action;

    public function __construct($controller = CONTROLLER, $action = ACTION) {
        $this->messenger = Messenger::getInstance();
        $this->validator = new Validator();
        $this->language = Language::getInstance();
        $this->template = new Template(ACTIVE_TEMPLATE_PATH . 'layout.tpl');

        $this->controller = $controller;
        $this->action = $action;

        /* Set Language String to Template */
        $this->language->load($this->controller . DS . $this->action);
        foreach ($this->language->dictionary as $key => $value) {
            $this->template->set($key, $value);
        }

    }

    public function parseParams() {
        $this->params = explode('/', PARAMS);
    }

    public function initView() {
        /* Messages */
        $this->template->set('messages', $this->messenger->getMessages());

        /* Render View */
        $view = $this->template->output(VIEWS_PATH . $this->controller . DS . $this->action . '.view.tpl');
        $this->template->set('body', $view);
        $this->template->render();
    }

}