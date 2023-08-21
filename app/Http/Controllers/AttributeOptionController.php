<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeOptionController extends Controller
{
    public function index()
    {
        $attributeOptions = AttributeOption::with('attribute')->get();
        return view('admin.attribute-options.index', compact('attributeOptions'));
    }
    public function create()
    {
        $attributes = Attribute::all();
        return view('admin.attribute-options.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|unique:attribute_options',
            'attribute_id' => 'required|exists:attributes,id',
        ]);

        AttributeOption::create([
            'attribute_id' => $request->input('attribute_id'),
            'value' => $request->input('value'),
        ]);

        return redirect()->route('attribute-options.show', $request->input('attribute_id'))->with('success', 'Attribute Option created successfully.');
    }
    public function destroy($id)
    {
        $option = AttributeOption::findOrFail($id);
        $option->delete();

        return redirect()->route('attribute-options.index')->with('success', 'Attribute Option deleted successfully.');
    }
    public function show($id)
    {
        $option = AttributeOption::with('attribute')->findOrFail($id);
        return view('admin.attribute-options.show', compact('option'));
    }
    public function edit($id)
    {
        $option = AttributeOption::findOrFail($id);
        $attributes = Attribute::all();
        return view('admin.attribute-options.edit', compact('option', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $option = AttributeOption::findOrFail($id);

        $request->validate([
            'value' => 'required|unique:attribute_options,value,' . $id,
            'attribute_id' => 'required|exists:attributes,id',
        ]);

        $option->update([
            'attribute_id' => $request->input('attribute_id'),
            'value' => $request->input('value'),
        ]);

        return redirect()->route('attribute-options.index')->with('success', 'Attribute Option updated successfully.');
    }
}
