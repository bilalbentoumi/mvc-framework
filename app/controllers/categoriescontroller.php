<?php

namespace mvc\app\controllers;

use mvc\app\models\Category;
use mvc\app\models\CategoryField;
use mvc\app\models\CategoryFieldOption;
use mvc\framework\core\Controller;

class CategoriesController extends Controller {

    private $validationRules = [
        'category_name'              => 'required|alphanum|minlength(3)|maxlength(20)',
        'category_link'              => 'required|minlength(3)|maxlength(20)'
    ];

    public function testAction() {
        $fields = CategoryField::getFields(29);
        foreach ($fields as $field) {
            echo '| ' . $field->field_label . '<br>';
            if ($field->field_type == 'select') {
                foreach ($field->options as $option) {
                    echo '| ---> ' . $option->option_name . '<br>';
                }
            }
        }
    }

    public function defaultAction() {
        $categories = Category::getAll();
        $this->template->set('categories', $categories);
        $this->initView();
    }

    public function tabbedAction() {
        $this->initView();
    }

    public function createAction() {
        if (isset($_POST['submit']) && $this->validator->isValid($this->validationRules, $_POST)) {
            $category = new Category();
            $category->category_name = $_POST['category_name'];
            $category->category_link = $_POST['category_link'];
            $category->category_description = $_POST['category_description'];
            $category->category_status = $_POST['category_status'] == 1 ? 1 : 0;
            $category->category_create_date = date('Y-m-d H:i:s');
            $category->category_update_date = date('Y-m-d H:i:s');
            if ($category->save()) {
                $fields = $_POST['fields'];
                if (!empty($fields)) {
                    foreach ($fields as $field) {
                        $categoryfield = new CategoryField();
                        $categoryfield->category_id = $category->category_id;
                        $categoryfield->field_name = $field['name'];
                        $categoryfield->field_label = $field['label'];
                        $categoryfield->field_required = $field['required'] == 1 ? 1 : 0;
                        $categoryfield->field_create_date = date('Y-m-d H:i:s');
                        $categoryfield->field_type = $field['type'];
                        if ($categoryfield->save()) {
                            if ($field['type'] == 'select') {
                                $options = $field['options'];
                                foreach ($options as $option) {
                                    $fieldoption = new CategoryFieldOption();
                                    $fieldoption->field_id = $categoryfield->field_id;
                                    $fieldoption->option_name = $option['name'];
                                    $fieldoption->option_value = $option['value'];
                                    $fieldoption->option_create_date = date('Y-m-d H:i:s');
                                    $fieldoption->save();
                                }
                            }
                        }
                    }
                }

                $this->messenger->add($this->language->dictionary['str_category_created']);
//                $this->redirect(BASE_URL . 'categories');
            }
        }
        $this->initView();
    }

    public function updateAction() {
        $id = $this->params[0];
        $category = Category::getByPrimaryKey($id);
        $fields = CategoryField::getFields($id);
        $this->template->set('category', $category);
        $this->template->set('fields', $fields);
        if (isset($_POST['submit']) && $this->validator->isValid($this->validationRules, $_POST)) {
            $category->category_name = $_POST['category_name'];
            $category->category_link = $_POST['category_link'];
            $category->category_description = $_POST['category_description'];
            $category->category_status = $_POST['category_status'] == 1 ? 1 : 0;
            $category->category_update_date = date('Y-m-d H:i:s');
            if ($category->save()) {
                $this->messenger->add($this->language->dictionary['str_category_updated']);
                $this->redirect(BASE_URL . 'categories');
            }
        }
        $this->initView();
    }

    public function deleteAction() {
        $id = $this->params[0];
        if (Category::getByPrimaryKey($id)->delete()) {
            $this->messenger->add($this->language->dictionary['str_category_deleted']);
            $this->redirect(BASE_URL . 'categories');
        }
    }

    public function textfieldAction() {
        if (isset($_POST['id'])) {
            $this->template->set('id', $_POST['id']);
            echo $this->template->output(COMPONENTS_PATH . 'fields' . DS . 'text_field.tpl');
        }
    }

    public function numericfieldAction() {
        if (isset($_POST['id'])) {
            $this->template->set('id', $_POST['id']);
            echo $this->template->output(COMPONENTS_PATH . 'fields' . DS . 'numeric_field.tpl');
        }
    }

    public function selectfieldAction() {
        if (isset($_POST['id'])) {
            $this->template->set('id', $_POST['id']);
            echo $this->template->output(COMPONENTS_PATH . 'fields' . DS . 'select_field.tpl');
        }
    }

    public function checkboxfieldAction() {
        if (isset($_POST['id'])) {
            $this->template->set('id', $_POST['id']);
            echo $this->template->output(COMPONENTS_PATH . 'fields' . DS . 'checkbox_field.tpl');
        }
    }

    public function optionAction() {
        if (isset($_POST['id'])) {
            $this->template->set('pid', $_POST['pid']);
            $this->template->set('id', $_POST['id']);
            echo $this->template->output(COMPONENTS_PATH . 'fields' . DS . 'option.tpl');
        }
    }

}