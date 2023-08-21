<!-- resources/views/attribute-options/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Attribute Option</h1>
    <form action="{{ route('attribute-options.update', $option->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="value">Option Value</label>
            <input type="text" name="value" id="value" class="form-control" value="{{ $option->value }}">
        </div>
        <div class="form-group">
            <label for="attribute_id">Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control">
                @foreach ($attributes as $attribute)
                    <option value="{{ $attribute->id }}" {{ $attribute->id === $option->attribute_id ? 'selected' : '' }}>{{ $attribute->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
