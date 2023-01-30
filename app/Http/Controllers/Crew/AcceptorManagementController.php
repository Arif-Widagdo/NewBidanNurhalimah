<?php

namespace App\Http\Controllers\Crew;

use App\Models\Work;
use Ramsey\Uuid\Uuid;
use App\Models\Couple;
use App\Models\Patient;
use App\Models\Acceptor;
use App\Models\Graduated;
use App\Models\BirthControl;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
            'acceptors' => Acceptor::where('patient_id', $patient->id)->orderBy('attendance_date', 'ASC')->get(),
            'couples' =>  Couple::where('patient_id', $patient->id)->orderBy('name')->get(),
            'works' => Work::all(),
            'graduateds' => Graduated::all(),
            'birthControls' => BirthControl::orderBy('name')->get(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_date' => ['required'],
            'weight' => ['required'],
            'blood_pressure' => ['required'],
            'birth_control_id' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $attendance_date = Carbon::createFromFormat('d-m-Y', $request->attendance_date);

            $menstrual_date = null;
            if ($request->menstrual_date) {
                $menstrual_date = Carbon::createFromFormat('d-m-Y', $request->menstrual_date);
            }

            $return_date = null;
            if ($request->return_date) {
                $return_date = Carbon::createFromFormat('d-m-Y', $request->return_date);

                if ($return_date <= $attendance_date) {
                    return response()->json(['status' => 'notAccept', 'msg' => __('Return Visit Date must be after the current date')]);
                }
            }

            $store = Acceptor::create([
                'id' => Uuid::uuid4()->toString(),
                'patient_id' => $request->patient_id,
                'attendance_date' =>  $attendance_date,
                'menstrual_date' => $menstrual_date,
                'weight' => $request->weight,
                'blood_pressure' => $request->blood_pressure,
                'complication' => $request->complication,
                'failure' => $request->failure,
                'birth_control_id' => $request->birth_control_id,
                'return_date' => $return_date,
                'description' => $request->description
            ]);

            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Data Failed to Add')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Data Added Successfully')]);
            }
        }
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
        $validator = Validator::make($request->all(), [
            'attendance_date_edit' => ['required'],
            'weight_edit' => ['required'],
            'blood_pressure_edit' => ['required'],
            'birth_control_id_edit' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $attendance_date = Carbon::createFromFormat('d-m-Y', $request->attendance_date_edit);

            $menstrual_date = null;
            if ($request->menstrual_date_edit) {
                $menstrual_date = Carbon::createFromFormat('d-m-Y', $request->menstrual_date_edit);
            }

            $return_date = null;
            if ($request->return_date_edit) {
                $return_date = Carbon::createFromFormat('d-m-Y', $request->return_date_edit);

                if ($return_date <= $attendance_date) {
                    return response()->json(['status' => 'notAccept', 'msg' => __('Return Visit Date must be after the current date')]);
                }
            }

            $update = Acceptor::find($acceptor->id)->update([
                'attendance_date' =>  $attendance_date,
                'menstrual_date' => $menstrual_date,
                'weight' => $request->weight_edit,
                'blood_pressure' => $request->blood_pressure_edit,
                'complication' => $request->complication_edit,
                'failure' => $request->failure_edit,
                'birth_control_id' => $request->birth_control_id_edit,
                'return_date' => $return_date,
                'description' => $request->description_edit
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Data Update Failed')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Data Updated Successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acceptor  $acceptor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acceptor $acceptor)
    {
        $delete = Acceptor::destroy($acceptor->id);

        if ($delete) {
            return redirect()->back()->with('success', __('Data deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('Failed to delete data'));
        }
    }

    public function deleteAll(Request $request)
    {
        $delete = Acceptor::destroy($request->ids);

        if ($delete) {
            return redirect()->back()->with('success', __('Data deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('Failed to delete data'));
        }
    }


    public function print($no_rm)
    {
        $patient =  Patient::where('no_rm', '=', $no_rm)->first();

        $dateOfBirth = $patient->date_brithday;
        $ageInYears = Carbon::parse($dateOfBirth)
            ->diff(Carbon::now())
            ->format('%y ' . __('Years') . ', %m ' . __('Months') . ' ' . __('and') . '  %d ' . __('Days'));

        return view('print.akseptor_print', [
            'patient' => $patient,
            'ageInYears' => $ageInYears,
            'acceptors' => Acceptor::where('patient_id', $patient->id)->orderBy('attendance_date', 'ASC')->get(),
            'couples' =>  Couple::where('patient_id', $patient->id)->orderBy('name')->get(),
        ]);
    }
}
