<?php

namespace App\Http\Controllers\Admin;

use Ramsey\Uuid\Uuid;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SiteInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = SiteInformation::latest()->first();
        $categories = Category::where('site_id', $site->id)->orderBy('name', 'ASC')->get();

        return view('admin.site_management.category_management.index', [
            'categories' => $categories
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
            'name' => ['required', 'string', 'max:50', 'unique:categories'],
            'slug' => ['required', 'string',  'max:255', 'unique:categories'],
            'status' => ['required', 'in:actived,not_actived',],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $site = SiteInformation::latest()->first();
            $store = Category::create([
                'id' => Uuid::uuid4()->toString(),
                'site_id' => $site->id,
                'name' => Str::ucfirst($request->name),
                'slug' => $request->slug,
                'status' => $request->status,
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Somethin went Wrong, creating category')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Category created successfully')]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->slug != $category->slug) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50', 'unique:categories'],
                'slug' => ['required', 'string',  'max:255', 'unique:categories'],
                'category_status_edit' => ['required', 'in:actived,not_actived',],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50'],
                'slug' => ['required', 'string',  'max:255'],
                'category_status_edit' => ['required', 'in:actived,not_actived',],
            ]);
        }
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = Category::find($category->id)->update([
                'name' =>  Str::ucfirst($request->name),
                'slug' => $request->slug,
                'status' => $request->category_status_edit,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('Category failed to edit')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Category edited successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $delete = Category::destroy($category->id);
        if ($delete) {
            return redirect()->back()->with('success', __('Category successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Category failed to delete'));
        }
    }

    public function deleteAll(Request $request)
    {
        $delete = Category::destroy($request->ids);
        if ($delete) {
            return redirect()->back()->with('success', __('Category successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('Category failed to delete'));
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
