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

    public function list()
    {

        $events = Event::all();
        // Pass them to the welcome view
        return view('event.event-list', compact('events'));
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
          // Find the event by its ID
        $event = Event::findOrFail($id);
        $categories = Category::all();

        // Pass the event to the edit view
        return view('event.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_enabled' => 'nullable|boolean',
        ]);

        dd($validated);

        // Find the event by its ID
        $event = Event::findOrFail($id);

        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Create a unique filename
            $request->image->move(public_path('images'), $imageName); // Save the image to public/images folder
            $event->image = $imageName; // Update the image path in the event
        }

        // Update the event with validated data
        $event->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'category' => $request->category, // Make sure you're using 'category_id'
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_enabled' => $request->has('is_enabled') ? 1 : 0,
        ]);

        return redirect()->route('event.list')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Find the event by its ID
        $event = Event::findOrFail($id);
        
        // Delete the event
        $event->delete();

        return redirect()->route('event.delete')->with('success', 'Event deleted successfully.');
    }
}
