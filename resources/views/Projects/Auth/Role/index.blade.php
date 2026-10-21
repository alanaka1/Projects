@extends('Projects.Dashboard.layout.app')
 
@section('title', __('Auth/roles.title'))

@section('css')
@endsection
 
@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/roles.title')</h1>
        <p>@lang('Auth/roles.empty.no_roles')</p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item active">@lang('Auth/roles.title')</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('All.recent_orders')</h5>
            <small>@lang('All.manage_latest_transactions')</small>
        </div>

        <div class="justify-content-end">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>@lang('Auth/roles.buttons.create')</a>
            <a href="{{ route('roles.trash') }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can me-1"></i>@lang('All.trash')</a>
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
                        <th class="sortable" data-column="1">@lang('Auth/roles.fields.name') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="2">@lang('Auth/roles.fields.slug') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="3">@lang('Auth/roles.fields.module') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="4">@lang('Auth/roles.fields.status') <i class="fa-solid fa-sort sort-icon"></i></th>
                        <th class="sortable" data-column="5">@lang('Auth/roles.fields.action') <i class="fa-solid fa-sort sort-icon"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td class="fw-semibold">{{ $role->name }}</td>
                        <td><code>{{ $role->slug }}</code></td>
                        <td>{{ $role->module }}</td>
                        <!-- <td>{{ $role->action }}</td> -->
                        <td>
                            {{-- Change Status --}}
                            <form action="{{ route('roles.status', $role->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $role->status == 1 ? 'btn-outline-danger' : 'btn-outline-info' }} table-action-btn" title="{{ $role->status == 1 ? __('Auth/roles.buttons.deactivate') : __('Auth/roles.buttons.activate') }}">
                                    <i class="fa-solid {{ $role->status == 1 ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                                </button>
                            </form>
                            <!-- <td>
                                @if ($role->status == 1)
                                    <span class="badge bg-success">@lang('Auth/roles.status.active')</span>
                                @else
                                    <span class="badge bg-secondary">@lang('Auth/roles.status.inactive')</span>
                                @endif
                            </td> -->
                        </td>
                        <!-- <td>{{ $role->created_at?->format('Y-m-d') }}</td> -->
                        <td>
                            <div class="d-flex justify-content-center flex-wrap gap-1">
                                {{-- Show --}}
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-secondary btn-sm table-action-btn" title="@lang('Auth/roles.buttons.show')"><i class="fa-solid fa-eye"></i></a>
                                {{-- Edit --}}
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-success btn-sm table-action-btn" title="@lang('Auth/roles.buttons.edit')"><i class="fa-solid fa-pen-to-square"></i></a>
                                

                                {{-- Delete --}}
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ __('Auth/roles.confirm.delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger table-action-btn" title="@lang('All.trash')"><i class="fa-solid fa-trash-can"></i></button>
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
                {{ $roles->isNotEmpty() ? 1 : 0 }}

                @lang('All.to')
                {{ $roles->count() }}

                @lang('All.of')
                {{ $roles->count() }}

                @lang('Auth/roles.number_of_roles')
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection