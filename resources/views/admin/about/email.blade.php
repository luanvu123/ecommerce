@extends('layouts.app')

@section('content')
    <div class="main-page compose">
        <h2 class="title1">Compose Mail Page</h2>
        <div class="col-md-4 compose-left">
            <div class="folder widget-shadow">
                <ul>
                    <li class="head">Folders</li>
                    <li><a href="{{ route('about.create') }}"><i class="fa fa-inbox"></i>Inbox </a></li>
                    <li><a href="{{ route('about.sent') }}"><i class="fa fa fa-envelope-o"></i>Sent </a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 compose-right widget-shadow">
            <div class="panel-default">
                <div class="panel-heading">
                    Compose New Message
                </div>
                <div class="panel-body">
                    <div class="alert alert-info">
                        Please fill details to send a new message
                    </div>
                    <form class="com-mail" method="POST" action="{{ route('send-email') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            {!! Form::email('emailContact', isset($to) ? $to : '', [
                                'class' => 'form-control',
                                'placeholder' => 'To:',
                                'required' => 'required',
                            ]) !!}

                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject:" required>
                        </div>
                        <div class="form-group">
                            <textarea rows="6" class="form-control" name="message" placeholder="Message:" required></textarea>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-paperclip"></i> Attachment
                            {!! Form::file('attachment', ['class' => 'form-control-file']) !!}
                            <p class="help-block">Max. 32MB</p>
                        </div>
                        <input type="submit" value="Send Message" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection
