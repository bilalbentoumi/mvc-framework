<?php

namespace mvc\framework\libs;

class Template {

    public $file;
    public $data;

    public function __construct($file) {
        $this->file = $file;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function tpl_vardump($content) {
        $content = preg_replace('/@var_dump\s*\(\s*(.+)\s*\)/', "<? var_dump($1) ?>", $content);
        return $content;
    }

    public function tpl_componenets($content) {
        preg_match_all('/@component\s*\(\s*(\w+)\s*\)/', $content, $matches);
        $codes = $matches[0];
        $files = $matches[1];
        for ($i = 0; $i < sizeof($codes); $i++) {
            $content = str_replace($codes[$i], $this->output(COMPONENTS_PATH . $files[$i] . '.tpl'), $content);
        }
        return $content;
    }

    public function tpl_isEqual($content) {
        $content = preg_replace('/@isEqual\s*\(\s*(.+?)\s*,\s*(.+?)\s*\)/', "<? if($1 == $2): ?>", $content);
        $content = preg_replace('/@endIsEqual/', "<? endif; ?>", $content);
        return $content;
    }

    public function tpl_if($content) {
        $content = preg_replace('/@if\s*\(\s*(.+?)\s*\)/', "<?php if ($1): ?>", $content);
        $content = preg_replace('/@elseif\s*\(\s*(.+)\s*\)/', "<?php elseif($1): ?>", $content);
        $content = preg_replace('/@else/', "<?php else: ?>", $content);
        $content = preg_replace('/@endif/', "<?php endif; ?>", $content);
        return $content;
    }

    public function tpl_lang($content) {
        $content = preg_replace('/@lang\s*\(\s*(.+?)\s*\)/', "<?= \$str_$1 ?>", $content);
        return $content;
    }

    public function tpl_forElse($content) {
        $content = preg_replace('/@forelse\s*\(\s*(.+)\s*as\s*(.+)\s*\)/', "<?php if (!empty($1)): foreach ($1 as $2): ?>", $content);
        $content = preg_replace('/@empty/', "<?php endforeach; else: ?>", $content);
        $content = preg_replace('/@endforelse/', "<?php endif; ?>", $content);
        return $content;
    }

    public function tpl_print($content) {
        $content = preg_replace('/@{(.+?)}/', "<?= $1 ?>", $content);
        return $content;
    }

    public function tpl_session($content) {
        $content = preg_replace('/@clearsession\((.+)\)/', "<?php unset(\$_SESSION['$1']) ?>", $content);
        $content = preg_replace('/@printsession\((.+)\)/', "<?php echo \$_SESSION['$1'] ?>", $content);
        $content = preg_replace('/@sessionisset\((.+)\)/', "<?php if(isset(\$_SESSION['$1'])): ?>", $content);
        $content = preg_replace('/@endsessionisset/', "<?php endif; ?>", $content);
        return $content;
    }

    public function exec($content) {
        extract($this->data);

        ob_start();
        eval("?>$content");
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function output($file) {
        $output = file_get_contents($file);

        extract($this->data);

        $tpl_methods = get_class_methods($this);
        foreach ($tpl_methods as $method) {
            if (strpos($method, 'tpl') !== false) {
                $output = $this->{$method}($output);
            }
        }

        return $this->exec($output);
    }

    public function render() {
        echo $this->output($this->file);
    }

}