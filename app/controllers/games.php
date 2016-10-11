<?php
/**
 * Created by PhpStorm.
 * User: Janre
 * Date: 11.10.2016
 * Time: 15:42
 */

namespace Veebiteenus\controllers;

use Veebiteenus\Controller;

class games extends Controller
{

    function get($parameters)
    {
        $games = $this->db->from("game")->where("name", array("Janre", "dsf"))->fetchAll();

        $this->output($games);

    }

    function post()
    {
        //$_POST['kala']='ahven';
        $result = $this->db->insertInto('game', $_POST)->execute();
        $this->output((array)$result);



    }
}