<?php

namespace App\Http\Controllers\Admin;

use App\Models\FAQ;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SiteInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FAQManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = SiteInformation::latest()->first();
        $faqs = FAQ::where('site_id', $site->id)->orderBy('created_at', 'DESC')->get();

        return view('admin.site_management.faq_management.index', [
            'faqs' => $faqs
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
            'title' => ['required', 'string', 'max:255', 'unique:f_a_q_s'],
            'description' => ['required', 'string', 'min:20'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $site = SiteInformation::latest()->first();
            $store = FAQ::create([
                'id' => Uuid::uuid4()->toString(),
                'site_id' => $site->id,
                'title' => Str::ucfirst($request->title),
                'description' => $request->description,
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Somethin went Wrong, creating F.A.Q')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('FAQ Created Successfully')]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq = FAQ::where('id', $id)->first();

        if ($request->title != $faq->title) {
            $validator = Validator::make($request->all(), [
                // 'title' => ['required', 'string', 'max:255', 'unique:f_a_q_s', 'alpha_num'],
                'title' => ['required', 'string', 'max:255', 'unique:f_a_q_s'],
                'description' => ['required', 'string', 'min:20'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'min:20'],
            ]);
        }
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $update = FAQ::find($faq->id)->update([
                'title' => Str::ucfirst($request->title),
                'description' => $request->description,
            ]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => __('F.A.Q edited successfully')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('F.A.Q failed to edit')]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = FAQ::where('id', $id)->first();

        $delete = FAQ::destroy($faq->id);
        if ($delete) {
            return redirect()->back()->with('success', __('F.A.Q successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('F.A.Q failed to delete'));
        }
    }

    public function deleteAll(Request $request)
    {
        $delete = FAQ::destroy($request->ids);
        if ($delete) {
            return redirect()->back()->with('success', __('F.A.Q successfully deleted'));
        } else {
            return redirect()->back()->with('error', __('F.A.Q failed to delete'));
        }
    }
}
