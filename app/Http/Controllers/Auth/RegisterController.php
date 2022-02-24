<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'restaurant_name' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:50'],
            'iva' => ['required', 'string', 'size:11', 'unique:users'],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png'],
            'description' => ['nullable', 'string'],
            'delivery_price' => ['required', 'numeric', 'min:0'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(array_key_exists('image', $data)) {
            $img_path = Storage::put('restaurant-images', $data['image']);
            $data['image'] = $img_path;
        } else {
            $data['image'] = null;
        }

        if(array_key_exists('description', $data)) {
            $description = $data['description'];
        } else {
            $description = null;
        }

        $slug = Str::slug($data['restaurant_name'], '-');
        $counter = 1;
        $base_slug = $slug;

        //check uniqueness of slug in table users
        while(User::where('slug', $slug)->first()) {
            //gen new slug
            $slug = $base_slug . '-' . $counter;
            $counter++;
        }

        //set new slug
        $data['slug'] = $slug;

        //create new user in table 'users'
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'restaurant_name' =>$data['restaurant_name'],
            'slug' => $data['slug'],
            'address' => $data['address'],
            'city' => $data['city'],
            'iva' => $data['iva'],
            'image' => $data['image'],
            'description' => $description,
            'delivery_price' => $data['delivery_price']
        ]);
    }
}
