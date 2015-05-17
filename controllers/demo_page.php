<?php

class Demo_Page extends Controller {
    function __construct() {
        parent::__construct();
            }

    function index() {
        $this->view->header = $this->xmlData->getData("heading");
        $this->view->paraForHeader = $this->xmlData->getData("paragraph");
        $this->view->render("demo page/index");
    }

    function edit() {
        $this->view->heading = $this->xmlData->getData("heading");
        $this->view->paragraph = $this->xmlData->getData("paragraph");
        $this->view->render("demo page/edit");
    }

    function editIt() {
        $this->xmlData->setData("heading", $_POST['heading']);
        $this->xmlData->setData("paragraph", $_POST['paragraph']);
        header("location:" . URL . "demo_page");
    }
}