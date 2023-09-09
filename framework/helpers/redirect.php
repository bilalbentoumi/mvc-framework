<?php

namespace mvc\framework\helpers;

trait Redirect {
    public function redirect($path) {
        session_write_close();
        header('Location: ' . $path);
        exit;
    }
}