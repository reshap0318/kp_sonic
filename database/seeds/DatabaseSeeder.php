<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(satkerSeeder::class);
        $this->call(pangkatSeeder::class);
        $this->call(jabatanSeeder::class);
        $this->call(UserSeeder::class);
    }
}
