<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::where('user_id', Auth::id())->get();

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate($this->validation_rules());
        $data = $request->all();
        $data['user_id']= Auth::id();
        
        //store image
        if(array_key_exists('image', $data)) {
            $img_path= Storage::put('dishes-images', $data['image']);
            $data['image'] = $img_path;
        }

         //new instance of Dish
        $new_dish = new Dish();

        // Generazione slug
        $slug = Str::slug($data['name'], '-');
        $counter = 1;
        $base_slug = $slug;

        //check uniqueness of slug
        while(Dish::where('slug', $slug)->first()) {
            //gen new slug
            $slug = $base_slug . '-' . $counter;
            $counter++;
        }
         //set new slug
			$data['slug'] = $slug;

        //fill columns
        $new_dish->fill($data);

        //save new dish
        $new_dish->save();

        //redirect to archive page
        return redirect()->route('admin.dishes.index')->with('message',"Piatto creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        if(! $dish) {
            abort(404);
        }
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)

    {
    
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //validation
        $request->validate($this->validation_rules());

        $data = $request->all();

        if(array_key_exists('image', $data)) {
            //remove previous image if exists
            if($dish->image) {
                Storage::delete($dish->image);
            } 
            //set new image
            $data['image'] = Storage::put('dishes-images', $data['image']);
        }

        //update slug if title is changed
        if($data['name'] != $dish->name) {
            $slug = Str::slug($data['name'], '-');
            $counter = 1;
            $base_slug = $slug;

            //check uniqueness of slug
            while(Dish::where('slug', $slug)->first()) {
                //gen new slug
                $slug = $base_slug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        } 

        else {
            $data['slug'] = $dish->slug;
        }

        //udpdate dish
        $dish->update($data);

        //redirect to details page
        return redirect()->route('admin.dishes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //add dish to trash from the menu
        $dish->delete();

        //redirect to menu page
        return redirect()->route('admin.dishes.index')->with('deleted', $dish->name);
    }

    public function getTrash()
    {
        //get trashed dishes
        $trashed = Dish::where('user_id', Auth::id())->onlyTrashed()->get();

        //return admin/dishes/trash.blade
        return view('admin.dishes.trash', compact('trashed'));
    }

    public function restore($id)
    {
        //get all dishes from table (also with trashed dishes)
        Dish::withTrashed()->find($id)->restore();

        //redirect to the menu
        return redirect()->route('admin.dishes.index');
    }    

    public function forceDelete($id) {
        //catch the dish to permanently delete
        $dish = Dish::withTrashed()->find($id);

        //delete image file
        Storage::delete($dish->image);

        //delete dish PERMANENTLY
        $dish->forceDelete();

        return redirect()->route('admin.dishes.index');
    }

    private function validation_rules() {
        return [
            'name' => 'required|string|max:50',
            'ingredients' =>'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|regex:/^[0-9]?[0-9]+[.]+[0-9]+[0-9]+$/',
            'image' => 'nullable|file|mimes:jpeg, jpg, png',
            'is_visible' => 'required|boolean'
        ];
    }

    /**
     * SOFT DELETES
     */
    use SoftDeletes;
}