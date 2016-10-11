<?php namespace Veebiteenus;


class Application
{
    public $db = null;

    function run()
    {
        $action = $_SERVER["REQUEST_METHOD"];
        $foo = trim($_SERVER["PATH_INFO"], '/');
        $foo = explode('/',$foo);
        $controller = empty($foo)? trigger_error('No endpoint given'):array_shift($foo);
        $parameters = array_shift($foo);
        $controller_name = "Veebiteenus\\controllers\\". $controller;
        if (!class_exists($controller_name)){
            trigger_error("Invalid endpoint", E_USER_ERROR);
        }
        $controller = new $controller_name;
        $controller->$action($parameters);
}
}