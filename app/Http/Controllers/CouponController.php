<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }
    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'limit_per_user' => 'required|integer|min:0',
            'limit_per_coupon' => 'required|integer|min:0',
            'expires_at' => 'required|date',
            'status' => 'required|integer'
        ]);

        Coupon::create($validatedData);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'limit_per_user' => 'required|integer|min:0',
            'limit_per_coupon' => 'required|integer|min:0',
            'expires_at' => 'required|date',
            'status' => 'required|integer'
        ]);

        $coupon->update($validatedData);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
    public function coupon_choose(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::find($data['id']);
        $coupon->status = $data['trangthai_val'];
        $coupon->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $coupon->save();
    }
}
