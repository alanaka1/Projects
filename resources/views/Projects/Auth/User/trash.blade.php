@extends('Projects.Dashboard.layout.app')

@section('title', 'Users Trash')

@section('css')
@endsection

@section('content')

<div class="page-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

    <div>
        <h1>Users Trash</h1>
        <p>Manage deleted users.</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">Trash</li>
        </ol>
    </nav>

</div>


<section class="dashboard-card mb-4">

    <div class="card-header-custom flex-wrap gap-3">

        <div>
            <h5>Deleted Users</h5>
            <small>Manage users in the trash</small>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>Back to Users</a>

    </div>


    <div class="custom-datatable p-3">

        <!-- Controls -->
        <div class="custom-table-toolbar mb-3">
            <div class="custom-table-length">
                <label for="usersTrashLength">Show</label>

                <select id="usersTrashLength" class="form-select form-select-sm">
                    @include('Projects.Dashboard.include.ordersLength')
                </select>

                <span>entries</span>
            </div>


            <div class="custom-table-search">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" id="usersTrashSearch" class="form-control" placeholder="Search deleted users...">
                </div>
            </div>

        </div>


        <!-- Table -->
        <div class="table-responsive">
            <table id="usersTrashTable" class="table align-middle table-hover w-100 custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Deleted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        {{-- Image / Avatar --}}
                        <td>
                            @if($user->image)
                                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="45" height="45" class="rounded-circle" style="width:45px;height:45px;object-fit:cover;">
                            @elseif($user->gender === 'male')
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px;height:45px;"><i class="fa-solid fa-user text-primary"></i></div>
                            @elseif($user->gender === 'female')
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:45px;height:45px;"><i class="fa-solid fa-user text-danger"></i></div>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->deleted_at }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1 flex-nowrap">
                                {{-- Restore --}}
                                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من استرجاع هذا المستخدم؟');">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm table-action-btn" title="Restore"><i class="fa-solid fa-trash-arrow-up"></i></button>
                                </form>
                                {{-- Force Delete --}}
                                <form action="{{ route('users.force-destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('تحذير! سيتم حذف المستخدم نهائيًا ولا يمكن استرجاعه. هل أنت متأكد؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm table-action-btn" title="Delete Permanently"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <div class="py-4">
                                <i class="fa-solid fa-trash-can fa-2x mb-2"></i>
                                <p class="mb-0">No deleted users found.</p>
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
                Showing
                {{ $users->firstItem() ?? 0 }}
                to
                {{ $users->lastItem() ?? 0 }}
                of
                {{ $users->total() }}
                deleted users
            </div>

            <nav>{{ $users->links() }}</nav>

        </div>

    </div>

</section>

@endsection


@section('javascript')
@endsection