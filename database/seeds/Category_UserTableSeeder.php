<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pivot_relations = config('pivot_category_user');

        foreach($pivot_relations as $relation) {
            DB::table('category_user')->insert([
                'user_id' => $relation['user_id'],
                'category_id' => $relation['category_id'],
            ]);
        }
    }
}
