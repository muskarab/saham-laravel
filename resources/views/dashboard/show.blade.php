@extends('layouts.app')

@section('content')
    @include('layouts.headers.guest')
    
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            @foreach ($emitens as $emiten)
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Show Emiten {{ $emiten->emiten_char }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Char</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Emiten Char" type="text" name="emiten_char" id="emiten_char" value="{{ $emiten->emiten_char }}" disabled>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->perusahaan }}" disabled>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Index</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->index->name }}" disabled>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sektor</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->sektor->name }}" disabled>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nilai EPS</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->eps }}" disabled>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nilai ROE</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->roe }}" disabled>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nilai PER</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->per }}" disabled>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nilai DER</label>
                                <div class="input-group mb-4">
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->der }}" disabled>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <form>
                                    <textarea class="form-control" rows="3" placeholder="Deskripsi" name="deskripsi" id="deskripsi" disabled>{{ $emiten->deskripsi }}</textarea>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
        
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
