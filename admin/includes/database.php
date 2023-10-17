<?php

require_once("new_config.php");

class Database
{

    public $connection;

    function __construct()
    {

        $this->open_db_connection();
    }


    public function open_db_connection()
    {

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); // vytvoření objektu

        if ($this->connection->connect_errno) { // connect errorno je builded v PHP
            die("Database connection failed" . $this->connection->connect_error); // connect error je build v PHP
        }
    }

    public function query($sql)
    {

        $result = $this->connection->query($sql);

        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result)
    {


        if (!$result) {

            die("Query Failed" . $this->connection->error);
        }
    }

    public function escape_string($string)
    {

        $escapedString = $this->connection->real_escape_string($string);
        return $escapedString;
    }




    public function the_insert_id()
    {

        return $this->connection->insert_id;
    }
}

$database = new Database();
