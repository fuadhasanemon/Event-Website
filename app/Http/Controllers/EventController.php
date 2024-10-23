<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use View;

class EventController extends Controller
{

    public function home()
    {
        // Fetch featured events
        $featuredEvents = Event::where('is_featured', true)->get();

        // Pass them to the welcome view
        return view('welcome', compact('featuredEvents'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('event.create');
          // Fetch all categories from the database
            $categories = Category::all();

            // Pass categories to the view
            return view('event.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // dd($request->all());

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Create a unique filename
            $request->image->move(public_path('images'), $imageName); // Save the image to public/images folder
        }


        Event::create([

            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $imageName,
            'category' => $request->category_id,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_enabled' => $request->has('is_enabled') ? 1 : 0,    

        ]);

        return redirect()->route('event.index')->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
