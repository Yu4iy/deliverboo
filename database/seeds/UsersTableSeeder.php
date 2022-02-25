<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = config('restaurant_data');
		foreach($users as $user){
			$new_user = new User();

			$new_user->name = $user['name'];
			$new_user->email = $user['email']; 
			$new_user->password = Hash::make($user['password']); 
			$new_user->restaurant_name = $user['restaurant_name']; 
			$new_user->address = $user['address']; 
			$new_user->city = $user['city']; 
			$new_user->iva = $user['iva']; 
			$new_user->description = $user['description']; 
			$new_user->image = $user['image']; 
			$new_user->delivery_price = $user['delivery_price']; 
			$new_user->slug = Str::slug($user['name'], '-');
			
			$new_user->save();
			
		}
    }
}
