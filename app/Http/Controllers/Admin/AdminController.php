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
    public function dashboard()
    {
        $birth_controls = BirthControl::all();
        $acceptors = [];

        foreach ($birth_controls as $birthControl) {
            $acceptors[] = Acceptor::where('birth_control_id', $birthControl->id)
                ->orderBy('patient_id', 'DESC')->get()->groupBy(function ($item) {
                    return $item->patient_id;
                });
        }
        $now = Carbon::now();

        $year =  $now->year;
        // $year =  2022;


        for ($i = 1; $i <= 12; $i++) {
            ${"patients" . $i} = Patient::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->get();
        }

        // for ($i = 1; $i <= 12; $i++) {
        //     ${"users" . $i} = User::whereHas('role', function ($query) {
        //         $query->where('slug', 'patient');
        //     })->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->with('patient')->get();

        //     return $users1;
        // }

        // ------ With Eloquent
        // for ($i = 1; $i <= 12; $i++) {
        //     ${"users" . $i} = User::whereHas('role', function ($query) {
        //         $query->where('slug', 'patient');
        //     })->whereHas('patient', function ($patient) {
        //         $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 1);
        //     })->get();
        //     return $users1;
        // }


        $users1 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 1);
        })->get();

        $users2 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 2);
        })->get();

        $users3 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 3);
        })->get();

        $users4 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 4);
        })->get();

        $users5 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 5);
        })->get();

        $users6 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 6);
        })->get();

        $users7 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 7);
        })->get();

        $users8 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 8);
        })->get();

        $users9 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 9);
        })->get();

        $users10 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 10);
        })->get();

        $users11 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 11);
        })->get();

        $users12 = User::whereHas('role', function ($query) {
            $query->where('slug', 'patient');
        })->whereHas('patient', function ($patient) {
            $patient->whereYear('created_at', '=', 2023)->whereMonth('created_at', '=', 12);
        })->get();

        return view('admin.dashboard', [
            'birthControls' => $birth_controls,
            'acceptors' => $acceptors,

            'patientJan' => $patients1,
            'patientFeb' => $patients2,
            'patientMar' => $patients3,
            'patientApr' => $patients4,
            'patientMei' => $patients5,
            'patientJun' => $patients6,
            'patientJul' => $patients7,
            'patientAug' => $patients8,
            'patientSep' => $patients9,
            'patientOct' => $patients10,
            'patientNov' => $patients11,
            'patientDes' => $patients12,

            'userJan' => $users1->count(),
            'userFeb' => $users2->count(),
            'userMar' => $users3->count(),
            'userApr' => $users4->count(),
            'userMei' => $users5->count(),
            'userJun' => $users6->count(),
            'userJul' => $users7->count(),
            'userAug' => $users8->count(),
            'userSep' => $users9->count(),
            'userOct' => $users10->count(),
            'userNov' => $users11->count(),
            'userDes' => $users12->count(),
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
