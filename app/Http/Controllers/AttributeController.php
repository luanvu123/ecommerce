<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeOption;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function create()
    {
        return view('admin.attributes.create');
    }
    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attributeOptions = AttributeOption::with('attribute')->where('attribute_id', $attribute->id)->get();;
        return view('admin.attributes.show', compact('attribute', 'attributeOptions'));
    }
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.attributes.index', compact('attributes'));
    }
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:attributes',
        ]);

        Attribute::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully.');
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:attributes,name,' . $id,
        ]);

        $attribute->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }
      public function attribute_choose(Request $request)
    {
        $data = $request->all();
        $attribute = Attribute::find($data['id']);
        $attribute->status = $data['trangthai_val'];
        $attribute->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $attribute->save();
    }
}
