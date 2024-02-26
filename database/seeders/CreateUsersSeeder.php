<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user =[
            [

            'name' => 'Admin',
            'email'=>'admin@admin.com',
            'is_admin'=>'1',
            'password'=> bcrypt('1234'),
            'img_user' => '',
            'position'=> '',
            'branch'=> '',
            'id_name'=> '',
            'donkey_Day'=> '',
            'vacation_Day'=> '',
            'income'=> ''
            ],
             [
            'name' => 'User',
            'email'=>'user@user.com',
            'is_admin'=>'0',
            'password'=> bcrypt('1234'),
            'img_user' => '',
            'position'=> '',
            'branch'=> '',
            'id_name'=> '',
            'donkey_Day'=> '',
            'vacation_Day'=> '',
            'income'=> ''
            ]
        ];

        foreach($user as $key => $value){
            User::create($value);
        }

    }
}
