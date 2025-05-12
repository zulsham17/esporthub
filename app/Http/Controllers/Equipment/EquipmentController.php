<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = DB::table('equipment')
            ->select(
                'type',
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN status = 'Rosak' THEN 1 ELSE 0 END) as rosak"),
                DB::raw("SUM(CASE WHEN status = 'Sudah Dibaiki' THEN 1 ELSE 0 END) as sudah_dibaiki"),
                DB::raw("SUM(CASE WHEN status = 'Belum Dibaiki' THEN 1 ELSE 0 END) as belum_dibaiki"),
                DB::raw("SUM(CASE WHEN status = 'Hilang' THEN 1 ELSE 0 END) as hilang"),
                DB::raw("SUM(CASE WHEN status = 'Sudah Diganti' THEN 1 ELSE 0 END) as sudah_diganti"),
                DB::raw("SUM(CASE WHEN status = 'Belum Diganti' THEN 1 ELSE 0 END) as belum_diganti")
            )
            ->groupBy('type')
            ->get();

        return view('equipment.index', compact('equipment'));
    }

    
    public function create()
    {
        return view("equipment.create");
    }


    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Insert into the database using DB facade
        DB::table('equipment')->insert([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'created_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->route('equipment.index')->with('success', 'Peralatan berjaya ditambah.');
    }

    public function update(Request $request)
    {

        DB::table('equipment')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status,
                'description' => $request->description,
            ]);

        return redirect()->back()->with('success', 'Peralatan berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('equipment')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Peralatan berjaya dipadam.');
    }

    public function viewByType($type)
    {

        $items = DB::table('equipment')->where('type', $type)->get();

        return view('equipment.show-by-type', compact('items', 'type'));
    }

    public function getByType($type)
    {
        
        $decodedType = urldecode($type);
        $items = DB::table('equipment')
            ->where('type', $decodedType)
            ->where('status', 'Tersedia')
            ->get();

        return response()->json($items);
    }
}
