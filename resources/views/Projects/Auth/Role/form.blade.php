
@extends('Projects.Dashboard.layout.app')

@section('title')
    {{ isset($role) ? __('Auth/roles.edit_title') : __('Auth/roles.create_title') }}
@endsection

@section('css')
@endsection

@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>{{ isset($role) ? __('Auth/roles.edit_title') : __('Auth/roles.create_title') }}</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">@lang('Auth/roles.title')</a></li>
            <li class="breadcrumb-item active">{{ isset($role) ? __('Auth/roles.edit_title') : __('Auth/roles.create_title') }}</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>{{ isset($role) ? __('Auth/roles.edit_title') : __('Auth/roles.create_title') }}</h5>
            <small>{{ isset($role) ? __('Auth/roles.edit_subtitle') : __('Auth/roles.create_subtitle') }}</small>
        </div>

        <button type="submit" form="roleForm" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-floppy-disk me-1"></i>
            {{ isset($role) ? __('All.update') : __('All.save') }}
        </button>
    </div>

    <!-- @include('Projects.Sass.validation_errors') -->
    <div class="p-3 p-md-4">
        <form id="roleForm" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST" autocomplete="off">
            @csrf
            @if(isset($role))
                @method('PUT')
            @endif

            <div class="row g-3">
                {{-- Name --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="name" class="form-label form-label-sm">@lang('Auth/roles.fields.name')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/roles.fields.name')">
                    </div>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Slug --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="slug" class="form-label form-label-sm">@lang('Auth/roles.fields.slug')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                        <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $role->slug ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/roles.fields.slug')">
                    </div>
                    @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Module --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="module" class="form-label form-label-sm">@lang('Auth/roles.fields.module')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                        <input type="text" class="form-control form-control-sm @error('module') is-invalid @enderror" id="module" name="module" value="{{ old('module', $role->module ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/roles.fields.module')">
                    </div>
                    @error('module')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Action --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="action" class="form-label form-label-sm">@lang('Auth/roles.fields.action')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-bolt"></i></span>
                        <input type="text" class="form-control form-control-sm @error('action') is-invalid @enderror" id="action" name="action" value="{{ old('action', $role->action ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/roles.fields.action')">
                    </div>
                    @error('action')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Status --}}
                <div class="col-12 col-md-6">
                    <label for="status" class="form-label form-label-sm">@lang('Auth/roles.fields.status')</label>
                    <select class="form-select form-select-sm @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="1" {{ old('status', $role->status ?? 1) == 1 ? 'selected' : '' }}>@lang('Auth/roles.status.active')</option>
                        <option value="0" {{ old('status', $role->status ?? 1) == 0 ? 'selected' : '' }}>@lang('Auth/roles.status.inactive')</option>
                    </select>
                    @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Description --}}
                <div class="col-12">
                    <label for="description" class="form-label form-label-sm">@lang('Auth/roles.fields.description')</label>
                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="@lang('All.enter') @lang('Auth/roles.fields.description')">{{ old('description', $role->description ?? '') }}</textarea>
                    @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Footer --}}
            <div class="form-actions mt-4">
                <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>@lang('All.back')</a>
                <button type="reset" class="btn btn-light btn-sm"><i class="fa-solid fa-rotate-left me-1"></i>@lang('All.reset')</button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-1"></i>{{ isset($role) ? __('All.update') : __('All.save') }}</button>
            </div>
        </form>
    </div>
</section>

@endsection

@section('javascript')
@endsection
