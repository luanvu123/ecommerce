<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('product', 'user')->orderBy('id', 'DESC')->get();
        return view('admin.inventories.index', compact('inventories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create_product($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.inventories.create_product', compact('product'));
    }
    public function create()
    {
        $products = Product::all();
        return view('admin.inventories.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'custom_price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);

        $inventory = new Inventory();
        $inventory->product_id = $validatedData['product_id'];
        $inventory->quantity = $validatedData['quantity'];
        $inventory->note = $validatedData['note'];
        $inventory->price = $validatedData['custom_price'];
        $inventory->total_amount = $validatedData['quantity'] * $validatedData['custom_price'];
        $inventory->user_id = auth()->user()->id;
        $inventory->save();

        return redirect()->route('inventories.index')->with('success', 'Nhập kho thành công.');
    }



    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Xóa kho thành công.');
    }
    public function show(Inventory $inventory)
    {
        return view('admin.inventories.show', compact('inventory'));
    }

    /**
     * Generate PDF for a specific inventory record.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Inventory $inventory)
    {
        $pdf = PDF::loadView('admin.inventories.pdf', compact('inventory'));
        return $pdf->download('inventory.pdf');
    }
}
