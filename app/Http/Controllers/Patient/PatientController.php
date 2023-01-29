<?php

namespace App\Http\Controllers\Patient;

use Ramsey\Uuid\Uuid;
use App\Models\Couple;
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

    public function registerCouple(Request $request)
    {
        $validator =  [
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:F,M'],
            'work_id' => ['required'],
            'graduated_id' => ['required'],
            'place_brithday' => ['required', 'string'],
            'date_brithday' => ['required'],
            'phoneNumber' => ['required'],
            'address' => ['required', 'string'],
        ];

        $validated = Validator::make($request->all(), $validator);

        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $reqDate = Carbon::createFromFormat('d-m-Y', $request->date_brithday);
            $beforeSeventeen = Carbon::now()->subYear(17);

            if ($reqDate >= $beforeSeventeen) {
                return response()->json(['status' => 'notAccept', 'msg' => __('Hes not yet 17 years old, you cant enter the data wrong, right?')]);
            }
            $couple = Couple::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'gender' => $request->gender,
                'work_id' => $request->work_id,
                'graduated_id' => $request->graduated_id,
                'place_brithday' => $request->place_brithday,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'patient_id' => auth()->user()->patient->id,
            ]);

            if (!$couple->save()) {
                return response()->json(['status' => 0, 'msg' => __('Couple Data Failed to Save')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Couple Data Saved Successfully')]);
            }
        }
    }

    public function coupleEdit(Request $request, Couple $couple)
    {
        $validator = Validator::make($request->all(), [
            'name_edit' => ['required', 'string', 'max:100'],
            'gender_edit' => ['required', 'in:F,M'],
            'work_id_edit' => ['required'],
            'graduated_id_edit' => ['required'],
            'place_brithday_edit' => ['required', 'string'],
            'date_brithday_edit' => ['required'],
            'phoneNumber_edit' => ['required'],
            'address_edit' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $reqDate = Carbon::createFromFormat('d-m-Y', $request->date_brithday_edit);
            $beforeSeventeen = Carbon::now()->subYear(17);

            if ($reqDate >= $beforeSeventeen) {
                return response()->json(['status' => 'notAccept', 'msg' => __('Hes not yet 17 years old, you cant enter the data wrong, right?')]);
            }

            $couple_edit = Couple::find($couple->id)->update([
                'name' => $request->name_edit,
                'gender' => $request->gender_edit,
                'work_id' => $request->work_id_edit,
                'graduated_id' => $request->graduated_id_edit,
                'place_brithday' => $request->place_brithday_edit,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday_edit),
                'phoneNumber' => $request->phoneNumber_edit,
                'address' => $request->address_edit,
            ]);

            if (!$couple_edit) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when updating Couple data')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Couple data edited successfully')]);
            }
        }
    }


    public function validatePatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rm' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'date_brithday' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $patient = Patient::where('no_rm', '=', $request->no_rm)->first();

            if ($patient) {
                if ($patient->user_id != null) {
                    $em   = explode("@", $patient->account->email);
                    $name = implode('@', array_slice($em, 0, count($em) - 1));
                    $len  = floor(strlen($name) / 2);
                    $result = substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);

                    return response()->json(['status' => 0, 'msg' => 'Pasient Tersebut Telah Memiliki Akun dengan alamat email ' . $result]);
                } else {
                    if (strtolower($request->name) == strtolower($patient->name) && $patient->date_brithday == Carbon::parse($request->date_brithday)->translatedFormat('Y-m-d')) {
                        $patient_update = Patient::find($patient->id)->update([
                            'user_id' => auth()->user()->id,
                        ]);
                        if (!$patient_update) {
                            return response()->json(['status' => 0, 'msg' => 'Gagal Memperbarui']);
                        } else {
                            return response()->json(['status' => 1, 'msg' => 'Berhasil Memperbarui']);
                        }
                    } else {
                        return response()->json(['status' => 0, 'msg' => 'Data yang dimasukan Tidak Sesuai']);
                    }
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Data Tidak Sesuai']);
            }
        }
    }
}
