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
                            {{-- <a href="#" class="btn btn-sm btn-primary">Add Index Saham</a> --}}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Instrument Saham</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($indexs as $index)
                            <tr>
                                <td scope="row">{{ ++$i }}</td>
                                <td>{{ $index->name }}</td>
                                <td>{{ $index->instrument_saham->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-blue"></i>
                                        </a>
                                        <form action="" method="POST">
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item" href="">Update</a>
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this data?')">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
                </div>
    
            </div>
        </div>
    </div>
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
                            <h3 class="mb-0">Bobot Saham</h3>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="#" class="btn btn-sm btn-primary">Add Index Saham</a> --}}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Instrument Saham</th>
                            <th scope="col">EPS</th>
                            <th scope="col">ROW</th>
                            <th scope="col">PER</th>
                            <th scope="col">DER</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bobots as $bobot)
                            <tr>
                                <td scope="row">{{ ++$j }}</td>
                                <td>{{ $bobot->instrument_saham->name }}</td>
                                <td>{{ $bobot->w_eps }}</td>
                                <td>{{ $bobot->w_roe }}</td>
                                <td>{{ $bobot->w_per }}</td>
                                <td>{{ $bobot->w_der }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-blue"></i>
                                        </a>
                                        <form action="" method="POST">
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item" href="">Update</a>
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this data?')">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
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
