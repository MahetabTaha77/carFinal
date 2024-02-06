<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Message;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function Index()
    {
        $Cars = Car::where('active', 1)->take(6)->get();
        $Testimonials = Testimonial::where('active', 1)->where('published', 1)->take(3)->get();
        return view('index', compact('Cars', 'Testimonials'));
    }

    public function About()
    {
        return view('about');
    }

    public function Listing()
    {
        $Cars = Car::where('active', 1)->get();
        return view('listing', compact('Cars'));
    }

    public function Contact()
    {
        return view('contact');
    }

    public function ContactSubmit(Request $request)
    {
        $request->validate([
            'first_name'    => ['required'],
            'last_name'     => ['required'],
            'email'         => ['required'],
            'message'       => ['required'],
        ]);

        $Message = new Message();
        $Message->first_name = $request->first_name;
        $Message->last_name = $request->last_name;
        $Message->email = $request->email;
        $Message->message = $request->message;
        $Message->save();

        return redirect()->route('contact');
    }

    public function Blog()
    {
        return view('blog');
    }

    public function Testimonial()
    {
        $Testimonials = Testimonial::where('active', 1)->where('published', 1)->get();
        return view('testimonial', compact('Testimonials'));
    }
}
