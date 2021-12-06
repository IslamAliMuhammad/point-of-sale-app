<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super.admin@admin.com',
            'image' => 'dist\img\user1-128x128.jpg',
            'password' => Hash::make('01143101020'),
        ]);

        $user->assignRole('super-admin');
    }
}
