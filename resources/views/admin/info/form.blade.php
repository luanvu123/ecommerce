@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quản Lý Thông tin</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! Form::open(['route' => ['info.update', $info->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $info->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="logo1">Logo 1:</label>
                            <input type="file" name="logo1" id="logo1" class="form-control">
                             @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo1)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="logo2">Logo 2:</label>
                            <input type="file" name="logo2" id="logo2" class="form-control">
                            @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo2)}}">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image_login">Image Login:</label>
                            <input type="file" name="image_login" id="image_login" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image_signup">Image Signup:</label>
                            <input type="file" name="image_signup" id="image_signup" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="logo_hotdeals">Logo Hot Deals:</label>
                            <input type="file" name="logo_hotdeals" id="logo_hotdeals" class="form-control">
                            @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo_hotdeals)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_hotdeals">Title Hot Deals:</label>
                            <input type="text" name="title_hotdeals" id="title_hotdeals" class="form-control"
                                value="{{ $info->title_hotdeals }}">
                        </div>
                        <div class="form-group">
                            <label for="logo_categories">Logo Categories:</label>
                            <input type="file" name="logo_categories" id="logo_categories" class="form-control">
                              @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo_categories)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_categories">Title Categories:</label>
                            <input type="text" name="title_categories" id="title_categories" class="form-control"
                                value="{{ $info->title_categories }}">
                        </div>

                        <div class="form-group">
                            <label for="title2_categories">Title2 Categories:</label>
                            <input type="text" name="title2_categories" id="title2_categories" class="form-control"
                                value="{{ $info->title2_categories }}">
                        </div>

                        <div class="form-group">
                            <label for="logo_dontmiss">Logo Don't Miss:</label>
                            <input type="file" name="logo_dontmiss" id="logo_dontmiss" class="form-control">
                              @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo_dontmiss)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_dontmiss">Title Don't Miss:</label>
                            <input type="text" name="title_dontmiss" id="title_dontmiss" class="form-control"
                                value="{{ $info->title_dontmiss }}">
                        </div>

                        <div class="form-group">
                            <label for="title2_dontmiss">Title2 Don't Miss:</label>
                            <input type="text" name="title2_dontmiss" id="title2_dontmiss" class="form-control"
                                value="{{ $info->title2_dontmiss }}">
                        </div>
                        <div class="form-group">
                            <label for="logo_thisweek">Logo This Week:</label>
                            <input type="file" name="logo_thisweek" id="logo_thisweek" class="form-control">
                              @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo_thisweek)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_thisweek">Title This Week:</label>
                            <input type="text" name="title_thisweek" id="title_thisweek" class="form-control"
                                value="{{ $info->title_thisweek }}">
                        </div>

                        <div class="form-group">
                            <label for="title2_thisweek">Title2 This Week:</label>
                            <input type="text" name="title2_thisweek" id="title2_thisweek" class="form-control"
                                value="{{ $info->title2_thisweek }}">
                        </div>

                        <div class="form-group">
                            <label for="logo_mostsold">Logo Most Sold:</label>
                            <input type="file" name="logo_mostsold" id="logo_mostsold" class="form-control">
                              @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo_mostsold)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_mostsold">Title Most Sold:</label>
                            <input type="text" name="title_mostsold" id="title_mostsold" class="form-control"
                                value="{{ $info->title_mostsold }}">
                        </div>

                        <div class="form-group">
                            <label for="title2_mostsold">Title2 Most Sold:</label>
                            <input type="text" name="title2_mostsold" id="title2_mostsold" class="form-control"
                                value="{{ $info->title2_mostsold }}">
                        </div>

                        <div class="form-group">
                            <label for="logo_whyus">Logo Why Us:</label>
                            <input type="file" name="logo_whyus" id="logo_whyus" class="form-control">
                              @if(isset($info))
                              <img width="150" src="{{asset('storage/' .$info->logo_whyus)}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_whyus">Title Why Us:</label>
                            <input type="text" name="title_whyus" id="title_whyus" class="form-control"
                                value="{{ $info->title_whyus }}">
                        </div>

                        <div class="form-group">
                            <label for="title2_whyus">Title2 Why Us:</label>
                            <input type="text" name="title2_whyus" id="title2_whyus" class="form-control"
                                value="{{ $info->title2_whyus }}">
                        </div>
                         <div class="form-group">
                            <label for="newsletter">newsletter</label>
                            <input type="text" name="newsletter" id="newsletter" class="form-control"
                                value="{{ $info->newsletter }}">
                        </div>
                         <div class="form-group">
                            <label for="title_contact">Title contact1:</label>
                            <input type="text" name="title_contact" id="title_contact" class="form-control"
                                value="{{ $info->title_contact }}">
                        </div>
                         <div class="form-group">
                            <label for="title2_contact">Title contact2:</label>
                            <input type="text" name="title2_contact" id="title2_contact" class="form-control"
                                value="{{ $info->title2_contact }}">
                        </div>

                        <div class="form-group">
                            <label for="address_store">Address Store:</label>
                            <input type="text" name="address_store" id="address_store" class="form-control"
                                value="{{ $info->address_store }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_store">Phone Store:</label>
                            <input type="text" name="phone_store" id="phone_store" class="form-control"
                                value="{{ $info->phone_store }}">
                        </div>

                        <div class="form-group">
                            <label for="email_store">Email Store:</label>
                            <input type="email" name="email_store" id="email_store" class="form-control"
                                value="{{ $info->email_store }}">
                        </div>

                        <div class="form-group">
                            <label for="careers">Careers:</label>
                            <textarea name="careers" id="careers" class="form-control">{{ $info->careers }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="opening_hours">Opening Hours:</label>
                            <textarea name="opening_hours" id="opening_hours" class="form-control">{{ $info->opening_hours }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="address_support">Address Support:</label>
                            <textarea name="address_support" id="address_support" class="form-control">{{ $info->address_support }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone_support">Phone Support:</label>
                            <input type="text" name="phone_support" id="phone_support" class="form-control"
                                value="{{ $info->phone_support }}">
                        </div>

                        <div class="form-group">
                            <label for="youtube">Youtube:</label>
                            <input type="text" name="youtube" id="youtube" class="form-control"
                                value="{{ $info->youtube }}">
                        </div>

                        <div class="form-group">
                            <label for="title_download">Title Download:</label>
                            <input type="text" name="title_download" id="title_download" class="form-control"
                                value="{{ $info->title_download }}">
                        </div>

                        <div class="form-group">
                            <label for="copyright">Copyright:</label>
                            <input type="text" name="copyright" id="copyright" class="form-control"
                                value="{{ $info->copyright }}">
                        </div>
                        {!! Form::submit('Cập Nhật Thông tin', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
