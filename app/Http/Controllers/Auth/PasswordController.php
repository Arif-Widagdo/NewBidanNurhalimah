<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        return $fail(__('isIncorrectPassword'));
                    }
                },
                'min:8',
                'max:38'
            ],
            'newpassword' => 'required|min:8|max:38',
            'cnewpassword' => 'required|same:newpassword'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Something went wrong when changing the password')]);
        } else {
            $update = User::find(auth()->user()->id)->update(['password' => Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when changing the password')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Your password has been changed successfully')]);
            }
        }
    }
}
