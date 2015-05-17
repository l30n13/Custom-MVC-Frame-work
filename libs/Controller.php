<?php

class Controller {
    function __construct() {
        //echo "main contrller<br>";

        $this->view = new View();

    }

    function loadModel($pageName) {
        $model_path = 'models/' . $pageName . '_model.php';
        if (file_exists($model_path)) {
            require 'models/' . $pageName . '_model.php';
            $modelName = $pageName . '_Model';
            $this->model = new $modelName();
        }
        $xml_path = 'local_database/' . $pageName . '.xml';
        if (file_exists($xml_path)) {
            $this->xmlData = new Local_Database($pageName, "local_database");
        }
    }
}