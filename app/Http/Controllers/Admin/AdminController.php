<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Patient;
use App\Models\Acceptor;
use App\Models\BirthControl;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     // for ($i = 1; $i <= 12; $i++) {
    //     //     ${"users" . $i} = User::whereHas('role', function ($query) {
    //     //         $query->where('slug', 'patient');
    //     //     })->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->with('patient')->get();

    //     //     return $users1;
    //     // }

    //     // ------ With Eloquent
    //     // for ($i = 1; $i <= 12; $i++) {
    //     //     ${"users" . $i} = User::whereHas('role', function ($query) {
    //     //         $query->where('slug', 'patient');
    //     //     })->whereHas('patient', function ($patient) {
    //     //         $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 1);
    //     //     })->get();
    //     //     return $users1;
    //     // }


    //     // $users1 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 1);
    //     // })->get();

    //     // $users2 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 2);
    //     // })->get();

    //     // $users3 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 3);
    //     // })->get();

    //     // $users4 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 4);
    //     // })->get();

    //     // $users5 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 5);
    //     // })->get();

    //     // $users6 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 6);
    //     // })->get();

    //     // $users7 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 7);
    //     // })->get();

    //     // $users8 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 8);
    //     // })->get();

    //     // $users9 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 9);
    //     // })->get();

    //     // $users10 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 10);
    //     // })->get();

    //     // $users11 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 11);
    //     // })->get();

    //     // $users12 = User::whereHas('role', function ($query) {
    //     //     $query->where('slug', 'patient');
    //     // })->whereHas('patient', function ($patient) {
    //     //     $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 12);
    //     // })->get();

    //     $birth_controls = BirthControl::all();
    //     $acceptors = [];

    //     foreach ($birth_controls as $birthControl) {
    //         $acceptors[] = Acceptor::where('birth_control_id', $birthControl->id)
    //             ->orderBy('patient_id', 'DESC')->get()->groupBy(function ($item) {
    //                 return $item->patient_id;
    //             });
    //     }
    //     $now = Carbon::now();

    //     $thisYear =  $now->year;
    //     // $year =  2022;

    //     $lastYear = $now->subYear();


    //     for ($i = 1; $i <= 12; $i++) {
    //         ${"patientsThisYear" . $i} = Patient::whereYear('created_at', '=', $thisYear)->whereMonth('created_at', '=', $i)->get();
    //     }

    //     for ($i = 1; $i <= 12; $i++) {
    //         ${"patientsLastYear" . $i} = Patient::whereYear('created_at', '=', $lastYear)->whereMonth('created_at', '=', $i)->get();
    //     }

    //     return view('admin.dashboard', [
    //         'patients' => Patient::all(),
    //         'users' => User::all(),

    //         'birthControls' => $birth_controls,
    //         'acceptors' => $acceptors,

    //         'patientJanThisYear' => $patientsThisYear1,
    //         'patientFebThisYear' => $patientsThisYear2,
    //         'patientMarThisYear' => $patientsThisYear3,
    //         'patientAprThisYear' => $patientsThisYear4,
    //         'patientMeiThisYear' => $patientsThisYear5,
    //         'patientJunThisYear' => $patientsThisYear6,
    //         'patientJulThisYear' => $patientsThisYear7,
    //         'patientAugThisYear' => $patientsThisYear8,
    //         'patientSepThisYear' => $patientsThisYear9,
    //         'patientOctThisYear' => $patientsThisYear10,
    //         'patientNovThisYear' => $patientsThisYear11,
    //         'patientDesThisYear' => $patientsThisYear12,

    //         // Last Year
    //         'patientJanLastYear' => $patientsLastYear1,
    //         'patientFebLastYear' => $patientsLastYear2,
    //         'patientMarLastYear' => $patientsLastYear3,
    //         'patientAprLastYear' => $patientsLastYear4,
    //         'patientMeiLastYear' => $patientsLastYear5,
    //         'patientJunLastYear' => $patientsLastYear6,
    //         'patientJulLastYear' => $patientsLastYear7,
    //         'patientAugLastYear' => $patientsLastYear8,
    //         'patientSepLastYear' => $patientsLastYear9,
    //         'patientOctLastYear' => $patientsLastYear10,
    //         'patientNovLastYear' => $patientsLastYear11,
    //         'patientDesLastYear' => $patientsLastYear12,

    //         // 'userJan' => $users1->count(),
    //         // 'userFeb' => $users2->count(),
    //         // 'userMar' => $users3->count(),
    //         // 'userApr' => $users4->count(),
    //         // 'userMei' => $users5->count(),
    //         // 'userJun' => $users6->count(),
    //         // 'userJul' => $users7->count(),
    //         // 'userAug' => $users8->count(),
    //         // 'userSep' => $users9->count(),
    //         // 'userOct' => $users10->count(),
    //         // 'userNov' => $users11->count(),
    //         // 'userDes' => $users12->count(),
    //     ]);
    // }

    public function dashboard()
    {
        $now = Carbon::now();
        $thisYear =  $now->year;
        $lastYear = $now->subYear();

        $fromLastYear = date("Y", time() - 60 * 60 * 24 * 365) . '-01-01';
        $toDateLastYear =  date("Y", time() - 60 * 60 * 24 * 365) . '-' . date('m-d');
        $countPatientLastYear = Patient::whereBetween('created_at', [$fromLastYear, $toDateLastYear])->whereHas('acceptor', function ($query) {
            $query->orderBy('return_date', 'DESC');
        })->get();


        $fromThisYear = date("Y") . '-01-01';
        $toDateThisYear =  date("Y-m-d");
        $countPatientThisYear = Patient::whereBetween('created_at', [$fromThisYear, $toDateThisYear])->whereHas('acceptor', function ($query) {
            $query->orderBy('return_date', 'DESC');
        })->get();


        // Rumus
        // Tahun sekarang - tahun sebelumnya / tahun sebelumnya * 100%
        $presentase = $countPatientThisYear->count() - $countPatientLastYear->count() / $countPatientLastYear->count() * 100 / 100;

        // Kenaikan 
        $increasePatient = $countPatientThisYear->count() - $countPatientLastYear->count();










        $birth_controls = BirthControl::all();
        $acceptors = [];

        foreach ($birth_controls as $birthControl) {
            $acceptors[] = Acceptor::where('birth_control_id', $birthControl->id)
                ->orderBy('patient_id', 'DESC')->get()->groupBy(function ($item) {
                    return $item->patient_id;
                });
        }



        for ($i = 1; $i <= 12; $i++) {
            ${"patientsThisYear" . $i} = Patient::whereYear('created_at', '=', $thisYear)->whereMonth('created_at', '=', $i)->whereHas('acceptor', function ($query) {
                $query->orderBy('return_date', 'DESC');
            })->get();
        }

        for ($i = 1; $i <= 12; $i++) {
            ${"patientsLastYear" . $i} = Patient::whereYear('created_at', '=', $lastYear)->whereMonth('created_at', '=', $i)->whereHas('acceptor', function ($query) {
                $query->orderBy('return_date', 'DESC');
            })->get();
        }













        return view('admin.dashboard', [
            'patients' => Patient::all(),
            'users' => User::all(),

            'birthControls' => $birth_controls,
            'acceptors' => $acceptors,


            "presentase" => $presentase,
            "increasePatient" => $increasePatient,



            'patientJanThisYear' => $patientsThisYear1,
            'patientFebThisYear' => $patientsThisYear2,
            'patientMarThisYear' => $patientsThisYear3,
            'patientAprThisYear' => $patientsThisYear4,
            'patientMeiThisYear' => $patientsThisYear5,
            'patientJunThisYear' => $patientsThisYear6,
            'patientJulThisYear' => $patientsThisYear7,
            'patientAugThisYear' => $patientsThisYear8,
            'patientSepThisYear' => $patientsThisYear9,
            'patientOctThisYear' => $patientsThisYear10,
            'patientNovThisYear' => $patientsThisYear11,
            'patientDesThisYear' => $patientsThisYear12,

            // Last Year
            'patientJanLastYear' => $patientsLastYear1,
            'patientFebLastYear' => $patientsLastYear2,
            'patientMarLastYear' => $patientsLastYear3,
            'patientAprLastYear' => $patientsLastYear4,
            'patientMeiLastYear' => $patientsLastYear5,
            'patientJunLastYear' => $patientsLastYear6,
            'patientJulLastYear' => $patientsLastYear7,
            'patientAugLastYear' => $patientsLastYear8,
            'patientSepLastYear' => $patientsLastYear9,
            'patientOctLastYear' => $patientsLastYear10,
            'patientNovLastYear' => $patientsLastYear11,
            'patientDesLastYear' => $patientsLastYear12,
        ]);
    }



    public function roleUpdate(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'role_status_edit' => ['required', 'in:actived,blocked',],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = Role::find($role->id)->update([
                'status' => $request->role_status_edit,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Data Update Failed')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Data Updated Successfully')]);
            }
        }
    }
}
