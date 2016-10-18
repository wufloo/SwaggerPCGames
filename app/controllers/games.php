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


        // Validate releaseDate
        if (!empty($request->releaseDate) && !valid_date($request->releaseDate)) {
            output_error(405, "ReleaseDate is not valid");
        }


        // Define fields allowed for updating
        $allowed_fields = array_flip([
            'name',
            'releaseDate',
            'description',
            'genre',
            'characters'
        ]);


        // Filter request fields
        $data = array_intersect_key((array)$request, $allowed_fields);


        // Update database
        $query = $this->db->update('game')->set($data)->where('id', $request->id)->execute();


        // Verify that query succeeded
        if ($query === false) {
            output_error(500, "Server error");
        }

        exit();
    }


    function delete()
    {
        $query = $this->db->deleteFrom('game')->where('id', 4);
        $query->execute();
        $this->output((array)$query);
    }


}