<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = DB::table('roles')->where('name', '=', 'Администратор')->first();
        if (!$adminRole) { 
            DB::table('roles')->insert(['name'=>'Администратор']);
        }
        $adminRole = DB::table('roles')->where('name', '=', 'Гость')->first();
        if (!$adminRole) { 
            DB::table('roles')->insert(['name'=>'Гость']);
        }
    }
}
