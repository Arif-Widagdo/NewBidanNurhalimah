<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_management.index', [
            'users' => User::where('id', '!=', auth()->user()->id)->latest()->get(),
            'staffs' => Staff::all(),
            'patients' => Patient::all()
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator =  [
            'username' => 'required',
            'email' => 'required|string|email',
            'status' => 'required|in:actived,blocked'
        ];
        if ($request->email != $user->email) {
            $validator['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . User::class];
        }
        if ($request->username != $user->username) {
            $validator['username'] = 'required|alpha_num|unique:users,username';
        }

        $validated = Validator::make($request->all(), $validator);
        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {

            $user_updated = User::find($user->id)->update([
                'username' => $request->username,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            if (!$user_updated) {
                return response()->json(['status' => 0, 'msg' => __('User failed update')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('User successfully updated')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $staff = Staff::where('user_id', $user->id)->first();
        if ($staff) {
            Staff::find($staff->id)->update([
                'user_id' => null,
            ]);
        }

        $patient = Patient::where('user_id', $user->id)->first();
        if ($patient) {
            Patient::find($patient->id)->update([
                'user_id' => null,
            ]);
        }

        $delete = User::destroy($user->id);
        if ($delete) {
            return redirect()->back()->with('success', __('user account deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('user account failed to delete'));
        }
    }
}
