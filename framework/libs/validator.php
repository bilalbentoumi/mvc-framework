<?php

namespace mvc\framework\libs;

use mvc\framework\libs\Registry;

class Validator {

    private $messenger;
    private $language;

    public function __construct() {
        $this->messenger = Messenger::getInstance();
        $this->language = Language::getInstance();
        $this->language->load('validator' . DS . 'errors');
    }

    private $_regexPatterns = [
        'num'           => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'           => '/^[0-9]+$/',
        'float'         => '/^[0-9]+\.[0-9]+$/',
        'alpha'         => '/^[a-zA-Z\p{Arabic} ]+$/u',
        'alphanum'      => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
        'date'          => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email'         => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url'           => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
    ];

    public function num($value) {
        return (bool) preg_match($this->_regexPatterns['num'], $value);
    }

    public function int($value) {
        return (bool) preg_match($this->_regexPatterns['int'], $value);
    }

    public function float($value) {
        return (bool) preg_match($this->_regexPatterns['float'], $value);
    }

    public function alpha($value) {
        return (bool) preg_match($this->_regexPatterns['alpha'], $value);
    }

    public function alphanum($value) {
        return (bool) preg_match($this->_regexPatterns['alphanum'], $value);
    }

    public function bool($value) {
        return is_bool($value);
    }

    public function date($value) {
        return (bool) preg_match($this->_regexPatterns['date'], $value);
    }

    public function email($value) {
        return (bool) preg_match($this->_regexPatterns['email'], $value);
    }

    public function url($value) {
        return (bool) preg_match($this->_regexPatterns['url'], $value);
    }

    public function min($value, $min) {
        return $value >= $min;
    }

    public function max($value, $max) {
        return $value <= $max;
    }

    public function minlength($value, $minlength) {
        return mb_strlen($value) >= $minlength;
    }

    public function maxlength($value, $maxlength) {
        return mb_strlen($value) <= $maxlength;
    }

    public function eq($firstValue, $secondValue) {
        return $firstValue == $secondValue;
    }

    public function hasSpaces($value) {
        return strpos($value, ' ') != false ? true : false ;
    }

    public function isValid($inputrules, $input) {
        $errors = [];
        if(!empty($inputrules)) {
            foreach ($inputrules as $fieldname => $rules) {
                $value = $input[$fieldname];
                $rules = explode('|', $rules);

                foreach ($rules as $rule) {
                    if (array_key_exists($fieldname, $errors))
                        continue;

                    if ($rule == 'required') {
                        if ($value == '' || empty($value)) {
                            $this->messenger->add(
                                sprintf($this->language->dictionary['str_error_notnull'],
                                    $this->language->dictionary['str_' . $fieldname]),
                                Messenger::MESSAGE_ERROR
                            );
                            $errors[$fieldname] = true;
                        }
                    } if ($rule == 'nospace') {
                        if ($this->hasSpaces($value)) {
                            $this->messenger->add(
                                sprintf($this->language->dictionary['str_error_nospace'],
                                    $this->language->dictionary['str_' . $fieldname]),
                                Messenger::MESSAGE_ERROR
                            );
                            $errors[$fieldname] = true;
                        }
                    } elseif (method_exists($this, $rule)) {
                        if ($rule == 'email' || $rule == 'date' ||$rule == 'url')
                            $error_str = 'str_error_notvalid';
                        else
                            $error_str = 'str_error_' . $rule;

                        if (!$this->$rule($value)) {
                            $this->messenger->add(
                                sprintf($this->language->dictionary[$error_str],
                                    $this->language->dictionary['str_' . $fieldname]),
                                Messenger::MESSAGE_ERROR
                            );
                            $errors[$fieldname] = true;
                        }
                    } elseif(preg_match_all('/(eq)\((\w+)\)/', $rule, $matches)) {
                        $second_field_value = $input[$matches[2][0]];
                        if($this->eq($value, $second_field_value) == false) {
                            $this->messenger->add(
                                sprintf($this->language->dictionary['str_error_noteq'],
                                    $this->language->dictionary['str_' . $fieldname]),
                                Messenger::MESSAGE_ERROR
                            );
                            $errors[$fieldname] = true;
                        }
                    } elseif(preg_match_all('/(minlength)\((\d+)\)/', $rule, $matches)) {
                        if($this->minlength($value, $matches[2][0]) == false) {
                            $this->messenger->add(
                                sprintf($this->language->dictionary['str_error_minlentgh'],
                                    $this->language->dictionary['str_' . $fieldname],
                                    $matches[2][0]),
                                Messenger::MESSAGE_ERROR
                            );
                            $errors[$fieldname] = true;
                        }
                    } elseif (preg_match_all('/(maxlength)\((\d+)\)/', $rule, $matches)) {
                        if($this->maxlength($value, $matches[2][0]) == false) {
                            $this->messenger->add(
                                sprintf($this->language->dictionary['str_error_maxlentgh'],
                                    $this->language->dictionary['str_' . $fieldname],
                                    $matches[2][0]),
                                Messenger::MESSAGE_ERROR
                            );
                            $errors[$fieldname] = true;
                        }
                    }
                }

            }
        }

        return empty($errors);
    }

}