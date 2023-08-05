<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('user')->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email_suppliers' => 'required|email|unique:suppliers,email_suppliers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully.');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email_suppliers' => 'required|email|unique:suppliers,email_suppliers,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $validatedData['name'];
        $supplier->contact_person = $validatedData['contact_person'];
        $supplier->email_suppliers = $validatedData['email_suppliers'];
        $supplier->address = $validatedData['address'];
        $supplier->phone = $validatedData['phone'];
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
    public function supplier_choose(Request $request)
    {
        $data = $request->all();
        $supplier = Supplier::find($data['id']);
        $supplier->status = $data['trangthai_val'];
        $supplier->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $supplier->save();
    }
}
