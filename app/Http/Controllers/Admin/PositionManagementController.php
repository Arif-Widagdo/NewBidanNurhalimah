<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Staff;
use Ramsey\Uuid\Uuid;
use App\Models\Patient;
use App\Models\Position;
use App\Models\Graduated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PositionManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.position_management.index', [
            'roles' => Role::all(),
            'positions' => Position::all(),
            'staffs' => Staff::all(),
            'patients' => Patient::all(),
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
            'name' => ['required', 'string', 'max:50', 'unique:positions'],
            'slug' => ['required', 'string',  'max:255', 'unique:positions'],
            'status' => ['required', 'in:actived,blocked',],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $store = Position::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => Str::ucfirst($request->name),
                'slug' => $request->slug,
                'status' => $request->status,
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong while creating a staff position')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('New staff position created successfully')]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return view('admin.position_management.show', [
            'staffs' => Staff::where('position_id', $position->id)->orderBy('employe_id')->get(),
            'position' => $position,
            'positions' => Position::orderBy('name')->get(),
            'graduateds' => Graduated::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        if ($request->slug != $position->slug) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50', 'unique:positions'],
                'slug' => ['required', 'string',  'max:255', 'unique:positions'],
                'position_status_edit' => ['required', 'in:actived,blocked',],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50'],
                'slug' => ['required', 'string',  'max:255'],
                'position_status_edit' => ['required', 'in:actived,blocked',],
            ]);
        }

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = Position::find($position->id)->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->position_status_edit,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Something went wrong when updating staff position')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Staff Position edited successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $staffes = Staff::where('position_id', '=', $position->id)->get();
        if ($staffes) {
            foreach ($staffes as $staff) {
                $users = User::where('id', '=', $staff->user_id)->get();
                Staff::destroy($staff->id);
                if ($users) {
                    foreach ($users as $user) {
                        User::destroy($user->id);
                    }
                }
            }
        }

        $delete = Position::destroy($position->id);
        if ($delete) {
            return redirect()->back()->with('success', __('Staff Position successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Staff Position Data Deletion Failed'));
        }
    }

    /**
     * Check Slug.
     */
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Position::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
