<?php

namespace App\Http\Controllers\Admin;

use App\Models\Work;
use App\Models\Graduated;
use App\Models\Patient;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class WorkManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.work_management.index', [
            'works' => Work::orderBy('name')->get(),
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
            'name' => ['required', 'string', 'max:50', 'unique:works'],
            'slug' => ['required', 'string',  'max:255', 'unique:works'],
            'work_status' => ['required', 'in:male,female,general',],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $store = Work::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'slug' => $request->slug,
                'work_status' => $request->work_status,
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong while creating a job')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('New job created successfully')]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        $patients = Patient::where('work_id', $work->id)->orderBy('name')->get();
        return view('admin.work_management.show', [
            'work' => $work,
            'works' => Work::all(),
            'graduateds' => Graduated::all(),
            'patients' => $patients,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        if ($request->slug != $work->slug) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50', 'unique:works'],
                'slug' => ['required', 'string',  'max:255', 'unique:works'],
                'work_status_edit' => ['required', 'in:male,female,general',],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50'],
                'slug' => ['required', 'string',  'max:255'],
                'work_status_edit' => ['required', 'in:male,female,general',],
            ]);
        }

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = Work::find($work->id)->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'work_status' => $request->work_status_edit,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when updating job')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Job edited successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $patients = Patient::where('work_id', $work->id)->get();

        if ($patients) {
            foreach ($patients as $patient) {
                Patient::find($patient->id)->update([
                    'work_id' => ''
                ]);
            }
        }

        $delete = Work::destroy($work->id);
        if ($delete) {
            return redirect()->back()->with('success', __('Job successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Job Data Deletion Failed'));
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids != '') {
            foreach ($request->ids as $id) {
                $patients = Patient::where('work_id', $id)->get();

                if ($patients) {
                    foreach ($patients as $patient) {
                        Patient::find($patient->id)->update([
                            'work_id' => ''
                        ]);
                    }
                }
            }
        }

        $delete = Work::destroy($request->ids);
        if ($delete) {
            return redirect()->back()->with('success', __('Job successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Job Data Deletion Failed'));
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Work::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
