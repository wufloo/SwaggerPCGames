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
        // Ensure that name exists
        $games = empty($_GET['name']) ? '' : $_GET['name'];

        // Split pipe separated list of games into array
        $games = explode('|', $games);

        // Retrieve requested games from database
        $games = $this->db->from("game")->where("name", $games)->fetchAll();

        // Output json encoded data
        $this->output($games);


    }

    function post()
    {
        //$_POST['kala']='ahven';
        $result = $this->db->insertInto('game', $_POST)->execute();
        $this->output((array)$result);

    }

    function put()
    {
        // Convert json encoded request body into object
        $request = json_decode(file_get_contents('php://input'));

        // Convert object to array
        // Todo refaktoori j2rgnev kood funktsiooniks mis v6rdleb requestis olevaid v2ljanimesid andmebaasis olevate v2ljanimedega ja tagastab ainult yhised
        $set = [
            'name' => $request->name,
            'releaseDate' => $request->releaseDate,
            'description' => $request->description,
            'genre' => $request->genre,
            'characters' => $request->characters
        ];

        // Update database
        $query = $this->db->update('game')->set($set)->where('id', $request->id)->execute();



        $this->output((array)$query);
    }


    function delete()
    {
        $query = $this->db->deleteFrom('game')->where('id', 4);
        $query->execute();
        $this->output((array)$query);
    }


}