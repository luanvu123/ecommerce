<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    public function index()
    {
        $posters = Poster::all();
        return view('admin.posters.index', compact('posters'));
    }

    public function create()
    {
        return view('admin.posters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_poster' => 'required',
            'image_poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_poster' => 'required',
        ]);

        if ($request->hasFile('image_poster')) {
            $imagePath = $request->file('image_poster')->store('images', 'public');
        }

        $poster = new Poster;
        $poster->title_poster = $request->input('title_poster');
        $poster->image_poster = $imagePath;
        $poster->description_poster = $request->input('description_poster');
        $poster->status = $request->input('status');
        $poster->large_poster = $request->input('large_poster');
        $poster->save();

        return redirect()->route('posters.index')->with('success', 'Poster created successfully.');
    }

    public function show($id)
    {
        $poster = Poster::find($id);
        return view('admin.posters.show', compact('poster'));
    }

    public function edit($id)
    {
        $poster = Poster::find($id);
        return view('admin.posters.edit', compact('poster'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_poster' => 'required',
            'image_poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_poster' => 'required',
        ]);

        $poster = Poster::find($id);
        $poster->title_poster = $request->input('title_poster');
        $poster->description_poster = $request->input('description_poster');

        if ($request->hasFile('image_poster')) {
            $imagePath = $request->file('image_poster')->store('images', 'public');
            $poster->image_poster = $imagePath;
        }

        $poster->status = $request->input('status');
        $poster->large_poster = $request->input('large_poster');
        $poster->save();

        return redirect()->route('posters.index')->with('success', 'Poster updated successfully.');
    }

    public function destroy($id)
    {
        $poster = Poster::find($id);
        $poster->delete();
        if ($poster->image_poster) {
            Storage::delete($poster->image_poster);
        }

        return redirect()->route('posters.index')->with('success', 'Poster deleted successfully.');
    }
    public function poster_choose(Request $request)
    {
        $data = $request->all();
        $poster = Poster::find($data['id']);
        $poster->status = $data['trangthai_val'];
        $poster->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $poster->save();
    }
    public function large_poster_choose(Request $request)
    {
        $data = $request->all();
        $poster = Poster::find($data['id']);
        $poster->large_poster = $data['large_poster_val'];
        $poster->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $poster->save();
    }
}
