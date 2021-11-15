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
                            <h3 class="mb-0">Perhitungan</h3>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="{{ route('emiten.create') }}" class="btn btn-sm btn-primary">Add Emiten Saham</a> --}}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-dark">
                    <thead class="thead-dark">
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Index</th>
                            <th scope="col">Min EPS</th>
                            <th scope="col">Max EPS</th>
                            <th scope="col">Mean EPS</th>
                            <th scope="col">Rata-rata Bawah EPS</th>
                            <th scope="col">Rata-rata Atas EPS</th>
                            <th scope="col">Min ROE</th>
                            <th scope="col">Max ROE</th>
                            <th scope="col">Mean ROE</th>
                            <th scope="col">Rata-rata Bawah ROE</th>
                            <th scope="col">Rata-rata Atas ROE</th>
                            <th scope="col">Min PER</th>
                            <th scope="col">Max PER</th>
                            <th scope="col">Mean PER</th>
                            <th scope="col">Rata-rata Bawah PER</th>
                            <th scope="col">Rata-rata Atas PER</th>
                            <th scope="col">Min DER</th>
                            <th scope="col">Max DER</th>
                            <th scope="col">Mean DER</th>
                            <th scope="col">Rata-rata Bawah DER</th>
                            <th scope="col">Rata-rata Atas DER</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($preferensis as $preferensi)
                            <tr>
                                {{-- <td scope="row">{{ ++$i }}</td> --}}
                                <td>{{ $preferensi->index->name }}</td>
                                <td>{{ $preferensi->min_eps }}</td>
                                <td>{{ $preferensi->max_eps }}</td>
                                <td>{{ $preferensi->mean_eps }}</td>
                                <td>{{ $preferensi->avg_bawah_eps }}</td>
                                <td>{{ $preferensi->avg_atas_eps }}</td>
                                <td>{{ $preferensi->min_roe }}</td>
                                <td>{{ $preferensi->max_roe }}</td>
                                <td>{{ $preferensi->mean_roe }}</td>
                                <td>{{ $preferensi->avg_bawah_roe }}</td>
                                <td>{{ $preferensi->avg_atas_roe }}</td>
                                <td>{{ $preferensi->min_per }}</td>
                                <td>{{ $preferensi->max_per }}</td>
                                <td>{{ $preferensi->mean_per }}</td>
                                <td>{{ $preferensi->avg_bawah_per }}</td>
                                <td>{{ $preferensi->avg_atas_per }}</td>
                                <td>{{ $preferensi->min_der }}</td>
                                <td>{{ $preferensi->max_der }}</td>
                                <td>{{ $preferensi->mean_der }}</td>
                                <td>{{ $preferensi->avg_bawah_der }}</td>
                                <td>{{ $preferensi->avg_atas_der }}</td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $konvensional->links() }} --}}
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
