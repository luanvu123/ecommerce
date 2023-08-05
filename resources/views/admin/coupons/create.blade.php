@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Coupon</h2>
        <form action="{{ route('coupons.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Coupon Code:</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Coupon Type:</label>
                <select name="type" class="form-control" required>
                    <option value="fixed">Fixed</option>
                    <option value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Coupon Value:</label>
                <input type="number" name="value" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="limit_per_user">Limit Per User:</label>
                <input type="number" name="limit_per_user" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="limit_per_coupon">Limit Per Coupon:</label>
                <input type="number" name="limit_per_coupon" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="expires_at">Expires At:</label>
                <input type="datetime-local" name="expires_at" class="form-control" required>
            </div>
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Coupon</button>
        </form>
    </div>
@endsection
