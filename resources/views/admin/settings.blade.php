@extends('admin.layout')

@section('title', 'Admin Settings')
@section('header', 'Account Settings')

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
    <style>
        @media (max-width: 860px) {
            .settings-grid-2 {
                grid-template-columns: 1fr !important;
            }
            .settings-header {
                flex-wrap: wrap;
                align-items: flex-start !important;
            }
            .settings-save {
                width: 100%;
            }
        }
        .settings-card {
            overflow: visible !important;
            height: auto;
        }
        .settings-grid-2 > div {
            min-width: 0;
        }
        .settings-form {
            width: 100%;
            height: auto;
            overflow: visible;
        }
        .settings-header > div {
            min-width: 0;
        }
        .settings-save {
            width: auto;
            min-width: 160px;
        }
        .settings-form input {
            height: 48px;
            padding: 14px 16px !important;
        }
    </style>

    <div class="card settings-card" style="padding:0;overflow:hidden;">
       <div class="settings-header" style="padding:22px 24px;
            border-bottom:1px solid #e5e7eb;
            background:linear-gradient(120deg,#eef2ff,#f8fafc);
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;">

    <!-- Left Content -->
    <div>
        <div style="font-size:18px;font-weight:700;">Basic Details</div>
        <div style="color:#606776;margin-top:4px;">
            Update your name, email, and password. Username cannot be changed.
        </div>
    </div>

    <!-- Right Button -->
    <div>
        <button type="submit" class="settings-save"
                style="border:none;
                       background:#2563eb;
                       color:#fff;
                       padding:12px 16px;
                       border-radius:12px;
                       font-weight:600;
                       cursor:pointer;">
            Save Changes
        </button>
    </div>

</div>


        <div style="padding:22px 24px;display:grid;gap:16px;">
            @if (session('status'))
                <div style="padding:10px 12px;border-radius:10px;background:#eff6ff;border:1px solid #bfdbfe;color:#1e3a8a;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="padding:10px 12px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#991b1b;">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.update') }}" class="settings-form" style="display:grid;gap:16px;">
                @csrf

                <div class="settings-grid-2" style="display:grid;gap:12px;grid-template-columns:repeat(2,minmax(0,1fr));">
                    <div>
                        <label style="display:block;font-size:12px;letter-spacing:0.8px;text-transform:uppercase;color:#606776;margin-bottom:6px;">Username</label>
                        <input type="text" value="{{ auth('admin')->user()->username }}" readonly
                               style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #e5e7eb;background:#f3f4f6;">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;letter-spacing:0.8px;text-transform:uppercase;color:#606776;margin-bottom:6px;">Name</label>
                        <input name="name" type="text" value="{{ old('name', auth('admin')->user()->name) }}" required
                               style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #e5e7eb;">
                    </div>
                    <div style="grid-column:1 / -1;">
                        <label style="display:block;font-size:12px;letter-spacing:0.8px;text-transform:uppercase;color:#606776;margin-bottom:6px;">Email</label>
                        <input name="email" type="email" value="{{ old('email', auth('admin')->user()->email) }}" required
                               style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #e5e7eb;">
                    </div>
                </div>

                <div class="settings-grid-2" style="display:grid;gap:12px;grid-template-columns:repeat(2,minmax(0,1fr));">
                    <div>
                        <label style="display:block;font-size:12px;letter-spacing:0.8px;text-transform:uppercase;color:#606776;margin-bottom:6px;">New Password</label>
                        <input name="password" type="password" placeholder="Leave blank to keep current password"
                               style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #e5e7eb;">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;letter-spacing:0.8px;text-transform:uppercase;color:#606776;margin-bottom:6px;">Confirm Password</label>
                        <input name="password_confirmation" type="password"
                               style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #e5e7eb;">
                    </div>
                </div>

             
            </form>
        </div>
    </div>
@endsection
