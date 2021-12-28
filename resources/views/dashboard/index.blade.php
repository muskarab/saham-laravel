@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Sektor Saham</h5>
                                        {{-- @foreach ($sectors as $sector) --}}
                                            <span class="h2 font-weight-bold mb-0">{{ $sectors->count() }}</span>
                                        {{-- @endforeach --}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Emiten</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $emitens->count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    {{-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last week</span> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Konvensional</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $konvensionals->count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    {{-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span class="text-nowrap">Since yesterday</span> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Syariah</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $syariahs->count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    {{-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span class="text-nowrap">Since last month</span> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt--7">
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sort By Tahun
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($years as $year)
            <a class="dropdown-item" href="dashboard/year/{{ $year->tahun }}">{{ $year->tahun }}</a>
            @endforeach
        </div>
        </div>
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sort By Sektor
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($sectors as $sector)
            <a class="dropdown-item" href="dashboard/sektor/{{ $sector->id }}">{{ $sector->name }}</a>
            @endforeach
        </div>
        </div>
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sort By Top
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="dashboard/top/3">3</a>
            <a class="dropdown-item" href="dashboard/top/5">5</a>
            <a class="dropdown-item" href="dashboard/top/10">10</a>
        </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                @if (Auth::user()->instrument_saham_id == 1)
                 <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Konvensional</h3>
                            </div>
                            <div class="col text-right">
                                {{-- <a href="#!" class="btn btn-sm btn-primary">See all</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Emiten</th>
                                    <th scope="col">Index</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Sektor</th>
                                    <th scope="col">Nilai Rekomendasi</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($final_kons as $final_kon)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $final_kon->emiten_char }}</td>
                                    <td>{{ $final_kon->index }}</td>
                                    <td>{{ $final_kon->tahun }}</td>
                                    <td>{{ $final_kon->sektor }}</td>
                                    <td>{{ $final_kon->vektor_v }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-blue text-blue"></i>
                                            </a>
                                            <form action="" method="POST">
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('dashboard.show', $final_kon->id) }}">Show</a>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @if (Auth::user()->instrument_saham_id == 2)
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Syariah</h3>
                            </div>
                            <div class="col text-right">
                                {{-- <a href="#!" class="btn btn-sm btn-primary">See all</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Emiten</th>
                                    <th scope="col">Index</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Sektor</th>
                                    <th scope="col">Nilai Rekomendasi</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($final_syar as $final_syar)
                                <tr>
                                    <td>{{ ++$j }}</td>
                                    <td>{{ $final_syar->emiten_char }}</td>
                                    <td>{{ $final_syar->index }}</td>
                                    <td>{{ $final_syar->tahun }}</td>
                                    <td>{{ $final_syar->sektor }}</td>
                                    <td>{{ $final_syar->vektor_v }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-blue"></i>
                                            </a>
                                            <form action="" method="POST">
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('dashboard.show', $final_syar->id) }}">Show</a>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @if (Auth::user()->instrument_saham_id == 3)
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Konvensional</h3>
                            </div>
                            <div class="col text-right">
                                {{-- <a href="#!" class="btn btn-sm btn-primary">See all</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Emiten</th>
                                    <th scope="col">Index</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Sektor</th>
                                    <th scope="col">Nilai Rekomendasi</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($final_kons as $final_kon)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $final_kon->emiten_char }}</td>
                                    <td>{{ $final_kon->index }}</td>
                                    <td>{{ $final_kon->tahun }}</td>
                                    <td>{{ $final_kon->sektor }}</td>
                                    <td>{{ $final_kon->vektor_v }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-blue text-blue"></i>
                                            </a>
                                            <form action="" method="POST">
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('dashboard.show', $final_kon->id) }}">Show</a>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Syariah</h3>
                            </div>
                            <div class="col text-right">
                                {{-- <a href="#!" class="btn btn-sm btn-primary">See all</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Emiten</th>
                                    <th scope="col">Index</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Sektor</th>
                                    <th scope="col">Nilai Rekomendasi</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($final_syar as $final_syar)
                                <tr>
                                    <td>{{ ++$j }}</td>
                                    <td>{{ $final_syar->emiten_char }}</td>
                                    <td>{{ $final_syar->index }}</td>
                                    <td>{{ $final_syar->tahun }}</td>
                                    <td>{{ $final_syar->sektor }}</td>
                                    <td>{{ $final_syar->vektor_v }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-blue"></i>
                                            </a>
                                            <form action="" method="POST">
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('dashboard.show', $final_syar->id) }}">Show</a>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush