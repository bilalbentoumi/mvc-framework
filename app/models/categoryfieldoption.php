<?php

namespace mvc\app\models;

use mvc\framework\core\Model;

class CategoryFieldOption extends Model {

    public $option_id;
    public $field_id;
    public $option_name;
    public $option_value;
    public $option_create_date;

    protected static $tableName = 'category_field_option';
    protected static $tableSchema = array(
        'option_id'                         =>  self::DATA_TYPE_INT,
        'field_id'                          =>  self::DATA_TYPE_INT,
        'option_name'                       =>  self::DATA_TYPE_STR,
        'option_value'                      =>  self::DATA_TYPE_STR,
        'option_create_date'                 =>  self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'option_id';

    public function __construct() {
        if (func_num_args() > 0) {
            $this->option_id = func_get_arg(0);
            $this->field_id = func_get_arg(1);
            $this->option_name = func_get_arg(2);
            $this->option_value = func_get_arg(3);
            $this->option_create_date = func_get_arg(4);
        }
    }

}