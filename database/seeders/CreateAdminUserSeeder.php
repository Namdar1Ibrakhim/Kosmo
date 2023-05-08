<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => Hash::make('1234567890')
        
        ]);
        Role::create([
            'name' => 'super-user'
        ]);
        $superUser->assignRole('super-user');

    }
}
