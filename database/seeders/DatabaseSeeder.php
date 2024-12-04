<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PenggunaSeeder; // Make sure this import is correct

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the PenggunaSeeder to insert data into the table
        $this->call(PenggunaSeeder::class);
    }
}
