@extends('layouts.app', ['title' => __('Team Management')])

@section('content')
    @include('teams.partials.header', ['title' => __('Add Team')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Team Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('team.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('team.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Team information') }}</h6>
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
                                <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-slug">{{ __('slug') }}</label>
                                    <input type="text" name="slug" id="input-slug" class="form-control form-control-alternative{{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="{{ __('Slug') }}" value="{{ old('slug') }}" required>

                                    @if ($errors->has('slug'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('slug') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('admin_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-admin_id">{{ __('admin_id') }}</label>
                                    <select name="admin_id" id="input-admin_id" class="form-control form-control-alternative{{ $errors->has('admin_id') ? ' is-invalid' : '' }}" placeholder="{{ __('admin_id') }}" value="{{ old('admin_id') }}" >
                                        @if(auth()->user()->role()->first()->role == 'SuperAdmin')
                                            @foreach($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('admin_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('admin_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('max_meal_break') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-max_meal_break">{{ __('max_meal_break') }}</label>
                                    <input type="text" name="max_meal_break" id="input-max_meal_break" class="form-control form-control-alternative{{ $errors->has('max_meal_break') ? ' is-invalid' : '' }}" placeholder="{{ __('max_meal_break') }}" value="{{ old('max_meal_break') }}" required autofocus>

                                    @if ($errors->has('max_meal_break'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('max_meal_break') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('max_rest_break') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-max_rest_break">{{ __('max_rest_break') }}</label>
                                    <input type="text" name="max_rest_break" id="input-max_rest_break" class="form-control form-control-alternative{{ $errors->has('max_rest_break') ? ' is-invalid' : '' }}" placeholder="{{ __('max_rest_break') }}" value="{{ old('max_rest_break') }}" required autofocus>

                                    @if ($errors->has('max_rest_break'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('max_rest_break') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('queues') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-queues">{{ __('queues') }}</label>
                                    one:<input type="checkbox" name="ids[]" value"1" />
                                    two:<input type="checkbox" name="ids[]" value"24" />
                                    three:<input type="checkbox" name="ids[]" value"56" />
                                    four:<input type="checkbox" name="ids[]" value"100" />

                                    @if ($errors->has('queues'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('queues') }}</strong>
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