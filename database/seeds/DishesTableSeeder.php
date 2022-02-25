<?php

use App\Dish;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	 public function run()
    {
      $dishes = config('dishes_data');
		foreach($dishes as $dish){
			$new_dish = new Dish();

			$new_dish->name = $dish['name'];
			$new_dish->ingredients = $dish['ingredients']; 
			$new_dish->description = $dish['description']; 
			$new_dish->price = $dish['price']; 
			$new_dish->image = $dish['image']; 
			$new_dish->is_visible = $dish['is_visible']; 
			$new_dish->user_id = $dish['user_id']; 
			$new_dish->slug = Str::slug($dish['name'], '-');
			
			$new_dish->save();
			
		}
    }
}
