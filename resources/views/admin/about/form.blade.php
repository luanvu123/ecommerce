@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" id="tableevent">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên </th>
                                <th scope="col">email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Lời nhắn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Quản lý</th>
                                <th scope="col">Gửi email</th>
                                <th scope="col">Mới nhất</th>
                            </tr>
                        </thead>
                        <tbody class="order_position">
                            @foreach ($list as $key => $cate)
                                <tr id="{{ $cate->id }}">
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $cate->name_contact }}</td>
                                    <td>{{ $cate->email_contact }}</td>
                                    <td>{{ $cate->phone_contact }}</td>
                                    <td>{{ $cate->address_contact }}</td>
                                    <td>{{ $cate->message_contact }}</td>
                                    <td>
                                        <select id="{{ $cate->id }}" class="about_choose">
                                            @if ($cate->status == 0)
                                                <option value="1">Đã phản hồi email</option>
                                                <option selected value="0">Chưa phản hồi</option>
                                            @else
                                                <option selected value="1">Đã phản hồi email</option>
                                                <option value="0">Chưa phản hồi</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>{{ $cate->created_at }}</td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['about.destroy', $cate->id],
                                            'onsubmit' => 'return confirm("Bạn có chắc muốn xóa?")',
                                        ]) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <button onclick="redirectToEmailPage('{{ $cate->email_contact }}')"
                                            class="btn btn-primary">Gửi Email <i class="fa-solid fa-envelope" style="color: #ffffff;"></i></button>


                                    </td>

                                    <td>
                                        @if ($cate->created_at > \Carbon\Carbon::now()->subHour())
                                            <span class="label label-primary pull-right">new</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToEmailPage(emailContact) {
            window.location.href = "{{ route('admin.about.email') }}?to=" + emailContact
        }
    </script>
@endsection
