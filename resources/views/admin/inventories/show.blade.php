<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Quantity for: <b>{{ $product->name }}</b></h2>
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Note (optional):</label>
                <textarea name="note" class="form-control" id="note"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Quantity</button>
        </form>
    </div>
@endsection
