@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
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

    <form action="{{ route('categories.update', $category->id) }}" method="POST"enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control"
                        placeholder="Name" id="slug" onkeyup="ChangeToSlug()">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Đường dẫn:</strong>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control"
                        placeholder="Đường dẫn" id="convert_slug">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Icon:</strong>
                    @if ($category->icon)
                        <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon" class="img-thumbnail">
                    @else
                        <p>No icon available.</p>
                    @endif
                    <input type="file" name="icon" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent Category:</strong>
                    <select name="parent_id" class="form-control">
                        @foreach ($parentCategories as $id => $name)
                            <option value="{{ $id }}" {{ $category->parent_id == $id ? 'selected' : '' }}>
                                {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select id="{{ $category->id }}"class="cate_choose">
                        @if ($category->status == 0)
                            <option value="1">Hiển thị</option>
                            <option selected value="0">Không</option>
                        @else
                            <option selected value="1">Hiển thị</option>
                            <option value="0">Không</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
