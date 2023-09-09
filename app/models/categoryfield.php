<?php

namespace mvc\app\models;

use mvc\framework\core\Model;

class CategoryField extends Model {

    public $field_id;
    public $category_id;
    public $field_type;
    public $field_name;
    public $field_label;
    public $field_required;
    public $field_create_date;

    protected static $tableName = 'category_field';
    protected static $tableSchema = array(
        'field_id'                      =>  self::DATA_TYPE_INT,
        'category_id'                   =>  self::DATA_TYPE_INT,
        'field_type'                    =>  self::DATA_TYPE_INT,
        'field_name'                    =>  self::DATA_TYPE_STR,
        'field_label'                   =>  self::DATA_TYPE_STR,
        'field_required'                =>  self::DATA_TYPE_BOOL,
        'field_create_date'             =>  self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'field_id';

    public function __construct() {
        if (func_num_args() > 0) {
            $this->field_id = func_get_arg(0);
            $this->category_id = func_get_arg(1);
            $this->field_type = func_get_arg(2);
            $this->field_name = func_get_arg(3);
            $this->field_label = func_get_arg(4);
            $this->field_required = func_get_arg(5);
            $this->field_create_date = func_get_arg(6);
        }
    }

    public static function getFields($category_id) {
        $fields = static::get('SELECT * FROM category_field WHERE category_id = ' . $category_id);
        if (!empty($fields)) {
            foreach ($fields as $i =>$field) {
                if ($field->field_type == 'select') {
                    $fields[$i]->options = CategoryFieldOption::get('SELECT * FROM category_field_option WHERE field_id = ' . $field->field_id);
                    $fields[$i]->options = $fields[$i]->options == false ? null : $fields[$i]->options;
                }
            }
        }
        return $fields;
    }

}