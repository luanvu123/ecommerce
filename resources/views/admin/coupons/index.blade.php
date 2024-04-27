@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <button class="button" type="button" onclick="window.location='{{ route('coupons.create') }}'">
                    <span class="button__text">Add Coupon</span>
                    <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            width="24" xmlns="http://www.w3.org/2000/svg">
                            <line x1="12" x2="12" y1="5" y2="19"></line>
                            <line x1="5" x2="19" y1="12" y2="12"></line>
                        </svg></span>
                </button>
                <br>
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
                                    <label class="switch">
                                        <input type="checkbox" id="couponCheckbox_{{ $coupon->id }}" class="cb"
                                            value="{{ $coupon->status }}" {{ $coupon->status == 1 ? 'checked' : '' }}>
                                        <span class="toggle">
                                            <span class="left">off</span>
                                            <span class="right">on</span>
                                        </span>
                                    </label>
                                </td>
                                <script>
                                    $(document).ready(function() {
                                        $('.cb').change(function() {
                                            var trangthai_val = $(this).is(':checked') ? '1' :
                                                '0'; // Convert checkbox state to '1' or '0'
                                            var id = $(this).attr('id').replace('couponCheckbox_',
                                                ''); // Extract coupon ID from checkbox ID

                                            $.ajax({
                                                url: "{{ route('coupon-choose') }}",
                                                method: "GET",
                                                data: {
                                                    trangthai_val: trangthai_val,
                                                    id: id
                                                },

                                            });
                                        });
                                    });
                                </script>
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
        </div>
    </div>
@endsection
