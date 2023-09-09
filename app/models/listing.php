<?php

namespace mvc\app\models;

use mvc\framework\core\Model;

class Listing extends Model {

    public $listing_id;
    public $category_id;
    public $listing_title;
    public $listing_description;
    public $listing_price;
    public $listing_negotiable;
    public $listing_create_date;
    public $listing_update_date;

    protected static $tableName = 'listing';
    protected static $tableSchema = array(
        'listing_id'                   =>  self::DATA_TYPE_INT,
        'category_id'                  =>  self::DATA_TYPE_INT,
        'listing_title'                =>  self::DATA_TYPE_STR,
        'listing_description'          =>  self::DATA_TYPE_STR,
        'listing_price'                =>  self::DATA_TYPE_STR,
        'listing_negotiable'           =>  self::DATA_TYPE_BOOL,
        'listing_create_date'          =>  self::DATA_TYPE_STR,
        'listing_update_date'          =>  self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'listing_id';

    public function __construct() {
        if (func_num_args() > 0) {
            $this->listing_id = func_get_arg(0);
            $this->category_id = func_get_arg(1);
            $this->listing_title = func_get_arg(2);
            $this->listing_description = func_get_arg(3);
            $this->listing_price = func_get_arg(4);
            $this->listing_negotiable = func_get_arg(5);
            $this->listing_create_date = func_get_arg(6);
            $this->listing_update_date = func_get_arg(7);
        }
    }

}