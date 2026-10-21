@extends('Projects.Dashboard.layout.app')
 
@section('title')
@lang('Auth/users.title')
@endsection

@section('css')
@endsection
 
@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/users.title')</h1>
        <!-- <p>Welcome back. Here is what is happening today.</p> -->
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item active">@lang('Auth/users.title')</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div class="justify-content-end">
            <h5>@lang('All.recent_orders')</h5>
            <small>@lang('All.manage_latest_transactions')</small>
        </div>
        <div class="justify-content-end">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>@lang('Auth/users.create')</a>
            <a href="{{ route('users.trash') }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can me-1"></i>@lang('All.trash')</a>
        </div>
        
    </div>

    <div class="custom-datatable p-3">
        <!-- Controls -->
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
                    <span class="input-group-text">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" id="ordersSearch" class="form-control" placeholder="@lang('All.search')">
                </div>
            </div>
        </div>
        
        @include('Projects.Sass.session_fash_messages')
        <!-- Table -->
        <div class="table-responsive">
            <table id="ordersTable" class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th class="sortable" data-column="0">ID <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="1">@lang('Auth/users.image')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="2">@lang('Auth/users.name')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="3">@lang('Auth/users.surname')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="4">@lang('Auth/users.gender')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="5">@lang('Auth/users.username')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="6">@lang('Auth/users.email')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="7">@lang('Auth/users.status')<i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="8">@lang('Auth/users.actions')<i class="fa-solid fa-sort sort-icon"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            @if($user->image)
                                {{-- User Image --}}
                                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="45" height="45" class="rounded-circle" style="width:45px; height:45px; object-fit:cover;">
                            @else
                                {{-- Default Avatar --}}
                                @if($user->gender === 'male')
                                    {{-- Male Avatar --}}
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px; height:45px;"><i class="fa-solid fa-user text-primary"></i></div>

                                @elseif($user->gender === 'female')
                                    {{-- Female Avatar --}}
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px; height:45px;"><i class="fa-solid fa-user text-danger"></i></div>
                                @endif
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>@lang('Auth/users.' . $user->gender)</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('users.status', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn {{ $user->status == 1 ? 'btn-outline-danger' : 'btn-outline-info' }} btn-sm table-action-btn" title="{{ $user->status == 1 ? __('All.disable') : __('All.enable') }}">
                                    <i class="fa-solid {{ $user->status == 1 ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1 flex-nowrap">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-success btn-sm table-action-btn" title="@lang('Auth/users.edit')"><i class="fa-solid fa-pen-to-square"></i></a>
                                {{-- <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-secondary btn-sm table-action-btn" title="@lang('Auth/users.show')"><i class="fa-solid fa-eye"></i></a> --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Auth/users.delete_confirm') }}');">
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

        <!-- Footer -->
        <div class="custom-table-footer mt-3">
            <div id="ordersInfo" class="custom-table-info">
                @lang('All.showing')
                {{ $users->isNotEmpty() ? 1 : 0 }}

                @lang('All.to')
                {{ $users->count() }}

                @lang('All.of')
                {{ $users->count() }}

                @lang('Auth/users.number_active_users')
            </div>
            <!-- <div id="ordersInfo" class="custom-table-info"></div>
            <nav><ul id="ordersPagination" class="pagination pagination-sm mb-0"></ul></nav> -->
        </div>
        
        
    </div>
</section>
@endsection

@section('javascript')
@endsection