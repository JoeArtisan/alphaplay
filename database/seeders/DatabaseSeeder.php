<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cr_id' => 500000000,
            'name' => 'Administrador',
            'email' => 'admin@alphaplay.com',
            'password' => Hash::make('123adm456*'),
            'role' => 1,
            'status' => 1,
        ]);

        if (env('app.env') != 'production') {
            User::factory(100)->create();
        }
        
    }
}
