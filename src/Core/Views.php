<?php

namespace Digi\Todoapp\Core;

class Views
{
    private $folder;
    private $vars;
    private $page;

    public function __construct($content, $title)
    {
        $this->folder = dirname(__FILE__) . '/../Views/Templates/';
        $this->page = dirname(__FILE__) . '/../Views/' . $content . '.php';
        $this->vars['title'] = $title;
    }

    private function getHead()
    {
        return $this->folder . 'head.php';
    }

    public function setVar($nomvariable, $value)
    {
        $this->vars[$nomvariable] = $value;
    }

    private function getHeader()
    {
        return $this->folder . 'header.php';
    }

    private function getFooter()
    {
        return $this->folder . 'footer.php';
    }

    public function render()
    {
        extract($this->vars);
        ob_start();
        include_once $this->getHead();
        include_once $this->getHeader();
        include_once $this->page;
        include_once $this->getFooter();
        ob_end_flush();
    }
}