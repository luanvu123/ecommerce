@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name" id="slug"  onkeyup="ChangeToSlug()">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Đường dẫn:</strong>
                    <input type="text" name="slug" class="form-control" placeholder="Đường dẫn" id="convert_slug">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" class="form-control" placeholder="Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image_product" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Category:</strong>
        <select name="category_id" class="form-control">
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                @if ($category->parent)
                    @continue
                @endif
                <option value="{{ $category->id }}"
                    @if ($category->id == old('category_id'))
                        selected
                    @endif
                >
                    {{ $category->name }}
                </option>
                @if ($category->children)
                    @foreach ($category->children as $child)
                        <option value="{{ $child->id }}"
                            @if ($child->id == old('category_id'))
                                selected
                            @endif
                        >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                        </option>
                    @endforeach
                @endif
            @endforeach
        </select>
    </div>
</div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection


