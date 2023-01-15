<?php

namespace App\Http\Controllers\Crew;

use Ramsey\Uuid\Uuid;
use App\Models\BirthControl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Acceptor;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BCManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crew.birth_control.index', [
            'birth_controls' => BirthControl::orderBy('name')->get()
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
            'name' => ['required', 'string', 'max:50', 'unique:birth_controls'],
            'slug' => ['required', 'string',  'max:255', 'unique:birth_controls'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $store = BirthControl::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('New Type Failed to Add')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('New Type Has Been Added')]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BirthControl  $birthControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BirthControl $birthControl)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'unique:birth_controls'],
            'slug' => ['required', 'string',  'max:255', 'unique:birth_controls'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = BirthControl::find($birthControl->id)->update([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when updating Birth Control Type ')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Type of Birth Control Updated Successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BirthControl  $birthControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(BirthControl $birthControl)
    {
        $acceptors = Acceptor::where('birthControl_id', $birthControl->id)->get();

        if ($acceptors) {
            foreach ($acceptors as $acceptor) {
                Acceptor::find($acceptor->id)->update([
                    'birthControl_id' => ''
                ]);
            }
        }

        $delete = BirthControl::destroy($birthControl->id);
        if ($delete) {
            return redirect()->back()->with('success', __('Type of Birth Control Successfully Removed'));
        } else {
            return redirect()->back()->with('error', __('Type Failed to Delete Birth Control'));
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids != '') {
            foreach ($request->ids as $id) {
                $acceptors = Acceptor::where('birthControl_id', $id)->get();
                if ($acceptors) {
                    foreach ($acceptors as $acceptor) {
                        Acceptor::find($acceptor->id)->update([
                            'birthControl_id' => ''
                        ]);
                    }
                }
            }
        }

        $delete = BirthControl::destroy($request->ids);
        if ($delete) {
            return redirect()->back()->with('success', __('Type of Birth Control Successfully Removed'));
        } else {
            return redirect()->back()->with('error', __('Type Failed to Delete Birth Control'));
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(BirthControl::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
