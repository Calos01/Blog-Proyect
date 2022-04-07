<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //creando solo un usuario administrador
        \App\Models\User::create(['name'=>'Juancito','email'=>'juan@admin.com','password'=>bcrypt('123456')]);
        \App\Models\Post::factory(24)->create();

    }
}
