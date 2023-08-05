@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Supplier Details</h2>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $supplier->name }}</h4>
                <p class="card-text"><strong>Contact Person:</strong> {{ $supplier->contact_person }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $supplier->email_suppliers }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $supplier->address }}</p>
                <p class="card-text"><strong>Phone:</strong> {{ $supplier->phone }}</p>
            </div>
        </div>
    </div>
@endsection
