<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Staff;
use Ramsey\Uuid\Uuid;
use App\Models\Position;
use App\Models\Graduated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.staff_management.index', [
            'staffs' => Staff::where('id', '!=', auth()->user()->staff->id)->orderBy('employe_id')->get(),
            'positions' => Position::orderBy('name')->get(),
            'graduateds' => Graduated::orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff_management.create', [
            'positions' => Position::orderBy('name')->get(),
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
            'position_id' => ['required'],
            'graduated_id' => ['required'],
            'place_brithday' => ['required', 'string'],
            'date_brithday' => ['required'],
            'phoneNumber' => ['required'],
            'address' => ['required', 'string'],
        ];
        if ($request->has('create_account')) {
            $validator['username'] = 'required|min:8|alpha_num|unique:users,username';
            $validator['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . User::class];
        }
        $validated = Validator::make($request->all(), $validator);

        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $reqDate = Carbon::createFromFormat('d-m-Y', $request->date_brithday);
            $beforeSeventeen = Carbon::now()->subYear(10);

            if ($reqDate >= $beforeSeventeen) {
                return response()->json(['status' => 'notAccept', 'msg' => __('Hes not yet 10 years old, you cant enter the data wrong, right?')]);
            }

            $id = null;
            if ($request->has('create_account')) {
                $role_administrator = Role::whereSlug('administrator')->first();
                $user = User::create([
                    'id' => Uuid::uuid4()->toString(),
                    'role_id' => $role_administrator->id,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->username),
                ]);
                $id = $user->id;
            }

            $staff = Staff::create([
                'id' => Uuid::uuid4()->toString(),
                'user_id' => $id,
                'name' => $request->name,
                'gender' => $request->gender,
                'position_id' => $request->position_id,
                'graduated_id' => $request->graduated_id,
                'place_brithday' => $request->place_brithday,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
            ]);

            if (!$staff->save()) {
                return response()->json(['status' => 0, 'msg' => __('Staff Data Failed to Create')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Staff Data Created Successfully')]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $validator =  [
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:F,M'],
            'position_id' => ['required'],
            'graduated_id' => ['required'],
            'place_brithday' => ['required', 'string'],
            'date_brithday' => ['required'],
            'phoneNumber' => ['required'],
            'address' => ['required', 'string'],
        ];

        $user = User::where('id', $request->user_id)->first();

        if ($user) {
            if ($user->username != $request->username) {
                // $validator['username'] = 'required|without_spaces|unique:users,username';
                $validator['username'] = 'required|min:8|alpha_num|unique:users,username';
                $validator['email'] = ['required', 'string', 'email', 'max:255'];
                $validator['status'] = ['required'];
            } elseif ($user->email != $request->email) {
                $validator['username'] = 'required|min:8|alpha_num|unique:users,username';
                $validator['email'] = ['required', 'string', 'email', 'max:255'];
                $validator['status'] = ['required'];
            }
        } else {
            if ($request->email != '' || $request->username != '' || $request->status != '') {
                $validator['username'] = 'required|min:8|alpha_num|unique:users,username';
                $validator['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . User::class];
                $validator['status'] = ['required', 'in:actived,blocked'];
            }
        }

        $validated = Validator::make($request->all(), $validator);

        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {

            $reqDate = Carbon::createFromFormat('d-m-Y', $request->date_brithday);
            $beforeSeventeen = Carbon::now()->subYear(10);

            if ($reqDate >= $beforeSeventeen) {
                return response()->json(['status' => 'notAccept', 'msg' => __('Hes not yet 10 years old, you cant enter the data wrong, right?')]);
            }

            $id = null;
            if ($user) {
                if ($request->email != '' || $request->username != '' || $request->status != '') {
                    User::find($user->id)->update([
                        'username' => $request->username,
                        'email' => $request->email,
                        'status' => $request->status,
                    ]);
                }
                $id = $user->id;
            } else {
                if ($request->email != '' || $request->username != '') {
                    $role_administrator = Role::whereSlug('administrator')->first();
                    $user_create = User::create([
                        'id' => Uuid::uuid4()->toString(),
                        'role_id' => $role_administrator->id,
                        'username' => $request->username,
                        'email' => $request->email,
                        'password' => Hash::make($request->username),
                    ]);
                    $id = $user_create->id;
                }
            }

            $staff_update = Staff::find($staff->id)->update([
                'user_id' => $id,
                'name' => $request->name,
                'gender' => $request->gender,
                'position_id' => $request->position_id,
                'graduated_id' => $request->graduated_id,
                'place_brithday' => $request->place_brithday,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
            ]);

            if (!$staff_update) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when updating staff data')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Staff data edited successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $user = User::where('id', $staff->user_id)->first();

        if ($user) {
            User::destroy($user->id);
        }

        $delete = Staff::destroy($staff->id);

        if ($delete) {
            return redirect()->back()->with('success', __('Staff Data successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Staff Data Deletion Failed'));
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids != '') {
            foreach ($request->ids as $id) {
                $staff = Staff::where('id', $id)->first();

                if ($staff->user_id != '') {
                    $user = User::where('id', $staff->user_id)->first();
                    User::destroy($user->id);
                }
            }
        }

        $delete = Staff::destroy($request->ids);

        if ($delete) {
            return redirect()->back()->with('success', __('Staff Data successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Staff Data Deletion Failed'));
        }
    }
}
