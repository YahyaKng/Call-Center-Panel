@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add User')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="" required>
                                </div>
                                <div class="form-group{{ $errors->has('line') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-line">{{ __('Line') }}</label>
                                    <input type="text" name="line" id="input-line" class="form-control form-control-alternative{{ $errors->has('line') ? ' is-invalid' : '' }}" placeholder="{{ __('line') }}" value="{{ old('line') }}" required autofocus>

                                    @if ($errors->has('line'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('line') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-role_id">{{ __('Role') }}</label>
                                    <select name="role_id" id="input-role_id" class="form-control form-control-alternative{{ $errors->has('role_id') ? ' is-invalid' : '' }}" placeholder="{{ __('role_id') }}" value="{{ old('role_id') }}" >
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{ $role->role }}</option>
                                    @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('team_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-team_id">{{ __('Team') }}</label>
                                    <!-- <input type="text" name="team_id" id="input-team_id" class="form-control form-control-alternative{{ $errors->has('team_id') ? ' is-invalid' : '' }}" placeholder="{{ __('team_id') }}" value="{{ old('team_id') }}" required autofocus> -->
                                    <select name="team_id" id="input-team_id" class="form-control form-control-alternative{{ $errors->has('team_id') ? ' is-invalid' : '' }}" placeholder="{{ __('team_id') }}" value="{{ old('team_id') }}" >
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}">{{ $team->name }}</option>
                                    @endforeach
                                    </select>
                                    @if ($errors->has('team_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('team_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection