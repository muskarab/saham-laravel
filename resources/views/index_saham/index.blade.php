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
                            <h3 class="mb-0">Index Saham</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" class="btn btn-sm btn-primary">Add Index Saham</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Instrument Saham</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sahams as $saham)
                            <tr>
                                <td>{{ $saham->name }}</td>
                                <td>{{ $saham->instrument_saham->name }}</td>
                                {{-- @if ($user->role == "user")
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
                                @endif --}}
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
