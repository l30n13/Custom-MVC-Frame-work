<?php

class Pages {
    protected $pages = array();
    protected $images = array();

    function __construct() {
        $controller = array_diff(scandir("controllers/"), array(".", "..", "dashboard.php", "error.php"));
        arsort($controller);
        //$controllers = array();
        foreach ($controller as $page) {
            array_push($this->pages, trim($page, ".php"));
        }
//        echo "<pre>";
//        print_r($this->pages);
//        echo "</pre>";
//        die;
    }

    public function getImages($pageName) {
        $this->imageLocation = 'views/' . $pageName . '/image';
        $this->images = array_diff(scandir($this->imageLocation), array(".", ".."));
        echo "<pre>";
        print_r($this->images);
        foreach ($this->images as $image) {
            echo '<img src="' . $this->imageLocation . '/' . $image . '" width="200" height="200" />';
        }
        echo "</pre>";
        die;
    }

}