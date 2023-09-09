<?php

namespace mvc\app\controllers;

use mvc\framework\core\Controller;

class SettingsController extends Controller {

    private $validationRules = [
        'site_name'                     => 'required|alphanum|minlength(3)|maxlength(20)',
        'site_email'                    => 'required|email'
    ];

    public function defaultAction() {

        $dir = new \DirectoryIterator(LANGUAGES_PATH);
        $langs = [];
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $langs[] = $fileinfo->getFilename();
            }
        }

        $this->template->set('languages', $langs);

        if (isset($_POST['submit']) && $this->validator->isValid($this->validationRules, $_POST)) {

            $this->set('SITE_NAME', $_POST['site_name']);
            $this->set('SITE_EMAIL', $_POST['site_email']);
            $this->set('DEFAULT_LANGUAGE', $_POST['site_language']);

            header('Location: ' . BASE_URL);
        }

        $this->initView();
    }

    public function set($delimiter, $value) {
        $contents = file_get_contents( CONFIGS_PATH . 'config.php');
        $value = "define('$delimiter', '$value');";
        $contents = preg_replace("/define\(\s*'" . $delimiter . "'\s*,\s*'(.+)'\s*\);/", $value, $contents);
        $file_handle = fopen(CONFIGS_PATH . 'config.php', 'w');
        fwrite($file_handle, $contents);
        fclose($file_handle);
    }

}