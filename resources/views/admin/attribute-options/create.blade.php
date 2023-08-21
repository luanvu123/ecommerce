<!-- resources/views/attribute-options/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create Attribute Option</h1>
    <form action="{{ route('attribute-options.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="value">Option Value</label>
            <input type="text" name="value" id="value" class="form-control">
        </div>
        <div class="form-group">
            <label for="attribute_id">Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control">
                @foreach ($attributes as $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
