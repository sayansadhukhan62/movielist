<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        Role::truncate();
		DB::table('roles')->insert([
            ['name'=>'admin'],
            ['name'=>'user'],
        ]);
    }
}