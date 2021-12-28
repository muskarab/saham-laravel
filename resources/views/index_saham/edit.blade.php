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
                            <h3 class="mb-0">Add Index Saham</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('index_saham.index') }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('index_saham.update', $indexSaham->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('index_char')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Index Char" type="text" name="index_char" id="index_char" value="{{ $indexSaham->name }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                @error('tahun')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Tahun" type="text" name="tahun" id="tahun" value="{{ $indexSaham->tahun }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">instrument Saham</label>
                                <select class="form-control" id="instrument_id" name="instrument_id">
                                    {{-- @foreach ($instruments as $instrument) --}}
                                    @if ($indexSaham->instrument_saham_id == 1)
                                    <option selected value=1>Konvensional</option>
                                    <option value=2>Syariah</option>
                                    @endif
                                    @if ($indexSaham->instrument_saham_id == 2)
                                    <option value=1>Konvensional</option>
                                    <option selected value=2>Syariah</option>
                                    @endif
                                    {{-- @endforeach --}}
                                </select>
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