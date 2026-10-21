
@extends('Projects.Dashboard.layout.app')

@section('title', __('Auth/roles.show_title'))

@section('css')
@endsection

@section('content')
<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/roles.show_title')</h1>
        <p>@lang('Auth/roles.show_subtitle')</p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">@lang('All.dashboard')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('roles.index') }}">@lang('Auth/roles.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('All.show')</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('Auth/roles.show_title')</h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i>
                @lang('Auth/roles.buttons.back')
            </a>
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-pen-to-square me-1"></i>
                @lang('Auth/roles.buttons.edit')
            </a>
        </div>
    </div>

    <div class="p-3 p-md-4">
        @include('Projects.Sass.session_fash_messages')

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.id')
                </div>
                <div class="fw-semibold">{{ $role->id }}</div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.name')
                </div>
                <div class="fw-semibold">{{ $role->name }}</div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.slug')
                </div>
                <div><code>{{ $role->slug }}</code></div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.module')
                </div>
                <div>{{ $role->module }}</div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.action')
                </div>
                <div>{{ $role->action }}</div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.status')
                </div>
                <div>
                    @if($role->status == 1)
                        <span class="badge bg-success">
                            @lang('Auth/roles.status.active')
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            @lang('Auth/roles.status.inactive')
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.description')
                </div>
                <div class="p-3 border rounded">
                    {{ $role->description ?: '—' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.created_at')
                </div>
                <div>
                    {{ $role->created_at?->format('Y-m-d H:i') ?? '—' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-label form-label-sm text-muted">
                    @lang('Auth/roles.fields.updated_at')
                </div>
                <div>
                    {{ $role->updated_at?->format('Y-m-d H:i') ?? '—' }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection
