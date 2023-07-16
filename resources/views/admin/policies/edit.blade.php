@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Policy</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('policies.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('policies.update', $policy->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $policy->title }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ $policy->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="image_policies">Image</label>
            <input type="file" class="form-control-file" id="image_policies" name="image_policies">
             @if ($policy->image_policies)
                                <img src="{{ asset('storage/' . $policy->image_policies) }}" alt="Product Image"
                                    style="width: 50px;">
                            @endif
        </div>

        <div class="form-group">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <select id="{{ $policy->id }}"name="status"class="policy_choose">
                                @if ($policy->status == 0)
                                    <option value="1">Hiển thị</option>
                                    <option selected value="0">Không</option>
                                @else
                                    <option selected value="1">Hiển thị</option>
                                    <option value="0">Không</option>
                                @endif
                            </select>
                        </div>
                    </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('policies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
