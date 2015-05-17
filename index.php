<?php

//Use an autoloader!

//configuration
require 'config.php';

//Also spl_autoload_register(Take a look at it if you like)

function __autoload($class) {
    require LIBS . $class . ".php";
}

/*require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/model.php';
require 'libs/view.php';

//Library
require 'libs/database.php';
require 'libs/session.php';
require 'libs/hash.php';*/



$app = new Bootstrap();