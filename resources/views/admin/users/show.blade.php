@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-md-4 col-form-label text-md-right">Roles:</label>
                        <div class="col-md-6">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="badge badge-success">{{ $v }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar:</label>
                        <div class="col-md-6">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 100px; height: 100px;">
                            @else
                                <p class="form-control-static">No avatar available</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="favorite_color" class="col-md-4 col-form-label text-md-right">Favorite Color:</label>
                        <div class="col-md-6">
                            @if($user->favorite_color)
                                <div style="width: 100px; height: 100px; background-color: {{ $user->favorite_color }};"></div>
                            @else
                                <p class="form-control-static">N/A</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">Gender:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->gender }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
