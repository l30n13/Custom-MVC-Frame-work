<?php

class Form {
    private $_postData = array();

    function __construct() {

    }

    function post($field) {
        $this->_postData[$field] = $_POST[$field];
    }

    function validator() {

    }
}