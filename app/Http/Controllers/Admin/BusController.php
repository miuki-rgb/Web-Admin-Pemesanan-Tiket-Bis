<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::latest()->paginate(10);
        return view('admin.buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:buses,plate_number',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,maintenance',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('buses', 'public');
            $data['photo'] = $path;
        }

        Bus::create($data);

        return redirect()->route('admin.buses.index')
            ->with('success', 'Bus created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return view('admin.buses.show', compact('bus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
        return view('admin.buses.edit', compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:buses,plate_number,' . $bus->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,maintenance',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($bus->photo) {
                Storage::disk('public')->delete($bus->photo);
            }
            $path = $request->file('photo')->store('buses', 'public');
            $data['photo'] = $path;
        }

        $bus->update($data);

        return redirect()->route('admin.buses.index')
            ->with('success', 'Bus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        if ($bus->photo) {
            Storage::disk('public')->delete($bus->photo);
        }
        
        $bus->delete();

        return redirect()->route('admin.buses.index')
            ->with('success', 'Bus deleted successfully.');
    }
}
