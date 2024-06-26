@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit poster</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posters.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
    @endif

    <form action="{{ route('posters.update', $poster->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title_poster" class="form-control" value="{{ $poster->title_poster }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image_poster" class="form-control-file">
            @if ($poster->image_poster)
                <img src="{{ asset('storage/' . $poster->image_poster) }}" alt="Product Image" style="width: 300px;">
            @endif
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description_poster" class="form-control" rows="5" required>{{ $poster->description_poster }}</textarea>
        </div>

        <div class="form-group">
            <div class="form-group">
                <strong>Status:</strong>
                <select id="{{ $poster->id }}"name="status"class="poster_choose">
                    @if ($poster->status == 0)
                        <option value="1">Hiển thị</option>
                        <option selected value="0">Không</option>
                    @else
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Không</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <strong>Kich thước:</strong>
                <select id="{{ $poster->id }}"name="large_poster"class="large_poster_choose">
                    @if ($poster->large_poster == 0)
                        <option value="1">Lớn</option>
                        <option selected value="0">Nhỏ</option>
                    @else
                        <option selected value="1">Lớn</option>
                        <option value="0">Nhỏ</option>
                    @endif
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('posters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
