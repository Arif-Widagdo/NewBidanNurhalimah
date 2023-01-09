<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Staff;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $dateOfBirth = $request->user()->staff->date_brithday;
        $ageInYears = Carbon::parse($dateOfBirth)
            ->diff(Carbon::now())
            ->format('%y ' . __('Years') . ', %m ' . __('Months') . ' ' . __('and') . '  %d ' . __('Days'));



        // $ageInMonths = $ageInYears * 12;
        // $ageInMonths = Carbon::now()->diffInMonths(Carbon::parse($ageInYears));

        // $years = Carbon::parse($dateOfBirth)->diffForHumans(['parts' => 3, 'short' => true]);

        if (auth()->user()->role->slug === 'administrator') {
            return view('profile.edit', [
                'user' => $request->user(),
                'ageInYears' => $ageInYears,
                // 'ageInMonths' => $ageInMonths
            ]);
        } else {
            return view('profile.edit', [
                'user' => $request->user(),
            ]);
        }
    }

    public function updatePicture(Request $request)
    {
        $path = 'storage/users/';
        $file = $request->file('user_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        // upload new image
        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => __('Something Wrong, At the time of uploading a new image!')]);
        } else {
            $oldPicture = User::find(auth()->user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if (File::exists(public_path($path . $oldPicture))) {
                    File::delete(public_path($path . $oldPicture));
                }
            }

            $update = User::find(auth()->user()->id)->update(['picture' => $new_name]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Something Wrong, At the time of uploading a new image!')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Your profile picture has been updated successfully')]);
            }
        }
    }

    function deletePicture()
    {
        $path = 'storage/users/';
        $oldPicture = User::find(auth()->user()->id)->getAttributes()['picture'];

        if ($oldPicture != '') {
            if (File::exists(public_path($path . $oldPicture))) {
                File::delete(public_path($path . $oldPicture));
            }
        }

        $deleted = User::find(auth()->user()->id)->update(['picture' =>  null]);

        if (!$deleted) {
            return redirect()->back()->with('success', __('Something went wrong while deleting your profile picture'));
        } else {
            return redirect()->back()->with('success', __('Your profile picture has been deleted successfully'));
        }
    }

    public function updateStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:F,M'],
            'place_brithday' => ['required', 'string'],
            'date_brithday' => ['required'],
            'phoneNumber' => ['required'],
            'address' => ['required', 'string'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Something went wrong, updating personal information')]);
        } else {
            $userId = auth()->user()->id;
            $Staff = Staff::where('user_id', $userId)->first();

            $updated = Staff::find($Staff->id)->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'place_brithday' => $request->place_brithday,
                'date_brithday' => Carbon::createFromFormat('d-m-Y', $request->date_brithday),
                'phoneNumber' => $request->phoneNumber,
                'job_id' => $request->job_id,
                'graduated_id' => $request->graduated_id,
                'address' => $request->address,
            ]);

            if (!$updated) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong, updating personal information')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Your profile info has been updated successfully')]);
            }
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
