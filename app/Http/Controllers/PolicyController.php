<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::all();
        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.policies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image_policies' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $policy = new Policy();

        if ($request->hasFile('image_policies')) {
            $imagePath = $request->file('image_policies')->store('images', 'public');
            $policy->image_policies = $imagePath;
        }

        $policy->title = $request->input('title');
        $policy->description = $request->input('description');
        $policy->status = $request->input('status', true);

        $policy->save();

        return redirect()->route('policies.index')
            ->with('success', 'Policy created successfully');
    }


    public function show($id)
    {
        $policy = Policy::find($id);
        return view('admin.policies.show', compact('policy'));
    }

    public function edit($id)
    {
        $policy = Policy::find($id);
        return view('admin.policies.edit', compact('policy'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image_policies' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'nullable|boolean',
    ]);

    $policy = Policy::findOrFail($id);
    $policy->title = $request->input('title');
    $policy->description = $request->input('description');
    $policy->status = $request->input('status');

    if ($request->hasFile('image_policies')) {
        // Xử lý lưu và cập nhật ảnh
        $imagePath = $request->file('image_policies')->store('images', 'public');
        $policy->image_policies = $imagePath;
    }

    $policy->save();

    return redirect()->route('policies.index')->with('success', 'Policy updated successfully.');
}


    public function destroy($id)
    {
        $policy = Policy::find($id);
        // Xóa tệp tin image_policies nếu tồn tại
    if ($policy->image_policies) {
        Storage::delete($policy->image_policies);
    }
        $policy->delete();
        return redirect()->route('policies.index')->with('success', 'Policy deleted successfully.');
    }
     public function policy_choose(Request $request)
    {
        $data = $request->all();
        $policy = policy::find($data['id']);
        $policy->status = $data['trangthai_val'];
        $policy->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $policy->save();
    }
}
