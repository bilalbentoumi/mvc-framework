<?php

namespace mvc\app\controllers;

use mvc\app\models\Category;
use mvc\app\models\Listing;
use mvc\framework\core\Controller;

class ListingsController extends Controller {

    private $validationRules = [
        'listing_title'                 => 'required|minlength(15)|maxlength(30)',
        'category_id'                   => 'required',
        'listing_price'                 => 'required|num',
    ];

    public function defaultAction() {
        $listings = Listing::get('SELECT * FROM listing NATURAL JOIN category');
        $this->template->set('listings', $listings);
        $this->initView();
    }

    public function createAction() {
        $categories = Category::getAll();
        $this->template->set('categories', $categories);
        if (isset($_POST['submit']) && $this->validator->isValid($this->validationRules, $_POST)) {
            $listing = new Listing();
            $listing->category_id = $_POST['category_id'];
            $listing->listing_title = $_POST['listing_title'];
            $listing->listing_description = $_POST['listing_description'];
            $listing->listing_price = $_POST['listing_price'];
            $listing->listing_negotiable = $_POST['listing_negotiable'] == 1 ? 1 : 0;
            $listing->listing_create_date = date('Y-m-d H:i:s');
            $listing->listing_update_date = date('Y-m-d H:i:s');
            if ($listing->save()) {
                $this->messenger->add($this->language->dictionary['str_listing_created']);
                $this->redirect(BASE_URL . 'listings');
            }
        }
        $this->initView();
    }

    public function updateAction() {
        $id = $this->params[0];
        $listing = Listing::getByPrimaryKey($id);
        $this->template->set('listing', $listing);

        $categories = Category::getAll();
        $this->template->set('categories', $categories);

        if (isset($_POST['submit']) && $this->validator->isValid($this->validationRules, $_POST)) {
            $listing->category_id = $_POST['category_id'];
            $listing->listing_title = $_POST['listing_title'];
            $listing->listing_description = $_POST['listing_description'];
            $listing->listing_price = $_POST['listing_price'];
            $listing->listing_negotiable = $_POST['listing_negotiable'] == 1 ? 1 : 0;
            $listing->listing_update_date = date('Y-m-d H:i:s');
            if ($listing->save()) {
                $this->messenger->add($this->language->dictionary['str_listing_updated']);
                $this->redirect(BASE_URL . 'listings');
            }
        }
        $this->initView();
    }

    public function deleteAction() {
        $id = $this->params[0];
        if (Listing::getByPrimaryKey($id)->delete()) {
            $this->messenger->add($this->language->dictionary['str_listing_deleted']);
            $this->redirect(BASE_URL . 'listings');
        }
    }

}