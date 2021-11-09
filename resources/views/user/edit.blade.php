@extends('layouts.app')

@section('content')
    @include('layouts.headers.guest')
    
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Add Users</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Name" type="text" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Email" type="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Address" type="text" name="address" value="{{ $user->address }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control datepicker" placeholder="Date of Birth" type="text" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Role</label>
                                @if ($user->role == "admin")
                                <select class="form-control" id="role" name="role">
                                    <option value=admin>Admin</option>
                                    <option value=user>User</option>
                                </select>
                                @else
                                <select class="form-control" id="role" name="role">
                                    <option value=admin>Admin</option>
                                    <option value=user selected>User</option>
                                </select>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
        
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
