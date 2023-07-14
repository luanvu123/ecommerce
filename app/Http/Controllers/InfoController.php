<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = Info::find(1);
        return view('admin.info.form', compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $info = Info::findOrFail($id);

        $info->title = $request->input('title');

        // Xử lý và lưu logo1
        if ($request->hasFile('logo1')) {
            $logo1 = $request->file('logo1');
            $logo1Path = $logo1->storeAs('uploads/logo', 'logo1_' . Str::random(10) . '.' . $logo1->getClientOriginalExtension(), 'public');
            $info->logo1 = $logo1Path;
        }

        // Xử lý và lưu logo2
        if ($request->hasFile('logo2')) {
            $logo2 = $request->file('logo2');
            $logo2Path = $logo2->storeAs('uploads/logo', 'logo2_' . Str::random(10) . '.' . $logo2->getClientOriginalExtension(), 'public');
            $info->logo2 = $logo2Path;
        }


        $info->image_login = $request->hasFile('image_login') ? $this->storeImage($request->file('image_login')) : $info->image_login;
        $info->image_sighup = $request->hasFile('image_signup') ? $this->storeImage($request->file('image_signup')) : $info->image_sighup;
        $info->logo_hotdeals = $request->hasFile('logo_hotdeals') ? $this->storeImage($request->file('logo_hotdeals')) : $info->logo_hotdeals;
        $info->title_hotdeals = $request->input('title_hotdeals');
        $info->logo_categories = $request->hasFile('logo_categories') ? $this->storeImage($request->file('logo_categories')) : $info->logo_categories;
        $info->title_categories = $request->input('title_categories');
        $info->title2_categories = $request->input('title2_categories');
        $info->logo_dontmiss = $request->hasFile('logo_dontmiss') ? $this->storeImage($request->file('logo_dontmiss')) : $info->logo_dontmiss;
        $info->title_dontmiss = $request->input('title_dontmiss');
        $info->title2_dontmiss = $request->input('title2_dontmiss');
        $info->logo_thisweek = $request->hasFile('logo_thisweek') ? $this->storeImage($request->file('logo_thisweek')) : $info->logo_thisweek;
        $info->title_thisweek = $request->input('title_thisweek');
        $info->title2_thisweek = $request->input('title2_thisweek');
        $info->logo_mostsold = $request->hasFile('logo_mostsold') ? $this->storeImage($request->file('logo_mostsold')) : $info->logo_mostsold;
        $info->title_mostsold = $request->input('title_mostsold');
        $info->title2_mostsold = $request->input('title2_mostsold');
        $info->logo_whyus = $request->hasFile('logo_whyus') ? $this->storeImage($request->file('logo_whyus')) : $info->logo_whyus;
        $info->title_whyus = $request->input('title_whyus');
        $info->title2_whyus = $request->input('title2_whyus');
        $info->address_store = $request->input('address_store');
        $info->phone_store = $request->input('phone_store');
        $info->email_store = $request->input('email_store');
        $info->careers = $request->input('careers');
        $info->opening_hours = $request->input('opening_hours');
        $info->address_support = $request->input('address_support');
        $info->phone_support = $request->input('phone_support');
        $info->youtube = $request->input('youtube');
        $info->title_download = $request->input('title_download');
        $info->copyright = $request->input('copyright');
        $info->newsletter = $request->input('newsletter');
        $info->title_contact = $request->input('title_contact');
        $info->title2_contact = $request->input('title2_contact');

        $info->save();

         Toastr::info('Cập nhật', 'Cập nhật thông tin thành công.');
         return redirect()->back();
    }

    private function storeImage($file)
    {
        $path = $file->store('uploads/logo', 'public');
        return $path;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        //
    }
}
