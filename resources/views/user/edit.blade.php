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
                            <h3 class="mb-0">Edit User {{ $user->name }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            @if ($user->role == "admin")
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Back</a>
                            @else
                            <a href="{{ route('emiten.index') }}" class="btn btn-sm btn-primary">Back</a>
                            @endif
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
                            {{-- <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" placeholder="Date of Birth" type="text" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                </div>
                            </div>
                            </div> --}}
                        </div>
                        @if (Auth::user()->role == "admin")
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value=admin>Admin</option>
                                    <option value=user>User</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="staticEmail" class="">Preferensi Saham</label>
                                <select class="form-control" id="instrument" name="instrument">
                                    @foreach ($instruments as $instrument)
                                        @if ($user->instrument_saham_id == $instrument->id)
                                        <option value={{ $instrument->id }} selected>(Selected){{ $instrument->name }}</option>
                                        @else
                                        <option value={{ $instrument->id }}>{{ $instrument->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="staticEmail" class="">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    @if ($user->gender == "laki-laki")
                                    <option value='laki-laki'>Laki-Laki</option>
                                    <option value='perempuan'>Perempuan</option>
                                    @else
                                    <option value='perempuan'>Perempuan</option>
                                    <option value='laki-laki'>Laki-Laki</option>
                                    @endif
                                </select>
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
