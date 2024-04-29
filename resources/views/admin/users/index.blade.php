@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Gender</th>
            <th>Favorite Color</th>
            <th>Avatar</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->favorite_color }}<br>
                    @if ($user->favorite_color)
                        <span class="color-label"
                            style="background-color: {{ $user->favorite_color }}; display: inline-block;
                               padding: 20px 30px;
                               border-radius: 5px;
                               color: #fff;
                               font-weight: bold;">
                        </span>
                    @else
                        Unknown Color
                    @endif

                </td>
                <td>
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="100px">
                    @endif
                </td>
                <td>
                    <select id="{{ $user->id }}"class="user_choose">
                        @if ($user->status == 0)
                            <option value="1">Hoạt động</option>
                            <option selected value="0">Ngừng hoạt động</option>
                        @else
                            <option selected value="1">Hoạt động</option>
                            <option value="0">Ngừng hoạt động</option>
                        @endif
                    </select>
                </td>

                <td>
                    <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->render() !!}
@endsection
