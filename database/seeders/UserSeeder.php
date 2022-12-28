<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Ponsiano De Loor',
            'username' => 'ponsiano.deloor',
            'email' => 'ponsianodeloor@gmail.com',
            'password' => Hash::make('ponsiano')
        ]);

        User::factory(99)->create();
    }
}
