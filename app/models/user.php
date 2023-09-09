<?php

namespace mvc\app\models;

use mvc\framework\core\Model;

class User extends Model {

    public $user_id;
    public $username;
    public $password;
    public $user_email;
    public $user_status;
    public $user_create_date;
    public $user_update_date;

    protected static $tableName = 'user';
    protected static $tableSchema = array(
        'user_id'                   =>  self::DATA_TYPE_INT,
        'username'                  =>  self::DATA_TYPE_STR,
        'password'                  =>  self::DATA_TYPE_STR,
        'user_email'                =>  self::DATA_TYPE_STR,
        'user_status'               =>  self::DATA_TYPE_BOOL,
        'user_create_date'          =>  self::DATA_TYPE_STR,
        'user_update_date'          =>  self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'user_id';

    public function __construct() {
        if (func_num_args() > 0) {
            $this->user_id = func_get_arg(0);
            $this->username = func_get_arg(1);
            $this->password = func_get_arg(2);
            $this->user_email = func_get_arg(3);
            $this->user_status = func_get_arg(4);
            $this->user_create_date = func_get_arg(5);
            $this->user_update_date = func_get_arg(6);
        }
    }

}