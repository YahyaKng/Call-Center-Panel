@extends('layouts.app', ['title' => __('Team Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Teams') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('team.create') }}" class="btn btn-sm btn-primary">{{ __('Add team') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Slug') }}</th>
                                    <th scope="col">{{ __('Team Admin') }}</th>
                                    <th scope="col">{{ __('Max Meal') }}</th>
                                    <th scope="col">{{ __('Max Rest') }}</th>
                                    <th scope="col">{{ __('Queues') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->slug }}</td>
                                        <td>{{ $team->admin_id }}</td>
                                        <td>{{ $team->max_meal_break }}</td>
                                        <td>{{ $team->max_rest_break }}</td>
                                        @if ($team->queues != NULL)
                                            <td>{{ implode(", ", $team->queues) }}</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        <td class="text-right">
                                            @if(auth()->user()->role()->first()->toArray()["role"] != "User")
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('team.destroy', $team) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                                <a class="dropdown-item" href="{{ route('team.edit', $team) }}">{{ __('Edit') }}</a>
                                                            @if(auth()->user()->team()->first()->id != $team->id)
                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this team?") }}') ? this.parentElement.submit() : ''">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            @endif
                                                        </form>    
                                                    </div>
                                                </div>
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <!-- <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if ($team->id != auth()->id())
                                                        <form action="{{ route('team.destroy', $team) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('team.edit', $team) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this team?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $teams->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection