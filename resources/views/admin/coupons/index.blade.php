@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Coupons</h2>
        <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-2">Create Coupon</a>
        <table class="table" id="tableevent">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Limit Per User</th>
                    <th>Limit Per Coupon</th>
                    <th>Expires At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td>
                            @if ($coupon->type === 'fixed')
                                {{ number_format($coupon->value, 0, ',', '.') }} VNĐ
                            @else
                                {{ $coupon->value }} %
                            @endif
                        </td>

                        <td>{{ $coupon->limit_per_user }}</td>
                        <td>{{ $coupon->limit_per_coupon }}</td>
                        <td>{{ $coupon->expires_at }}</td>

                        <td>
                            <select id="{{ $coupon->id }}"name="status"class="coupon_choose">
                                @if ($coupon->status == 0)
                                    <option value="1">Hiển thị</option>
                                    <option selected value="0">Không</option>
                                @else
                                    <option selected value="1">Hiển thị</option>
                                    <option value="0">Không</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-primary"> <img
                                    src="{{ asset('backend/images/3671905_show_view_icon.svg') }}" alt="Google"
                                    width="15" height="15"></a>
                            <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this coupon?')">
                                 <img src="{{ asset('backend/images/185090_delete_garbage_icon.svg') }}"
                                                    alt="Google" width="15" height="15"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
