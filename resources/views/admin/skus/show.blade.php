<!-- resources/views/skus/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Sku Details</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $sku->code }}</h4>
            <p class="card-text">Price: {{ $sku->price }}</p>
            <p class="card-text">Reduced Price: {{ $sku->reduced_price }}</p>
            <p class="card-text">Stock: {{ $sku->stock }}</p>
            <p class="card-text">Status: {{ $sku->status ? 'Display' : 'Do Not Display' }}</p>
            <p class="card-text">Product: {{ $sku->product->name }}</p>
            <p class="card-text">Attribute Options:
                @foreach ($sku->attributeOptions as $option)
                     {{ $option->attribute->name }} {{ $option->value }}
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
        </div>
    </div>
    <a href="{{ route('skus.index') }}" class="btn btn-secondary">Back to Skus</a>
@endsection
