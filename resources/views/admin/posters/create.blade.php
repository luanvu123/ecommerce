@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New poster</h2>
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
    @endif
      @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif


    <form action="{{ route('posters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title_poster" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image_poster" class="form-control-file" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description_poster" class="form-control" rows="5" required></textarea>
        </div>


        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="poster_choose">
                <option value="1">Hiển thị</option>
                <option value="0">Không</option>
            </select>
        </div>
         <div class="form-group">
            <label for="large-poster">Chọn poster</label>
            <select name="large_poster" class="large_poster_choose">
                <option value="1">Poster lớn</option>
                <option value="0">Poster nhỏ</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
