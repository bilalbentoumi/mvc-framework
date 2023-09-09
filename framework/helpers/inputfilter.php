<?php
namespace mvc\framework\helpers;

trait InputFilter {

    public function filterUnsignedInt($input) {
        return $this->filterInt($input) > 0 ? $this->filterInt($input) : 0;
    }

    public function filterInt($input) {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterFloat($input) {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public function filterString($input) {
        return htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }

    public function filterBoolean($input) {
        return filter_var($input, FILTER_VALIDATE_BOOLEAN);
    }

}