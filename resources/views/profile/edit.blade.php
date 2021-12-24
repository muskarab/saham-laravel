@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('layouts.headers.guest')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('argon') }}/img/theme/team-3-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                        </div>
                    </div>
                    @foreach ($instruments as $instrument)
                    @if (auth()->user()->instrument_saham_id == $instrument->id)
                    <div class="card-body pt-0 pt-md-6">
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light"></span>
                            </h3>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ __('Nilai Bobot Saham') }} {{ $instrument->name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    @if (auth()->user()->instrument_saham_id == 1)
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_eps_kon }}</span>
                                        <span class="description">{{ __('EPS') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_roe_kon }}</span>
                                        <span class="description">{{ __('ROE') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_per_kon }}</span>
                                        <span class="description">{{ __('PER') }}</span>
                                    </div>
                                    @endif
                                    @if (auth()->user()->instrument_saham_id == 2)
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_eps_syar }}</span>
                                        <span class="description">{{ __('EPS') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_roe_syar }}</span>
                                        <span class="description">{{ __('ROE') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_der_syar }}</span>
                                        <span class="description">{{ __('DER') }}</span>
                                    </div>
                                    @endif
                                </div>
                                @if (auth()->user()->instrument_saham_id == 3)
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_eps_kon }}</span>
                                        <span class="description">{{ __('EPS KON') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_roe_kon }}</span>
                                        <span class="description">{{ __('ROE KON') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_per_kon }}</span>
                                        <span class="description">{{ __('PER KON') }}</span>
                                    </div>
                                </div>
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_eps_syar }}</span>
                                        <span class="description">{{ __('EPS SYAR') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_roe_syar }}</span>
                                        <span class="description">{{ __('ROE SYAR') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ auth()->user()->w_der_syar }}</span>
                                        <span class="description">{{ __('DER SYAR') }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Profile') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.edit', auth()->user()->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" disabled required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
                                    <input type="text" address="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" value="{{ old('address', auth()->user()->address) }}" disabled required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('date_of_birth') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date_of_birth">{{ __('Date_of_birth') }}</label>
                                    <input type="text" date_of_birth="date_of_birth" id="input-date_of_birth" class="form-control form-control-alternative{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" placeholder="{{ __('date_of_birth') }}" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}" disabled required autofocus>

                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="text" email="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('email') }}" value="{{ old('email', auth()->user()->email) }}" disabled required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-gender">{{ __('Gender') }}</label>
                                    <input type="text" gender="gender" id="input-gender" class="form-control form-control-alternative{{ $errors->has('gender') ? ' is-invalid' : '' }}" placeholder="{{ __('gender') }}" value="{{ old('gender', auth()->user()->gender) }}" disabled required autofocus>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('preferensi_saham') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-preferensi_saham">{{ __('Preferensi Saham') }}</label>
                                    @foreach ($instruments as $instrument)
                                    @if (auth()->user()->instrument_saham_id == $instrument->id)
                                    <input type="text" preferensi_saham="preferensi_saham" id="input-preferensi_saham" class="form-control form-control-alternative{{ $errors->has('preferensi_saham') ? ' is-invalid' : '' }}" placeholder="{{ __('preferensi_saham') }}" value="{{ old('preferensi_saham', $instrument->name) }}" disabled required autofocus>
                                    @endif
                                    @endforeach
                                    @if ($errors->has('preferensi_saham'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('preferensi_saham') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}

                                {{-- <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div> --}}
                            </div>
                        </form>
                        {{-- <hr class="my-4" /> --}}
                        {{-- <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
