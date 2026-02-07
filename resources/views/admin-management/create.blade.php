@extends('admin.layout')

@section('title', 'Create Admin')
@section('header', 'Create Admin')

@section('content')
<style>
        html, body {
            height: 100%;
        }

        body {
            overflow: hidden;
        }

        .layout,
        .content {
            height: 100vh;
        }

        .main {
            overflow-y: auto;
            min-height: 0;
        }
    </style>
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">New Admin</div>
            <div style="color:#606776;">Create a new admin account.</div>
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

    <form method="POST" action="{{ route('admin.management.store') }}" class="page-card form-grid">
        @csrf
        <div class="form-section">
            <h3>Account</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Create</button>
            <a class="btn btn-secondary" href="{{ route('admin.management.index') }}">Cancel</a>
        </div>
    </form>
@endsection
