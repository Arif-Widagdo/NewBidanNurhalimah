<?php

namespace App\Http\Controllers\Crew;

use App\Models\Role;
use App\Models\User;
use App\Models\Work;
use Ramsey\Uuid\Uuid;
use App\Models\Patient;
use App\Models\Graduated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crew.patient_management.index', [
            'patients' => Patient::orderBy('no_rm', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crew.patient_management.create', [
            'works' => Work::orderBy('name')->get(),
            'graduateds' => Graduated::orderBy('name')->get()
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
        if ($request->has('create_account')) {
            $validator['username'] = 'required|without_spaces|unique:users,username';
            $validator['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . User::class];
        }
        $validated = Validator::make($request->all(), $validator);

        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $reqDate = Carbon::createFromFormat('d-m-Y', $request->date_brithday);
            $beforeSeventeen = Carbon::now()->subYear(17);

            if ($reqDate >= $beforeSeventeen) {
                return response()->json(['status' => 'notAccept', 'msg' => __('Hes not yet 17 years old, you cant enter the data wrong, right?')]);
            }

            $id = null;
            if ($request->has('create_account')) {
                $role_patient = Role::whereSlug('patient')->first();
                $user = User::create([
                    'id' => Uuid::uuid4()->toString(),
                    'role_id' => $role_patient->id,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->username),
                ]);
                $id = $user->id;
            }

            $patient = Patient::create([
                'id' => Uuid::uuid4()->toString(),
                'user_id' => $id,
                'name' => $request->name,
                'gender' => $request->gender,
                'work_id' => $request->position_id,
                'graduated_id' => $request->graduated_id,
                'place_brithday' => $request->place_brithday,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
            ]);

            if (!$patient->save()) {
                return response()->json(['status' => 0, 'msg' => __('Patient Data Failed to Create')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Patient Data Created Successfully')]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
