@extends('Projects.Dashboard.layout.app')

@section('title', __('Auth/users.view.show'))

@section('css')
@endsection

@section('content')
<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/users.view.show')</h1>
        <p>{{ $user->name }} {{ $user->surname }}</p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('Auth/users.view.title')</a></li>
            <li class="breadcrumb-item active">@lang('Auth/users.view.show')</li>
        </ol>
    </nav>
</div>

@include('Projects.Sass.session_fash_messages')

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('Auth/users.show.user_information')</h5>
            <small>@lang('Auth/users.show.account_information')</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            @if(auth()->user()?->hasAnyRole(['admin', 'users.edit']))
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square me-1"></i>@lang('All.update')</a>
            @endif
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>@lang('All.back')</a>
        </div>
    </div>

    <div class="p-3 p-md-4">
        <div class="d-flex align-items-center gap-3 mb-4">
            @if($user->image)
                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="80" height="80" class="rounded-circle" style="object-fit:cover;">
            @else
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:80px;height:80px;">
                    <i class="fa-solid fa-user fs-2 {{ $user->gender === 'female' ? 'text-danger' : 'text-primary' }}"></i>
                </div>
            @endif
            <div>
                <h5 class="mb-1">{{ $user->name }} {{ $user->surname }}</h5>
                <div class="text-muted mb-2">{{ $user->username }}</div>
                <span class="badge {{ $user->status ? 'bg-success' : 'bg-secondary' }}">{{ $user->status ? __('Auth/users.view.active') : __('Auth/users.view.inactive') }}</span>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.view.name')</small>
                    <span class="fw-semibold">{{ $user->name }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.view.surname')</small>
                    <span class="fw-semibold">{{ $user->surname }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.view.username')</small>
                    <span class="fw-semibold">{{ $user->username }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.view.gender')</small>
                    <span class="fw-semibold">{{ match ($user->gender) { 'male' => __('Auth/users.view.male'), 'female' => __('Auth/users.view.female'), default => '—' } }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.view.email')</small>
                    <span class="fw-semibold text-break">{{ $user->email }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.show.created_at')</small>
                    <span class="fw-semibold">{{ $user->created_at?->format('Y-m-d H:i') ?? '—' }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted d-block mb-1">@lang('Auth/users.show.updated_at')</small>
                    <span class="fw-semibold">{{ $user->updated_at?->format('Y-m-d H:i') ?? '—' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('Auth/users.view.permissions')</h5>
            <small>@lang('Auth/users.show.assigned_permissions')</small>
        </div>
        <span class="badge bg-primary">{{ $user->roles->count() }}</span>
    </div>

    <div class="p-3">
        @if($user->hasRole('admin'))
            <div class="alert alert-info mb-3"><i class="fa-solid fa-shield-halved me-1"></i>@lang('Auth/users.show.admin_permissions_notice')</div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th>@lang('Auth/users.show.permission_name')</th>
                        <th>@lang('Auth/users.show.permission_slug')</th>
                        <th>@lang('Auth/users.view.module_name')</th>
                        <th>@lang('Auth/users.show.permission_action')</th>
                        <th>@lang('Auth/users.view.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->roles as $role)
                        <tr>
                            <td>
                                <span class="fw-semibold d-block">{{ $role->name }}</span>
                                @if($role->description)
                                    <small class="text-muted">{{ $role->description }}</small>
                                @endif
                            </td>
                            <td><span class="text-nowrap">{{ $role->slug }}</span></td>
                            <td>{{ \Illuminate\Support\Facades\Lang::has('Auth/users.modules.'.$role->module) ? __('Auth/users.modules.'.$role->module) : $role->module }}</td>
                            <td>{{ \Illuminate\Support\Facades\Lang::has('Auth/users.permission_actions.'.str_replace('-', '_', $role->action)) ? __('Auth/users.permission_actions.'.str_replace('-', '_', $role->action)) : $role->action }}</td>
                            <td><span class="badge {{ $role->status ? 'bg-success' : 'bg-secondary' }}">{{ $role->status ? __('Auth/users.show.permission_enabled') : __('Auth/users.show.permission_disabled') }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">@lang('Auth/users.show.no_assigned_permissions')</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection