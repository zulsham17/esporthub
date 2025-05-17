<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $equipment = DB::table('equipment_master')->orderBy('created_at', 'desc')->get();

        return view('admin.settings.equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle file upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('equipment_images', 'public'); // stores in storage/app/public/equipment_images
        }

        // Insert into DB using DB facade
        DB::table('equipment_master')->insert([
            'type_name' => $request->name,
            'image' => $imagePath, 
            'created_at' => now(),
        ]);

        return redirect()->route('settings-equipment.index')->with('success', 'Peralatan berjaya ditambah.');
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
