@extends('layouts.app')

@section('content')
    @include('layouts.headers.guest')
    
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Users</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add user</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Role</th>
                            <th scope="col">Instrument Saham</th>
                            <th scope="col">Email</th>
                            <th scope="col">Verified</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->date_of_birth }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->instrument_saham->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if ($user->email_verified_at == true)
                                    <td>True</td>
                                @else
                                    <td>False</td>
                                @endif
                                @if ($user->role == "user")
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Update</a>
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this data?')">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
                </div>
    
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
