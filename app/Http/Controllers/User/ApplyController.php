<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplyController extends Controller
{
    public function index(){

        $applications = DB::table('application')
            ->join('application_details', 'application.id', '=', 'application_details.application_id')
            ->join('equipment', 'application_details.equipment_id', '=', 'equipment.id')
            ->select(
                'application.id',
                'application.applicant_name',
                'application.date_borrow',
                'application.time_borrow',
            'application.time_return',
                'application.status',
                DB::raw('GROUP_CONCAT(equipment.name SEPARATOR " , ") as equipment_names')
            )
            ->where('application.user_id', auth()->user()->id)
            ->groupBy('application.id', 'application.applicant_name', 'application.date_borrow', 'application.time_duration', 'application.status')
            ->orderByDesc('application.created_at')
            ->get();

        return view('user.application.index', compact('applications'));
    }

    public function create()
    {
        $types = DB::table('equipment')->select('type')->distinct()->get();

        return view('user.application.create', compact('types'));
    }

    public function store(Request $request){
        
        
        $request->validate([
            'applicant_name' => 'required',
            'applicant_matric_no' => 'required',
            'applicant_sector' => 'required',
            'date_borrow' => 'required|date',
            'date_return' => 'required|date',
            'time_borrow' => 'required',
            'time_return' => 'required',
            'equipment_id' => 'required|array',
            'equipment_id.*' => 'exists:equipment,id',
        ]);

        DB::transaction(function () use ($request) {

            $timeBorrow = Carbon::createFromFormat('H:i', $request->time_borrow);
            $timeReturn = Carbon::createFromFormat('H:i', $request->time_return);
            $durationInMinutes = $timeReturn->diffInMinutes($timeBorrow);
            $hours = floor($durationInMinutes / 60);
            $minutes = $durationInMinutes % 60;
            $timeDuration = sprintf('%02d:%02d', $hours, $minutes);

            $applicationId = DB::table('application')->insertGetId([
                'user_id' => auth()->id(),
                'applicant_name' => $request->applicant_name,
                'applicant_matric_no' => $request->applicant_matric_no,
                'applicant_sector' => $request->applicant_sector,
                'purpose' => $request->purpose ?? null,
                'date_borrow' => $request->date_borrow,
                'date_return' => $request->date_return,
                'time_borrow' => $request->time_borrow,
                'time_return' => $request->time_return,
                'time_duration' => $timeDuration,
                'status' => 'Diproses',
                'created_at' => now(),
            
            ]);

            foreach ($request->equipment_id as $equipmentId) { 

                DB::table('application_details')->insert([
                    'application_id' => $applicationId,
                    'equipment_id' => $equipmentId,
                
                ]);

                DB::table('equipment')->where('id',$equipmentId)
                ->update(['status' => 'Ditempah']);
            }
        });

        return redirect()->route('application.index')->with('success', 'Permohonan berjaya dihantar.');
    }

    
}
