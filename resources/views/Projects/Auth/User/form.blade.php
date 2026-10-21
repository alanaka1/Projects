@extends('Projects.Dashboard.layout.app')

@section('title')
    {{ isset($user) ? __('Auth/users.edit') : __('Auth/users.create') }}
@endsection

@section('css')
@endsection

@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

    <div>
        <h1>{{ isset($user) ? __('Auth/users.edit') : __('Auth/users.create') }}</h1>
        <!-- <p>{{ isset($user) ? 'Update user information below.' : 'Enter the user information below.' }}</p> -->
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('Auth/users.title')</a></li>
            <li class="breadcrumb-item active">{{ isset($user) ? __('Auth/users.edit') : __('Auth/users.create') }}</li>
        </ol>
    </nav>

</div>


<section class="dashboard-card mb-4">

    <div class="card-header-custom flex-wrap gap-3">

        <div>
            <h5>{{ isset($user) ? __('Auth/users.edit') : __('Auth/users.create') }}</h5>

            <small>
                {{ isset($user) ? __('Auth/users.update_the_user_information_below') : __('Auth/users.enter_the_user_information_below') }}
            </small>
        </div>


        <button type="submit" form="userForm" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-floppy-disk me-1"></i>
            {{ isset($user) ? __('All.update') : __('All.save') }}
        </button>

    </div>

    <!-- @include('Projects.Sass.validation_errors') -->

    <div class="p-3 p-md-4">

        <form id="userForm" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="row g-3">
                {{-- Name --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="name" class="form-label form-label-sm">@lang('Auth/users.name')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/users.name')">
                    </div>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Surname --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="surname" class="form-label form-label-sm">@lang('Auth/users.surname')<span class="text-danger">*</span></label>

                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control form-control-sm @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname', $user->surname ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/users.surname')">
                    </div>
                    @error('surname')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Gender --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="gender" class="form-label form-label-sm">@lang('Auth/users.gender')<span class="text-danger">*</span></label>
                    <select class="form-select form-select-sm @error('gender') is-invalid @enderror" id="gender" name="gender">
                        <option value="">@lang('All.select') @lang('Auth/users.gender')</option>
                        <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>@lang('Auth/users.male')</option>
                        <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>@lang('Auth/users.female')</option>
                    </select>
                    @error('gender')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Username --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="username" class="form-label form-label-sm">@lang('Auth/users.username')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                        <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" placeholder="@lang('All.enter') @lang('Auth/users.username')">
                    </div>
                    @error('username')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Email --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="email" class="form-label form-label-sm">@lang('Auth/users.email')<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="name@example.com">
                    </div>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Password --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="password" class="form-label form-label-sm">@lang('Auth/users.password') @if(!isset($user))<span class="text-danger">*</span>@endif</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ isset($user) ? __('Auth/users.password_placeholder_edit') : __('Auth/users.password_placeholder_create') }}"> <!--{//{ !isset($user) ? 'required' : '' }}-->
                    </div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Confirm Password --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="password_confirmation" class="form-label form-label-sm">@lang('Auth/users.password_confirmation') @if(!isset($user))<span class="text-danger">*</span>@endif</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="@lang('Auth/users.password_confirmation')"> <!--{//{ !isset($user) ? 'required' : '' }}-->
                    </div>
                    @error('password_confirmation')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Status --}}
                <div class="col-12 col-md-6">
                    <label for="status" class="form-label form-label-sm">@lang('Auth/users.status')</label>
                    <select class="form-select form-select-sm @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="1"{{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>@lang('Auth/users.active')</option>
                        <option value="0"{{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>@lang('Auth/users.inactive')</option>
                    </select>
                </div>
                @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

                {{-- Image --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="image" class="form-label form-label-sm">@lang('Auth/users.image')</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-image"></i></span>
                        <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    </div>
                    @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
            </div>


            {{-- Footer --}}
            <div class="form-actions mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>@lang('All.back')</a>
                <button type="reset" class="btn btn-light btn-sm"><i class="fa-solid fa-rotate-left me-1"></i>@lang('All.reset')</button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-1"></i>{{ isset($user) ? __('All.edit_button') : __('All.save') }}</button>
            </div>

        </form>

       {{-- Remove user image. / حذف صورة المستخدم فقط. --}}
        @if(isset($user) && $user->image)
            <div class="mt-3 d-flex align-items-center gap-2">
                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="90" height="90" class="rounded-circle" style="object-fit: cover;">
                <form action="{{ route('users.remove-image', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Auth/users.delete_image_confirm') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="@lang('Auth/users.delete_image')"><i class="fa-solid fa-trash-can me-2"></i>@lang('Auth/users.delete_image')</button>
                </form>
            </div>
        @else
            <div class="mt-3">                
                @if(isset($user) && $user->gender === 'male')
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px; height:45px;"><i class="fa-solid fa-user text-primary"></i></div>
                    {{-- <img src="{{ asset('images/avatar-male.png') }}" alt="Male Avatar" width="90" height="90" class="rounded-circle"> --}}
                @elseif(isset($user) && $user->gender === 'female')
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px; height:45px;"><i class="fa-solid fa-user text-danger"></i></div>
                    {{-- <img src="{{ asset('images/avatar-female.png') }}" alt="Female Avatar" width="90" height="90" class="rounded-circle"> --}}
                @endif
            </div>
        @endif

    </div>

</section>

@endsection


@section('javascript')
@endsection