<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SiteInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SiteManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.site_management.update', [
            'site' =>  SiteInformation::latest()->first()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteInformation  $siteInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $site = SiteInformation::where('id', $id)->first();

        $validator =  [
            'address' => ['required', 'string',  'max:255'],
            'telp' => ['required', 'string', 'min:8', 'max:20'],
            'facebook' => ['nullable', 'string',  'max:255'],
            'twitter' => ['nullable', 'string',  'max:255'],
            'instagram' => ['nullable', 'string',  'max:255'],
            'linkedin' => ['nullable', 'string',  'max:255'],
        ];
        if ($request->email != $site->email) {
            $validator['email'] =  ['required', 'string',  'max:255', 'unique:site_information'];
        }
        $validated = Validator::make($request->all(), $validator);

        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $query = SiteInformation::find($id)->update([
                'address' => $request->address,
                'telp' => $request->telp,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => __('Update Failed Information')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Information Updated Successfully')]);
            }
        }
    }
}
