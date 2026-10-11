@extends('Projects.Dashboard.layout.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')

@section('css')
@endsection

@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

    <div>
        <h1>{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
        <p>{{ isset($user) ? 'Update user information below.' : 'Enter the user information below.' }}</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">Users</a>
            </li>

            <li class="breadcrumb-item active">
                {{ isset($user) ? 'Edit' : 'Create' }}
            </li>
        </ol>
    </nav>

</div>


<section class="dashboard-card mb-4">

    <div class="card-header-custom flex-wrap gap-3">

        <div>
            <h5>{{ isset($user) ? 'Edit User' : 'Create New User' }}</h5>

            <small>
                {{ isset($user) ? 'Update the user information below.' : 'Enter the user information below.' }}
            </small>
        </div>


        <button type="submit" form="userForm" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-floppy-disk me-1"></i>
            {{ isset($user) ? 'Update User' : 'Save User' }}
        </button>

    </div>


    <div class="p-3 p-md-4">

        <form id="userForm" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="row g-3">
                {{-- Name --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="name" class="form-label form-label-sm">Name<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" placeholder="Enter name">
                    </div>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Surname --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="surname" class="form-label form-label-sm">Surname<span class="text-danger">*</span></label>

                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control form-control-sm @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname', $user->surname ?? '') }}" placeholder="Enter surname">
                    </div>
                    @error('surname')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Gender --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="gender" class="form-label form-label-sm">Gender<span class="text-danger">*</span></label>
                    <select class="form-select form-select-sm @error('gender') is-invalid @enderror" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Username --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="username" class="form-label form-label-sm">Username<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                        <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" placeholder="Enter username">
                    </div>
                    @error('username')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Email --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="email" class="form-label form-label-sm">Email<span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="name@example.com">
                    </div>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Password --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="password" class="form-label form-label-sm">Password @if(!isset($user))<span class="text-danger">*</span>@endif</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ isset($user) ? 'Leave empty to keep current password' : 'Enter password' }}"> <!--{//{ !isset($user) ? 'required' : '' }}-->
                    </div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Confirm Password --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="password_confirmation" class="form-label form-label-sm">Confirm Password @if(!isset($user))<span class="text-danger">*</span>@endif</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password"> <!--{//{ !isset($user) ? 'required' : '' }}-->
                    </div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- Status --}}
                <div class="col-12 col-md-6">
                    <label for="status" class="form-label form-label-sm">Status</label>
                    <select class="form-select form-select-sm @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="1"{{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0"{{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

                {{-- Image --}}
                <div class="col-12 col-md-6 col-xl-3">
                    <label for="image" class="form-label form-label-sm">User Image</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fa-regular fa-image"></i></span>
                        <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    </div>
                    @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
            </div>


            {{-- Footer --}}
            <div class="form-actions mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
                <button type="reset" class="btn btn-light btn-sm"><i class="fa-solid fa-rotate-left me-1"></i>Reset</button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-1"></i>{{ isset($user) ? 'Update User' : 'Save User' }}</button>
            </div>

        </form>

       {{-- Remove user image. / حذف صورة المستخدم فقط. --}}
        @if(isset($user) && $user->image)
            <div class="mt-3 d-flex align-items-center gap-2">
                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="90" height="90" class="rounded-circle" style="object-fit: cover;">
                <form action="{{ route('users.remove-image', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف صورة المستخدم؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Image"><i class="fa-solid fa-trash-can"></i>Delete Image</button>
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