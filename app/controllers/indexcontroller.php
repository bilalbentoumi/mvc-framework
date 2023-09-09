<?php

namespace mvc\app\controllers;

use mvc\framework\core\Controller;

class IndexController extends Controller {

    public function defaultAction() {
        $this->initView();
    }

}