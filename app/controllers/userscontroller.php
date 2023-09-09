<?php

namespace mvc\app\controllers;

use mvc\app\models\Category;
use mvc\app\models\User;
use mvc\framework\core\Controller;

class UsersController extends Controller {

    private $validationRules = [
        'username'              => 'required|alphanum|minlength(3)|maxlength(20)',
        'password'              => 'required|minlength(3)|maxlength(20)',
        'email'            => 'required|email'
    ];

    public function defaultAction() {
        $users = User::getAll();
        $this->template->set('users', $users);
        $this->initView();
    }

    public function createAction() {
        if (isset($_POST['submit']) && $this->validator->isValid($this->validationRules, $_POST)) {
            $user = new User();
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->user_email = $_POST['email'];
            $user->user_status = $_POST['status'] == 1 ? 1 : 0;
            $user->user_create_date = date('Y-m-d H:i:s');
            $user->user_update_date = date('Y-m-d H:i:s');
            if ($user->save()) {
                $this->messenger->add($this->language->dictionary['str_user_created']);
                $this->redirect(BASE_URL . 'users');
            }
        }
        $this->initView();
    }

    public function updateAction() {
        $id = $this->params[0];
        $user = User::getByPrimaryKey($id);
        $this->template->set('user', $user);
        if (isset($_POST['submit'])) {
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->user_email = $_POST['email'];
            $user->user_status = $_POST['status'] == 1 ? 1 : 0;
            $user->user_update_date = date('Y-m-d H:i:s');
            if ($user->save()) {
                $this->messenger->add($this->language->dictionary['str_user_updated']);
                $this->redirect(BASE_URL . 'users');
            }
        }
        $this->initView();
    }

    public function deleteAction() {
        $id = $this->params[0];
        if (Category::getByPrimaryKey($id)->delete()) {
            $this->messenger->add($this->language->dictionary['str_user_deleted']);
            $this->redirect(BASE_URL . 'users');
        }
    }

}