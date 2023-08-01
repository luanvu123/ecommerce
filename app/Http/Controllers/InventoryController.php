<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('product')->orderBy('id', 'DESC')->get();
        return view('admin.inventories.index', compact('inventories'));
    }


    /**
     * Show the form for creating a new resource.
     */
     public function create_product($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.inventories.show', compact('product'));
    }
    public function create()
    {
        $products = Product::all();
        return view('admin.inventories.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        // Create a new Inventory instance
        $inventory = new Inventory();
        $inventory->product_id = $validatedData['product_id'];
        $inventory->quantity = $validatedData['quantity'];
        $inventory->note = $validatedData['note'];
        $inventory->save();

        return redirect()->route('inventories.index')->with('success', 'Nhập kho thành công.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
}
