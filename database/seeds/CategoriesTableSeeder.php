<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'name' => "comic",
            ],
            [
                'username' => "girl",
            ],
            [
                'name' => "football",
            ],
            [
                'username' => "cat",
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
