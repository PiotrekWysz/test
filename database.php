<?php

class Database
{
    private $baza = array(
		'host' => 'localhost',
		'user' => 'piotrek',
		'pass' => 'haselko',
		'base' => 'test',
    );

    private $conn = null;
    private static $instance;

    private function __construct()
    {
        $this->conn = @new mysqli($this->baza['host'],$this->baza['user'],$this->baza['pass'],$this->baza['base']);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getArray($query)
    {
        $result = $this->excecute($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getRow($query, $number_row)
    {
        $result = $this->excecute($query);

        if ($result->num_rows > $number_row) {
            return $result->fetch_all() [$number_row];
        } else {
            return array();
        }
    }

    public function excecute($sql)
    {
        return $this->conn->query($sql);
    }

    public function insert_id()
    {
        return $this->conn->insert_id;
    }

    private function __clone()
    {
        //nie można klonować obiektu
    }

}