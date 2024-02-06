<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function list()
    {
        $Cars = Car::all();
        return view('admin.car.list', compact('Cars'));
    }

    public function add()
    {
        $Categories = Category::where('active', 1)->get();
        return view('admin.car.add', compact('Categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'   => ['required', 'exists:categories,id'],
            'title'         => ['required'],
            'content'       => ['required'],
            'luggage'       => ['required'],
            'doors'         => ['required'],
            'passengers'    => ['required'],
            'price'         => ['required'],
            'image'         => ['required'],
        ]);

        $Car = new Car();
        $Car->category_id   = $request->category_id;
        $Car->title         = $request->title;
        $Car->content       = $request->content;
        $Car->luggage       = $request->luggage;
        $Car->doors         = $request->doors;
        $Car->passengers    = $request->passengers;
        $Car->price         = $request->price;
        $Car->active        = ($request->active) ? 1 : 0;
        $Car->save();

        $Image  = $request->image;
        $Name   = $Car->id . '_' . rand(10, 99) . '.' . $Image->getClientOriginalExtension();
        $Path   = 'images/car';
        Storage::putFileAs($Path, $Image, $Name);
        $Car->image  = $Name;
        $Car->save();

        return redirect()->route('admin.car.list');
    }

    public function edit(Car $Car)
    {
        $Categories = Category::where('active', 1)->get();
        return view('admin.car.edit', compact('Car', 'Categories'));
    }

    public function update(Request $request, Car $Car)
    {
        $request->validate([
            'category_id'   => ['required', 'exists:categories,id'],
            'title'         => ['required'],
            'content'       => ['required'],
            'luggage'       => ['required'],
            'doors'         => ['required'],
            'passengers'    => ['required'],
            'price'         => ['required'],
        ]);

        $Car->category_id   = $request->category_id;
        $Car->title         = $request->title;
        $Car->content       = $request->content;
        $Car->luggage       = $request->luggage;
        $Car->doors         = $request->doors;
        $Car->passengers    = $request->passengers;
        $Car->price         = $request->price;
        $Car->active        = ($request->active) ? 1 : 0;
        if ($request->image) {
            $Image  = $request->image;
            $Name   = $Car->id . '_' . rand(10, 99) . '.' . $Image->getClientOriginalExtension();
            $Path   = 'images/car';
            if ($Car->image != '0.png') {
                Storage::delete($Path . '/' . $Car->image);
            }
            Storage::putFileAs($Path, $Image, $Name);
            $Car->image = $Name;
        }
        $Car->save();

        return redirect()->route('admin.car.list');
    }

    public function active(Car $Car)
    {
        $Car->active = !$Car->active;
        $Car->save();

        return redirect()->route('admin.car.list');
    }
}
