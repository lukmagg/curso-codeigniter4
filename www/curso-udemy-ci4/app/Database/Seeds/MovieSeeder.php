<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MovieSeeder extends Seeder
{
        public function run()
        {
                $data = [
                        'title' => 'movie 1',
                        'description'    => 'Database seeding is a simple way to add data into your database. It is especially useful during development where you need to populate the database with sample data that you can develop against, but it is not limited to that. Seeds can contain static data that you don’t want to include in a migration, like countries, or geo-coding tables, event or setting information, and more.'
                ];

                // Simple Queries
                // $this->db->query("INSERT INTO movies (title, description) VALUES(:title:, :description:)", $data);

                // Using Query Builder
                $this->db->table('movies')->insert($data);
        }
}