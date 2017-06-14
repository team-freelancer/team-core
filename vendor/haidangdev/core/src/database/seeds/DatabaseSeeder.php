<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_admins')->insert([
            'name' => 'ADMIN',
            'role_id' => 1,
            'email' => 'admin@team.vn',
            'password' => bcrypt('12345678'),
            'active' => 1
        ]);

        DB::table('team_roles')->insertGetId([
            'name' => 'Admin',
            'super_admin' => 1,
            'is_active' => 1
        ]);
    }
}
