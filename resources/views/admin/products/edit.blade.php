@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                        placeholder="Name" id="slug" onkeyup="ChangeToSlug()">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Đường dẫn:</strong>
                    <input type="text" name="slug" value="{{ $product->slug }}" class="form-control"
                        placeholder="Đường dẫn" id="convert_slug">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id === $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                        placeholder="Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Giá giảm:</strong>
                    <input type="text" name="reduced_price" value="{{ $product->reduced_price }}" class="form-control"
                        placeholder="reduced_price">
                    @error('reduced_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image_product" class="form-control-file">
                    @if ($product->image_product)
                        <img src="{{ asset('storage/' . $product->image_product) }}" alt="Product Image"
                            style="width: 200px;">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hot Deals:</strong>
                    <input type="checkbox" name="hot_deals" value="1" {{ $product->hot_deals ? 'checked' : '' }}>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image Product 2:</strong>
                    <input type="file" name="image_product2" class="form-control-file">
                    @if ($product->image_product2)
                        <img src="{{ asset('storage/' . $product->image_product2) }}" alt="Product Image 2"
                            style="width: 200px;">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image Product 3:</strong>
                    <input type="file" name="image_product3" class="form-control-file">
                    @if ($product->image_product3)
                        <img src="{{ asset('storage/' . $product->image_product3) }}" alt="Product Image 3"
                            style="width: 200px;">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image Product 4:</strong>
                    <input type="file" name="image_product4" class="form-control-file">
                    @if ($product->image_product4)
                        <img src="{{ asset('storage/' . $product->image_product4) }}" alt="Product Image 4"
                            style="width: 200px;">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image Product 5:</strong>
                    <input type="file" name="image_product5" class="form-control-file">
                    @if ($product->image_product5)
                        <img src="{{ asset('storage/' . $product->image_product5) }}" alt="Product Image 5"
                            style="width: 200px;">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <input type="checkbox" name="status" value="1" {{ $product->status ? 'checked' : '' }}>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
