<?php

namespace App\Actions;

use mysqli;

class CreateLocalDatabase
{
    private $db_name;

    public function __construct($db_name)
    {
        $this->db_name = $db_name;
    }

    public function execute(): bool
    {
        if (config('app.env') === 'production') {
            return false;
        }

        $conn = new mysqli('localhost', config('database.db_username'), config('database.db_password'));

        if ($conn->connect_error) {
            return false;
        }

        if (!$conn->query('CREATE DATABASE '.$this->db_name)) {
            return false;
        }

        $conn->close();

        return true;
    }
}
