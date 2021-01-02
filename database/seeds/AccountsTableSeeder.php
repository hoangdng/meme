<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
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
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'username' => "user",
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];
        DB::table('accounts')->insert($data);
    }
}
