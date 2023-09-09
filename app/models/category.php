<?php

namespace mvc\app\models;

use mvc\framework\core\Model;

class Category extends Model {

    public $category_id;
    public $category_name;
    public $category_link;
    public $category_description;
    public $category_status;
    public $category_create_date;
    public $category_update_date;

    protected static $tableName = 'category';
    protected static $tableSchema = array(
        'category_id'                  =>  self::DATA_TYPE_INT,
        'category_name'                =>  self::DATA_TYPE_STR,
        'category_link'                =>  self::DATA_TYPE_STR,
        'category_description'         =>  self::DATA_TYPE_STR,
        'category_status'              =>  self::DATA_TYPE_BOOL,
        'category_create_date'         =>  self::DATA_TYPE_STR,
        'category_update_date'         =>  self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'category_id';

    public function __construct() {
        if (func_num_args() > 0) {
            $this->category_id = func_get_arg(0);
            $this->category_name = func_get_arg(1);
            $this->category_link = func_get_arg(2);
            $this->category_description = func_get_arg(3);
            $this->category_status = func_get_arg(4);
            $this->category_create_date = func_get_arg(5);
            $this->category_update_date = func_get_arg(6);
        }
    }

}