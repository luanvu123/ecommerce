@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Supplier</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('suppliers.index') }}"> Back</a>
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

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
        </div>
        <div class="form-group">
            <label for="contact_person">Contact Person:</label>
            <input type="text" class="form-control" id="contact_person" name="contact_person"
                value="{{ $supplier->contact_person }}" required>
        </div>
         <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $supplier->address }}" required>
            </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email_suppliers" name="email_suppliers" value="{{ $supplier->email_suppliers }}"
                required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $supplier->phone }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
