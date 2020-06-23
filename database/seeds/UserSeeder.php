<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        User::truncate();
        DB::table('users')->insert([
            ['name'=>'Admin','email'=>'admin@gmail.com','password'=>bcrypt('12345678'),'role_id'=>'1'],
        ]);
    }
}
