<?php

namespace App\Http\Controllers\Crew;

use App\Models\Couple;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoupleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($no_rm)
    {
        $patient =  Patient::where('no_rm', '=', $no_rm)->first();

        return view('crew.couple_management.index', [
            'patient' => $patient,
            'couples' => Couple::where('patient_id', $patient->id)->orderBy('name')->get()
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
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function show(Couple $couple)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function edit(Couple $couple)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Couple $couple)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function destroy(Couple $couple)
    {
        //
    }
}
