<?php

namespace mvc\app\controllers;

use mvc\framework\core\Controller;

class NotFoundController extends Controller {

    public function __construct() {
        parent::__construct('notfound', 'notfound');
    }

    public function defaultAction() {
        $this->initView();
    }

}