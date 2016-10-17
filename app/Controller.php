<?php
/**
 * Created by PhpStorm.
 * User: Janre
 * Date: 11.10.2016
 * Time: 15:35
 */

namespace Veebiteenus;
use FluentPDO;

class Controller
{
    public $db;
    function __construct()
    {
        $pdo = new \PDO('mysql:host=' . DATABASE_HOSTNAME . ';dbname=' . DATABASE_DATABASE, DATABASE_USERNAME,
            DATABASE_PASSWORD);//v'ljakutsumine
        $this->db = new FluentPDO($pdo);
        $this->pdo = $pdo;

    }
    function get_colum_names(){
        $q = $this->pdo->prepare("DESCRIBE tablename");
        $q->execute();
        $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
        var_dump($table_fields);
    }
    function output(Array $data){
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}