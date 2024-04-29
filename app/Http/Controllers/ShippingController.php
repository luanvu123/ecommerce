<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $shippings = Shipping::latest()->paginate(5);

        return view('admin.shipping.index', compact('shippings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            // Các quy tắc xác thực khác tùy thuộc vào yêu cầu của bạn
        ]);

        Shipping::create($request->all());

        return redirect()->route('shippings.index')
                         ->with('success', 'Shipping method created successfully.');
    }

    /**
     * Display the specified resource.
     */
     public function show($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.show', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.edit', compact('shipping'));
    }

    /**
     * Lưu các thay đổi khi chỉnh sửa Shipping.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();

        return redirect()->route('shippings.index')
            ->with('success', 'Shipping deleted successfully');
    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',

        ]);

        $shipping = Shipping::findOrFail($id);
        $shipping->update($request->all());

        return redirect()->route('shippings.index')
        >with('success', 'Shipping updated successfully');
    }
     public function shipping_choose(Request $request)
    {
        $data = $request->all();
        $shipping = Shipping::find($data['id']);
        $shipping->status = $data['trangthai_val'];
        $shipping->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $shipping->save();
    }
}

