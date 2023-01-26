<?php

namespace App\Http\Controllers\Patient;

use Ramsey\Uuid\Uuid;
use App\Models\Patient;
use App\Models\Acceptor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->patient || !auth()->user()->patient->couple) {
            return redirect()->route('profile.edit');
        } else {
            // $patient =  Patient::where('user_id', '=', auth()->user()->id)->first();

            return view('patient.dashboard', [
                // 'patient' => $patient,
                // 'acceptors' => Acceptor::where('patient_id', $patient->id)->orderBy('attendance_date', 'ASC')->get()
            ]);
        }
    }

    public function registerPatient(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:F,M'],
            'work_id' => ['required'],
            'graduated_id' => ['required'],
            'place_brithday' => ['required', 'string'],
            'date_brithday' => ['required'],
            'phoneNumber' => ['required'],
            'address' => ['required', 'string'],
            'marital_status' => ['required', 'in:single,married,divorced,dead_divorced'],
        ]);
        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $reqDate = Carbon::createFromFormat('d-m-Y', $request->date_brithday);
            $beforeSeventeen = Carbon::now()->subYear(17);

            if ($reqDate >= $beforeSeventeen) {
                return response()->json(['status' => 'notAccept', 'msg' => __('Hes not yet 17 years old, you cant enter the data wrong, right?')]);
            }
            $patient = Patient::create([
                'id' => Uuid::uuid4()->toString(),
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'gender' => $request->gender,
                'work_id' => $request->work_id,
                'graduated_id' => $request->graduated_id,
                'place_brithday' => $request->place_brithday,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'marital_status' => $request->marital_status
            ]);

            if (!$patient->save()) {
                return response()->json(['status' => 0, 'msg' => __('Patient Data Failed to Create')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Patient Data Created Successfully')]);
            }
        }
    }
}
