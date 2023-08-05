@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Coupon</h2>
        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" name="code" class="form-control" value="{{ $coupon->code }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" class="form-control" required>
                    <option value="fixed" {{ $coupon->type === 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percent" {{ $coupon->type === 'percent' ? 'selected' : '' }}>Percent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Value:</label>
                <input type="number" name="value" class="form-control" value="{{ $coupon->value }}" required>
            </div>
            <div class="form-group">
                <label for="limit_per_user">Limit Per User:</label>
                <input type="number" name="limit_per_user" class="form-control" value="{{ $coupon->limit_per_user }}"
                    required>
            </div>
            <div class="form-group">
                <label for="limit_per_coupon">Limit Per Coupon:</label>
                <input type="number" name="limit_per_coupon" class="form-control" value="{{ $coupon->limit_per_coupon }}"
                    required>
            </div>
            <div class="form-group">
                <label for="expires_at">Expires At:</label>
                <input type="datetime-local" name="expires_at" class="form-control" value="{{ $coupon->expires_at }}"
                    required>
            </div>
            <div class="form-group">
                <strong>Status:</strong>
                <select id="{{ $coupon->id }}"name="status"class="coupon_choose">
                    @if ($coupon->status == 0)
                        <option value="1">Hiển thị</option>
                        <option selected value="0">Không</option>
                    @else
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Không</option>
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
