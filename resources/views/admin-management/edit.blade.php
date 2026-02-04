@extends('admin.layout')

@section('title', 'Edit Admin')
@section('header', 'Edit Admin')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">Edit Admin #{{ $admin->id }}</div>
            <div style="color:#606776;">Update admin account details.</div>
        </div>
        <a class="btn btn-secondary" href="{{ route('admin.management.index') }}">Back</a>
    </div>

    @if ($errors->any())
        <div class="page-card" style="border-color:#fecaca;background:#fef2f2;color:#991b1b;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.management.update', $admin->id) }}" class="page-card form-grid">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h3>Account</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username', $admin->username) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation">
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Update</button>
            <a class="btn btn-secondary" href="{{ route('admin.management.index') }}">Cancel</a>
        </div>
    </form>
@endsection
