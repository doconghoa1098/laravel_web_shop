<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
           'name' => 'Đỗ Công Hòa',
           'email' => 'doconghoa1098@gmail.com',
           'phone' => '0988596440',
           'address' => 'Nam Định',
           'password' =>bcrypt('123')
        ]);
    }
}
