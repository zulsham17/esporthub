<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = DB::table('application')
            ->join('application_details', 'application.id', '=', 'application_details.application_id')
            ->join('equipment', 'application_details.equipment_id', '=', 'equipment.id')
            ->select(
                'application.id',
                'application.user_id',
                'application.applicant_name',
                'application.applicant_matric_no',
                'application.applicant_sector',
                'application.purpose',
                'application.date_borrow',
                'application.date_return',
                'application.time_borrow',
                'application.time_return',
                'application.time_duration',
                'application.status',
                'application.created_at',
                DB::raw('GROUP_CONCAT(equipment.name SEPARATOR " , ") as equipment_names')
            )
            ->groupBy(
                'application.id',
                'application.user_id',
                'application.applicant_name',
                'application.applicant_matric_no',
                'application.applicant_sector',
                'application.purpose',
                'application.date_borrow',
                'application.date_return',
                'application.time_borrow',
                'application.time_return',
                'application.time_duration',
                'application.status',
                'application.created_at'
            )
            ->orderByDesc('application.created_at')
            ->get();

        return view('admin.application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        DB::table('application')->where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
