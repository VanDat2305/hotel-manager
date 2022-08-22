<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            [
                'name' => 'Admin',
                'email' => 'adminD@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '0123456789',
                'image'=> '',
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'role_id' => config('custom.user_roles.admin'),
                'status' => config('custom.user_status.active'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            // [
            //     'name' => 'Dat Mv',
            //     'email' => 'datmv@gmail.com',
            //     'password' => Hash::make('12345678'),
            //     'phone' => '0123456788',
            //     'image'=> '',
            //     'email_verified_at' => Carbon::now()->toDateTimeString(),
            //     'role_id' => config('custom.user_roles.manager'),
            //     'status' => config('custom.user_status.block'),
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString(),
            // ],
            ];
        User::insert($data);
        User::factory()->count(10)->create();


    }
}
