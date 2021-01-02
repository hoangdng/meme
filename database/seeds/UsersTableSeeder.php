<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'username' => "admin",
                'status' => 'ACTIVE',
                'role' => 'ROLE_ADMIN',
            ],
            [
                'username' => "user",
                'status' => 'ACTIVE',
                'role' => 'ROLE_MEMBER',
            ],
        ];
        DB::table('users')->insert($data);
    }
}
