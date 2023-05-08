<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;


class CreateSuperUserSeeder extends Seeder
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
            'name' => 'admin'
        ]);
        $permission = Permission::create(['name' => 'edit articles']);

        $superUser->assignRole('super-user');
    }
}
