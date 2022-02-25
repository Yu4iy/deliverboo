<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = config('categories');
		foreach($categories as $category){
			$new_category = new Category();

			$new_category->name = $category['name'];
			$new_category->image = $category['image']; 
			$new_category->slug = Str::slug($category['name'], '-');
			
			$new_category->save();
			
		}
    }
}
