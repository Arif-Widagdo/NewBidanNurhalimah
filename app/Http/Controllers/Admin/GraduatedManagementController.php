<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Ramsey\Uuid\Uuid;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class GraduatedManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.graduated_management.index', [
            'graduateds' => Graduated::orderBy('name')->get(),
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'unique:graduateds'],
            'slug' => ['required', 'string',  'max:255', 'unique:graduateds'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $store = Graduated::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong while creating a education')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('New Graduated created successfully')]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Graduated  $graduated
     * @return \Illuminate\Http\Response
     */
    public function show(Graduated $graduated)
    {
        $staffs = Staff::where('graduated_id', $graduated->id)->orderBy('employe_id')->get();
        $patients = Patient::where('graduated_id', $graduated->id)->orderBy('no_rm')->get();

        return view('admin.graduated_management.show', [
            'staffs' => $staffs,
            'patients' => $patients,
            'graduated' => $graduated
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graduated  $graduated
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduated $graduated)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'unique:graduateds'],
            'slug' => ['required', 'string',  'max:255', 'unique:graduateds'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = Graduated::find($graduated->id)->update([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when updating graduated')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Graduated edited successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Graduated  $graduated
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduated $graduated)
    {
        $staffs = Staff::where('graduated_id', $graduated->id)->get();
        $patients = Patient::where('graduated_id', $graduated->id)->get();

        if ($staffs) {
            foreach ($staffs as $staff) {
                Staff::find($staff->id)->update([
                    'graduated_id' => ''
                ]);
            }
        }
        if ($patients) {
            foreach ($patients as $patient) {
                Patient::find($patient->id)->update([
                    'graduated_id' => ''
                ]);
            }
        }

        $delete = Graduated::destroy($graduated->id);

        if ($delete) {
            return redirect()->back()->with('success', __('Graduated successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Graduated Data Deletion Failed'));
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids != '') {
            foreach ($request->ids as $id) {
                $staffs = Staff::where('graduated_id', $id)->get();
                $patients = Patient::where('graduated_id', $id)->get();
                if ($staffs) {
                    foreach ($staffs as $staff) {
                        Staff::find($staff->id)->update([
                            'graduated_id' => ''
                        ]);
                    }
                }
                if ($patients) {
                    foreach ($patients as $patient) {
                        Patient::find($patient->id)->update([
                            'graduated_id' => ''
                        ]);
                    }
                }
            }
        }

        $delete = Graduated::destroy($request->ids);
        if ($delete) {
            return redirect()->back()->with('success', __('Graduated successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Graduated Data Deletion Failed'));
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Graduated::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
