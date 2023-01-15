<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
