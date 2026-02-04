@extends('admin.layout')

@section('title', 'Manage Admins')
@section('header', 'Manage Admins')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">All Admins</div>
            <div style="color:#606776;">Only you can access this module.</div>
        </div>
        <a class="btn" href="{{ route('admin.management.create') }}">Create Admin</a>
    </div>

    @if (session('status'))
        <div class="page-card" style="border-color:#bfdbfe;background:#eff6ff;color:#1e3a8a;">
            {{ session('status') }}
        </div>
    @endif

    <div class="page-card">
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at }}</td>
                            <td style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                                <a class="btn btn-secondary" href="{{ route('admin.management.edit', $admin->id) }}">Edit</a>
                                @if ((int) $admin->id !== 1)
                                    <form method="POST" action="{{ route('admin.management.destroy', $admin->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Delete this admin?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#606776;">No admins found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:14px;">
            {{ $admins->links() }}
        </div>
    </div>
@endsection
