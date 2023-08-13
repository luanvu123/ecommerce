@extends('layouts.app')

@section('content')
    <div class="container">
         @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Xuất kho: <b>{{ $product->name }}</b></h2>
        <form action="{{ route('outgoing_products.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control">
            </div>
             <div class="form-group">
                <label for="supplier_id">Chọn nhà phân phối:</label>
                <select name="supplier_id" class="form-control">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="note">Note (optional):</label>
                <textarea name="note" class="form-control" id="note"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">XUất</button>
        </form>
    </div>
@endsection
