@extends('Projects.Dashboard.layout.app')

@section('title', __('Auth/users.view.permissions'))

@section('css')
@endsection

@section('content')
@php
    $selectedRoles = $user->roles->pluck('id')->all();
    $groupedRoles = $roles->groupBy('module');
    $columns = [
        'index' => __('Auth/users.permission_actions.index'),
        'create' => __('Auth/users.permission_actions.create'),
        'edit' => __('Auth/users.permission_actions.edit'),
        'show' => __('Auth/users.permission_actions.show'),
        'delete' => __('Auth/users.permission_actions.delete'),
        'trash' => __('Auth/users.permission_actions.trash'),
        'restore' => __('Auth/users.permission_actions.restore'),
        'force-delete' => __('Auth/users.permission_actions.force_delete'),
        'remove-image' => __('Auth/users.permission_actions.remove_image'),
        'status' => __('Auth/users.permission_actions.status'),
    ];
@endphp

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/users.view.permissions')</h1>
        <p>{{ __('Auth/users.role.manage_permissions_for', ['name' => $user->name.' '.$user->surname]) }}</p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('Auth/users.view.title')</a></li>
            <li class="breadcrumb-item active">@lang('Auth/users.view.permissions')</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('Auth/users.view.permissions')</h5>
            <small>@lang('Auth/users.role.permissions_auto_save')</small>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">@lang('All.back')</a>
    </div>

    <div class="custom-datatable p-3">
        @include('Projects.Sass.session_fash_messages')

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th class="text-nowrap">@lang('Auth/users.view.module_name')</th>
                        @foreach($columns as $label)
                            <th class="text-center text-nowrap">{{ $label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($groupedRoles as $module => $moduleRoles)
                        <tr>
                            <td class="fw-semibold text-nowrap">{{ \Illuminate\Support\Facades\Lang::has('Auth/users.modules.'.$module) ? __('Auth/users.modules.'.$module) : ucfirst($module) }}</td>
                            @foreach($columns as $action => $label)
                                @php
                                    $slug = match (true) {
                                        $action === 'index' && $module === 'admin' => 'admin',
                                        $action === 'index' && $module === 'user' => 'user',
                                        default => $module.'.'.$action,
                                    };
                                    $role = $moduleRoles->firstWhere('slug', $slug);
                                @endphp
                                <td class="text-center">
                                    @if($role)
                                        <form method="POST" action="{{ route('users.roles.update', $user->id) }}" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="role_id" value="{{ $role->id }}">
                                            <input type="hidden" name="enabled" value="0">
                                            <input type="checkbox" name="enabled" value="1" id="role_{{ $role->id }}" class="form-check-input m-0" aria-label="{{ $role->name }}" @checked(in_array($role->id, $selectedRoles)) onchange="this.form.requestSubmit()">
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) + 1 }}" class="text-center text-muted py-4">@lang('Auth/users.role.no_permissions_available')</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection