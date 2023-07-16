@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Policy</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('policies.index') }}"> Back</a>
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

    <form action="{{ route('policies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="image_policies">Image</label>
        <input type="file" name="image_policies" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="trangthai_choose">
            <option value="1">Hiển thị</option>
            <option value="0">Không</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection
