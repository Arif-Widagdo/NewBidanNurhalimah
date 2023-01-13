<?php

namespace App\Http\Controllers\Crew;

use Ramsey\Uuid\Uuid;
use App\Models\Couple;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CoupleManagementController extends Controller
{


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
                'patient_id' => $request->patient_id,
            ]);

            if (!$couple->save()) {
                return response()->json(['status' => 0, 'msg' => __('Couple Data Failed to Save')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Couple Data Saved Successfully')]);
            }
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Couple  $couple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Couple $couple)
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
}
