<?php


namespace App\Actions;

use Faker\Generator;
use Illuminate\Support\Str;
use mysqli;

class CreateDevelopmentDatabase
{
    public function __construct(Generator $faker, $db_name = null)
    {
        $this->faker = $faker;
        $this->db_name = $db_name ?? Str::snake($this->faker->words(2, true));
    }

    public function execute(): int
    {
        if (config('app.env') === 'production') {
            return 1;
        }

        $conn = new mysqli('localhost', 'root', '');

        if ($conn->connect_error) {
            return 1;
        }

        if (!$conn->query('CREATE DATABASE ' . $this->db_name)) {
            return 1;
        }

        $conn->close();
        return 0;
    }
}
