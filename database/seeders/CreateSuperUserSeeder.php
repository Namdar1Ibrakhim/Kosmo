<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


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
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => 'super-user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
//        $permission = Permission::create(['name' => 'edit articles']);

        $superUser->assignRole('super-user');
    }
}
