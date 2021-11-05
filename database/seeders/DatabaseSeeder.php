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
            'cr_id' => 504010984,
            'name' => 'Eddy Alfaro',
            'email' => 'ealfarov02@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 1,
            'status' => 1,
        ]);

        if (env('app.env') != 'production') {
            User::factory(100)->create();
        }
        
    }
}
