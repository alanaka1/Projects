
@extends('Projects.Dashboard.layout.app')

@section('title', __('Auth/roles.trash_title'))

@section('css')
@endsection

@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

    <div>
        <h1>@lang('Auth/roles.trash_title')</h1>
        <p>@lang('Auth/roles.trash_subtitle')</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">@lang('Auth/roles.title')</a></li>
            <li class="breadcrumb-item active">@lang('All.trash')</li>
        </ol>
    </nav>

</div>

<section class="dashboard-card mb-4">

    <div class="card-header-custom flex-wrap gap-3">

        <div>
            <h5>@lang('Auth/roles.trash_title')</h5>
            <!-- <small>Manage deleted roles</small> -->
        </div>

        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>@lang('Auth/roles.title')</a>

    </div>

    <div class="custom-datatable p-3">

        <!-- Controls -->
        <div class="custom-table-toolbar mb-3">
            <div class="custom-table-length">
                <label for="rolesTrashLength">@lang('All.show')</label>

                <select id="rolesTrashLength" class="form-select form-select-sm">
                    @include('Projects.Dashboard.include.ordersLength')
                </select>

                <span>@lang('All.entries')</span>
            </div>

            <div class="custom-table-search">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" id="rolesTrashSearch" class="form-control" placeholder="@lang('All.search')">
                </div>
            </div>
        </div>

        @include('Projects.Sass.session_fash_messages')

        <!-- Table -->
        <div class="table-responsive">
            <table id="rolesTrashTable" class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>@lang('Auth/roles.fields.name')</th>
                        <th>@lang('Auth/roles.fields.slug')</th>
                        <th>@lang('Auth/roles.fields.module')</th>
                        <th>@lang('Auth/roles.fields.action')</th>
                        <th>@lang('Auth/roles.fields.status')</th>
                        <th>@lang('All.deleted_at')</th>
                        <th>@lang('Auth/roles.buttons.delete')</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td class="fw-semibold">{{ $role->name }}</td>
                        <td><code>{{ $role->slug }}</code></td>
                        <td>{{ $role->module }}</td>
                        <td>{{ $role->action }}</td>
                        <td>
                            @if($role->status == 1)
                                <span class="badge bg-success">@lang('Auth/roles.status.active')</span>
                            @else
                                <span class="badge bg-secondary">@lang('Auth/roles.status.inactive')</span>
                            @endif
                        </td>
                        <td>{{ $role->deleted_at }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1 flex-nowrap">

                                {{-- Restore --}}
                                <form action="{{ route('roles.restore', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Auth/roles.confirm.restore') }}');">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm table-action-btn" title="@lang('Auth/roles.buttons.restore')"><i class="fa-solid fa-trash-arrow-up"></i></button>
                                </form>

                                {{-- Force Delete --}}
                                <form action="{{ route('roles.force-destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Auth/roles.confirm.force_delete') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm table-action-btn" title="@lang('Auth/roles.buttons.force_delete')"><i class="fa-solid fa-trash-can"></i></button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <div class="py-4">
                                <i class="fa-solid fa-trash-can fa-2x mb-2"></i>
                                <p class="mb-0">@lang('Auth/roles.empty.no_deleted_roles')</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="custom-table-footer mt-3">
            <div class="custom-table-info">
                @lang('All.showing')
                {{ $roles->isNotEmpty() ? 1 : 0 }}

                @lang('All.to')
                {{ $roles->count() }}

                @lang('All.of')
                {{ $roles->count() }}

                @lang('Auth/roles.title')
            </div>

            <!-- <nav>{//{ $roles->links() }}</nav> -->
        </div>

    </div>

</section>

@endsection

@section('javascript')
@endsection
