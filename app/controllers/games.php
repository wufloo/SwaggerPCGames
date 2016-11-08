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
       // $games = empty($_GET['name']) ? '' : $_GET['name'];

        // Split pipe separated list of games into array
      //  $games = explode('|', $games);

        // Retrieve requested games from database
       // $games = $this->db->from("game")->where("name", $games)->fetchAll();


        $games = $this->db->from("game")->fetchAll();

        // Output json encoded data
        $this->output($games);


    }

    function post()
    {
        //$_POST['kala']='ahven';
        $json = file_get_contents('php://input');
        $game = json_decode($json, 1);
        $result = $this->db->insertInto('game', $game)->execute();
        $this->output((array)$result);

    }

    function put()
    {

        // Convert json encoded request body into object
        $request = json_decode(file_get_contents('php://input'));


        // Validate releaseDate
        //if(!empty($request->releaseYear) && !valid_date($request->releaseYear)){
         //  output_error(405, "ReleaseYear is not valid");
       //}


        // Define fields allowed for updating
        $allowed_fields = array_flip( [
            'name',
            'releaseYear',
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


    function delete($id)
    {
        if (!$id > 0) {
            output_error(405, "ID is not valid");
        }

        $movie = $this->db->from("game")->where("id", $id)->fetch();
        if (!$movie) {
            output_error(404, "Game not found!");
        }

        $query = $this->db->deleteFrom('game')->where('id', $id);
        $query->execute();
        if ($query === false) {
            output_error(500, "Server error");
        }
        header("HTTP/1.1 204 Ok!");
    }


}