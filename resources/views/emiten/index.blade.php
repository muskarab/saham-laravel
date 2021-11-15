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
                            <h3 class="mb-0">Saham Konvensional</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" class="btn btn-sm btn-primary">Add Emiten Saham</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            {{-- <th scope="col">Perusahaan</th>     --}}
                            <th scope="col">Index</th>
                            <th scope="col">Sektor</th>
                            <th scope="col">EPS</th>
                            <th scope="col">ROE</th>
                            <th scope="col">PER</th>
                            <th scope="col">DER</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konvensionals as $konvensional)
                            <tr>
                                <td scope="row">{{ ++$i }}</td>
                                <td>{{ $konvensional->emiten_char }}</td>
                                {{-- <td>{{ $konvensional->perusahaan }}</td> --}}
                                <td>{{ $konvensional->index->name }}</td>
                                <td>{{ $konvensional->sektor->name }}</td>
                                <td>{{ $konvensional->eps }}</td>
                                <td>{{ $konvensional->roe }}</td>
                                <td>{{ $konvensional->per }}</td>
                                <td>{{ $konvensional->der }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
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
                {{-- {{ $konvensional->links() }} --}}
                </div>
    
            </div>

            
        </div>

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
                            <h3 class="mb-0">Saham Syariah</h3>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="#" class="btn btn-sm btn-primary">Add Emiten Saham Syariah</a> --}}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            {{-- <th scope="col">Perusahaan</th>     --}}
                            <th scope="col">Index</th>
                            <th scope="col">Sektor</th>
                            <th scope="col">EPS</th>
                            <th scope="col">ROE</th>
                            <th scope="col">PER</th>
                            <th scope="col">DER</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($syariahs as $syariah)
                            <tr>
                                <td scope="row">{{ ++$j }}</td>
                                <td>{{ $syariah->emiten_char }}</td>
                                {{-- <td>{{ $syariah->perusahaan }}</td> --}}
                                <td>{{ $syariah->index->name }}</td>
                                <td>{{ $syariah->sektor->name }}</td>
                                <td>{{ $syariah->eps }}</td>
                                <td>{{ $syariah->roe }}</td>
                                <td>{{ $syariah->per }}</td>
                                <td>{{ $syariah->der }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
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
                {{-- {{ $syariah->links() }} --}}
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
