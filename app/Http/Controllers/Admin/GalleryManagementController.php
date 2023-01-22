<?php

namespace App\Http\Controllers\Admin;

use Ramsey\Uuid\Uuid;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SiteInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GalleryManagementController extends Controller
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

        return view('admin.site_management.gallery_management.index', [
            'categories' => $categories,
            'galleries' => Gallery::orderBy('created_at')->get()
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
            'title' => ['required', 'string', 'max:255', 'unique:galleries'],
            'category_id' => ['required'],
            'image' => ['required', 'image', 'file', 'max:1024']
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $gallery = Gallery::create([
                'id' => Uuid::uuid4()->toString(),
                'category_id' => $request->category_id,
                'title' => Str::ucfirst($request->title),
                'image' => $request->file('image')->store('gallery')
            ]);
            if (!$gallery->save()) {
                return response()->json(['status' => 0, 'msg' => __('Image Failed to Add')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Image Added Successfully')]);
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $site = SiteInformation::latest()->first();
        $categories = Category::where('site_id', $site->id)->orderBy('name', 'ASC')->get();

        return view('admin.site_management.gallery_management.edit', [
            'categories' => $categories,
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validator = ([
            'category_id' => ['required'],
        ]);

        if (Str::ucfirst($request->title) != Str::ucfirst($gallery->title)) {
            $validator['title'] = ['required', 'string', 'max:255', 'unique:galleries'];
        }
        if ($request->file('image')) {
            $validator['image'] = ['image', 'file', 'max:1024'];
        }
        $validated = Validator::make($request->all(), $validator);

        if (!$validated->passes()) {
            return response()->json(['status' => 0, 'error' => $validated->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {

            $update = ([
                'title' => $request->title,
                'category_id' => $request->category_id,
            ]);

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $update['image'] = $request->file('image')->store('gallery');
            }

            $updating = Gallery::find($gallery->id)->update($update);

            if (!$updating) {
                return response()->json(['status' => 0, 'msg' => __('Image Update Failed')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Image Updated Successfully')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::delete($gallery->image);
        }
        $delete = Gallery::destroy($gallery->id);

        if ($delete) {
            return redirect()->back()->with('success', __('Image Deleted Successfully'));
        } else {
            return redirect()->back()->with('error', __('Image Failed to Delete'));
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids != '') {
            $galleries = Gallery::find($request->ids);
            foreach ($galleries as $gallery) {
                if ($gallery->image) {
                    Storage::delete($gallery->image);
                }
            }
        }

        $delete = Gallery::destroy($request->ids);
        if ($delete) {
            return redirect()->back()->with('success', __('Image Deleted Successfully'));
        } else {
            return redirect()->back()->with('error', __('Image Failed to Delete'));
        }
    }
}
