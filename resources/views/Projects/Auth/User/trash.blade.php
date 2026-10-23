@extends('Projects.Dashboard.layout.app')

@section('title', __('Auth/users.trash.users_trash'))

@section('css')
@endsection

@section('content')
<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1>@lang('Auth/users.trash.users_trash')</h1>
        <p>@lang('Auth/users.trash.deleted_users')</p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('All.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('Auth/users.view.title')</a></li>
            <li class="breadcrumb-item active">@lang('All.trash')</li>
        </ol>
    </nav>
</div>

<section class="dashboard-card mb-4">
    <div class="card-header-custom flex-wrap gap-3">
        <div>
            <h5>@lang('Auth/users.trash.manage_deleted_users')</h5>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>@lang('Auth/users.trash.back_to_users')</a>
    </div>

    <div class="custom-datatable p-3">
        <div class="custom-table-toolbar mb-3">
            <div class="custom-table-length">
                <label for="usersTrashLength">@lang('All.show')</label>
                <select id="usersTrashLength" class="form-select form-select-sm">
                    @include('Projects.Dashboard.include.ordersLength')
                </select>
                <span>@lang('All.entries')</span>
            </div>
            <div class="custom-table-search">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" id="usersTrashSearch" class="form-control" placeholder="@lang('All.search')">
                </div>
            </div>
        </div>

        @include('Projects.Sass.session_fash_messages')

        <div class="table-responsive">
            <table id="usersTrashTable" class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th>@lang('Auth/users.view.id')</th>
                        <th>@lang('Auth/users.view.image')</th>
                        <th>@lang('Auth/users.view.name')</th>
                        <th>@lang('Auth/users.view.surname')</th>
                        <th>@lang('Auth/users.view.gender')</th>
                        <th>@lang('Auth/users.view.username')</th>
                        <th>@lang('Auth/users.view.email')</th>
                        <th>@lang('All.deleted_at')</th>
                        <th>@lang('Auth/users.view.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
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
                            <td>{{ $user->deleted_at?->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1 flex-nowrap">
                                    <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm({{ Illuminate\Support\Js::from(__('Auth/users.trash.restore_confirm')) }});">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm table-action-btn" title="@lang('All.restore')"><i class="fa-solid fa-trash-arrow-up"></i></button>
                                    </form>
                                    <form action="{{ route('users.force-destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm({{ Illuminate\Support\Js::from(__('Auth/users.trash.force_delete_confirm')) }});">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm table-action-btn" title="@lang('All.force_delete')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                <div class="py-4">
                                    <i class="fa-solid fa-trash-can fa-2x mb-2"></i>
                                    <p class="mb-0">@lang('Auth/users.trash.no_deleted_users')</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="custom-table-footer mt-3">
            <div class="custom-table-info">
                @lang('All.showing') {{ $users->firstItem() ?? 0 }}
                @lang('All.to') {{ $users->lastItem() ?? 0 }}
                @lang('All.of') {{ $users->total() }}
                @lang('Auth/users.trash.deleted_users_count')
            </div>
            <nav>{{ $users->links() }}</nav>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection