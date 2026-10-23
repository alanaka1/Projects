@extends('Projects.Dashboard.layout.app')

@section('title', __('Auth/users.view.title'))

@section('css')
@endsection

@section('content')
<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/users.view.title')</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item active">@lang('Auth/users.view.title')</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('Auth/users.view.title')</h5>
            <small>@lang('Auth/users.index.manage_users')</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>@lang('Auth/users.view.create')</a>
            <a href="{{ route('users.trash') }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can me-1"></i>@lang('All.trash')</a>
        </div>
    </div>

    <div class="custom-datatable p-3">
        <div class="custom-table-toolbar mb-3">
            <div class="custom-table-length">
                <label for="ordersLength">@lang('All.show')</label>
                <select id="ordersLength" class="form-select form-select-sm">
                    @include('Projects.Dashboard.include.ordersLength')
                </select>
                <span>@lang('All.entries')</span>
            </div>
            <div class="custom-table-search">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" id="ordersSearch" class="form-control" placeholder="@lang('All.search')">
                </div>
            </div>
        </div>

        @include('Projects.Sass.session_fash_messages')

        <div class="table-responsive">
            <table id="ordersTable" class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th class="sortable" data-column="0">@lang('Auth/users.view.id') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="1">@lang('Auth/users.view.image') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="2">@lang('Auth/users.view.name') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="3">@lang('Auth/users.view.surname') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="4">@lang('Auth/users.view.gender') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="5">@lang('Auth/users.view.username') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="6">@lang('Auth/users.view.email') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="7">@lang('Auth/users.view.status') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="8">@lang('Auth/users.view.actions') <i class="fa-solid fa-sort sort-icon"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="45" height="45" class="rounded-circle" style="object-fit:cover;">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px;height:45px;"><i class="fa-solid fa-user {{ $user->gender === 'female' ? 'text-danger' : 'text-primary' }}"></i></div>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>@lang('Auth/users.view.'.$user->gender)</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('users.status', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $user->status ? 'btn-outline-danger' : 'btn-outline-info' }} btn-sm table-action-btn" title="{{ $user->status ? __('All.disable') : __('All.enable') }}">
                                        <i class="fa-solid {{ $user->status ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1 flex-nowrap">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-success btn-sm table-action-btn" title="@lang('Auth/users.view.edit')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-secondary btn-sm table-action-btn" title="@lang('Auth/users.view.show')"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('users.role', $user->id) }}" class="btn btn-outline-dark btn-sm table-action-btn" title="@lang('Auth/users.view.permissions')"><i class="fa-solid fa-user-lock"></i></a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm({{ Illuminate\Support\Js::from(__('Auth/users.index.delete_confirm')) }});">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm table-action-btn" title="@lang('All.trash')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="custom-table-footer mt-3">
            <div id="ordersInfo" class="custom-table-info">
                @lang('All.showing') {{ $users->isNotEmpty() ? 1 : 0 }}
                @lang('All.to') {{ $users->count() }}
                @lang('All.of') {{ $users->count() }}
                @lang('Auth/users.index.users_count')
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection