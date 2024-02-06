<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function list()
    {
        $Testimonials = Testimonial::where('active', 1)->get();
        return view('admin.testimonial.list', compact('Testimonials'));
    }

    public function add()
    {
        return view('admin.testimonial.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required'],
            'position'      => ['required'],
            'content'       => ['required'],
            'image'         => ['required'],
        ]);

        $Testimonial = new Testimonial();
        $Testimonial->name      = $request->name;
        $Testimonial->position  = $request->position;
        $Testimonial->content   = $request->content;
        $Testimonial->published = ($request->published) ? 1 : 0;
        $Testimonial->save();

        $Image  = $request->image;
        $Name   = $Testimonial->id . '_' . rand(10, 99) . '.' . $Image->getClientOriginalExtension();
        $Path   = 'images/testimonial';
        Storage::putFileAs($Path, $Image, $Name);
        $Testimonial->image  = $Name;
        $Testimonial->save();

        return redirect()->route('admin.testimonial.list');
    }

    public function edit(Testimonial $Testimonial)
    {
        return view('admin.testimonial.edit', compact('Testimonial'));
    }

    public function update(Request $request, Testimonial $Testimonial)
    {
        $request->validate([
            'name'          => ['required'],
            'position'      => ['required'],
            'content'       => ['required'],
        ]);

        $Testimonial->name      = $request->name;
        $Testimonial->position  = $request->position;
        $Testimonial->content   = $request->content;
        $Testimonial->published = ($request->published) ? 1 : 0;
        if ($request->image) {
            $Image  = $request->image;
            $Name   = $Testimonial->id . '_' . rand(10, 99) . '.' . $Image->getClientOriginalExtension();
            $Path   = 'images/testimonial';
            if ($Testimonial->image != '0.png') {
                Storage::delete($Path . '/' . $Testimonial->image);
            }
            Storage::putFileAs($Path, $Image, $Name);
            $Testimonial->image = $Name;
        }
        $Testimonial->save();

        return redirect()->route('admin.testimonial.list');
    }

    public function active(Testimonial $Testimonial)
    {
        $Testimonial->active = !$Testimonial->active;
        $Testimonial->save();

        return redirect()->route('admin.testimonial.list');
    }
}
