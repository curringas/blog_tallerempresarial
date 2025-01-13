<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'administrador@example.com';
        $user->password = bcrypt('1234');
        $user->profile = 'administrator';
        
        $user->save();

        $user = new User();
        $user->name = 'Usuario';
        $user->email = 'usuario@example.com';
        $user->password = bcrypt('1234');
        $user->profile = 'user';
        
        $user->save();

        //User::factory(10)->create();
    }
}
