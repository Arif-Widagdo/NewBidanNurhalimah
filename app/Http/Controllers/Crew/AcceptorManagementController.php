<?php

namespace App\Http\Controllers\Crew;

use App\Models\Work;
use App\Models\Couple;
use App\Models\Patient;
use App\Models\Acceptor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Graduated;

class AcceptorManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($no_rm)
    {
        $patient =  Patient::where('no_rm', '=', $no_rm)->first();

        $dateOfBirth = $patient->date_brithday;
        $ageInYears = Carbon::parse($dateOfBirth)
            ->diff(Carbon::now())
            ->format('%y ' . __('Years') . ', %m ' . __('Months') . ' ' . __('and') . '  %d ' . __('Days'));



        return view('crew.patient_management.acceptor_management.index', [
            'patient' => $patient,
            'ageInYears' => $ageInYears,
            'acceptors' => Acceptor::where('patient_id', $patient->id)->get(),
            'couples' =>  Couple::where('patient_id', $patient->id)->orderBy('name')->get(),
            'works' => Work::all(),
            'graduateds' => Graduated::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acceptor  $acceptor
     * @return \Illuminate\Http\Response
     */
    public function show(Acceptor $acceptor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acceptor  $acceptor
     * @return \Illuminate\Http\Response
     */
    public function edit(Acceptor $acceptor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acceptor  $acceptor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acceptor $acceptor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acceptor  $acceptor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acceptor $acceptor)
    {
        //
    }
}
