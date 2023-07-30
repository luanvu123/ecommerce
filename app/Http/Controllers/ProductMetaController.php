<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
use Carbon\Carbon;

class ProductMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metas = Meta::latest()->paginate(5);
        return view('admin.metas.index', compact('metas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.metas.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'meta_key' => 'required',
            'meta_value' => 'nullable',
            'status'=>'required',
        ]);
        $Meta = new Meta([
            'meta_key' => $request->input('meta_key'),
            'meta_value' => $request->input('meta_value'),
            'status' => $request->input('status'),

        ]);

        // Lưu bản ghi vào cơ sở dữ liệu
        $Meta->save();

        // Chuyển hướng người dùng đến trang danh sách meta và hiển thị thông báo thành công
        return redirect()->route('metas.index')
            ->with('success', 'Meta created successfully.');
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
    public function edit($id)
    {
        $meta = Meta::find($id);
        return view('admin.metas.edit', compact('meta'));
    }

    // Phương thức cập nhật thông tin meta
    public function update(Request $request, $id)
    {
        $request->validate([]);


        $meta = Meta::find($id);
        if (!$meta) {
            return redirect()->route('metas.index')
                ->with('error', 'Meta not found.');
        }

        $meta->meta_key = $request->input('meta_key');
        $meta->meta_value = $request->input('meta_value');
        $meta->status = $request->input('status');
        $meta->save();
        return redirect()->route('metas.index')
            ->with('success', 'Meta updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meta $Meta)
    {
        $Meta->delete();

        return redirect()->route('metas.index')
            ->with('success', 'Meta deleted successfully.');
    }
    public function meta_choose(Request $request)
    {
        $data = $request->all();
        $meta = Meta::find($data['id']);
        $meta->status = $data['trangthai_val'];
        $meta->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $meta->save();
    }
}
