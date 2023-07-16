@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Policy List</div>

                    <div class="card-body">
                        <a href="{{ route('policies.create') }}" class="btn btn-primary mb-3">Add Policy</a>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="tableevent" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Ảnh Thumnail</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="order_position">
                                @foreach ($policies as $key => $policy)
                                    <tr id="{{ $policy->id }}">
                                        <td>{{ $key }}</td>
                                        <td>{{ $policy->title }}</td>
                                        <td>{{ $policy->description }}</td>
                                        <td>
                                            @if ($policy->image_policies)
                                                <img src="{{ asset('storage/' . $policy->image_policies) }}"
                                                    alt="Policy Image" style="width: 50px;">
                                            @endif
                                        </td>
                                        <td>
                                            <select id="{{ $policy->id }}" class="policy_choose">
                                                @if ($policy->status == 0)
                                                    <option value="1">Hiển thị</option>
                                                    <option selected value="0">Không</option>
                                                @else
                                                    <option selected value="1">Hiển thị</option>
                                                    <option value="0">Không</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('policies.edit', $policy->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('policies.destroy', $policy->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this policy?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
