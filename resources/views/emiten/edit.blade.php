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
                            <h3 class="mb-0">Update Emiten</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('emiten.index') }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('emiten.update', $emiten->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('emiten_char')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Emiten Char" type="text" name="emiten_char" id="emiten_char" value="{{ $emiten->emiten_char }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('perusahaan')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Nama Perusahaan" type="text" name="perusahaan" id="perusahaan" value="{{ $emiten->perusahaan }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Index Saham</label>
                                <select class="form-control" id="index_id" name="index_id">
                                    @foreach ($indexs as $index)
                                    @if ($emiten->index_id == $index->id)
                                        <option selected value={{ $index->id }}>{{ $index->name }}</option>
                                    @else
                                    <option value={{ $index->id }}>{{ $index->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sektor Saham</label>
                                <select class="form-control" id="sektor_id" name="sektor_id">
                                    @foreach ($sektors as $sektor)
                                    @if ($emiten->sektor_id == $sektor->id)
                                    <option selected value={{ $sektor->id }}>{{ $sektor->name }}</option>
                                    @else
                                    <option value={{ $sektor->id }}>{{ $sektor->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('eps')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="EPS" type="number" step="any" name="eps" id="eps" value="{{ $emiten->eps }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('roe')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="ROE" type="number" step="any" name="roe" id="roe" value="{{ $emiten->roe }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('per')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="PER" type="decimal" step="any" name="per" id="per" value="{{ $emiten->per }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('der')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="DER" type="number" step="any" name="der" id="der" value="{{ $emiten->der }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                @error('deskripsi')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <form>
                                    <textarea class="form-control" rows="3" placeholder="Deskripsi" name="deskripsi" id="deskripsi">{{ $emiten->deskripsi }}</textarea>
                                </form>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
